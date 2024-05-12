<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\SearchPhoneContract;
use App\Exceptions\InvalidPhoneException;
use App\Jobs\ParsePhoneData;
use App\Models\Phone;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Brick\PhoneNumber\PhoneNumberParseException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SearchPhone implements SearchPhoneContract
{

    public function __construct(protected AddNewVisit $visitCounter)
    {
    }

    /**
     * @throws InvalidPhoneException
     */
    public function execute(string $phoneNumber): Model|Phone|Builder
    {
        $phoneNumber = unifyPhone($phoneNumber);
        try {
            $number = PhoneNumber::parse($phoneNumber);
            if (!$number->isValidNumber()) {
                throw new InvalidPhoneException();
            }

            $phone = Phone::query()
                ->firstOrCreate(
                    ['phone' => $number->format(PhoneNumberFormat::E164)],
                    [
                        'phone' => $number->format(PhoneNumberFormat::E164),
                        'last_sync' => null,
                        'type' => $number->getNumberType(),
                        'region_code' => $number->getRegionCode(),
                        'country_code' => $number->getCountryCode(),
                        'national_number' => $number->getNationalNumber()
                    ]
                );
            ParsePhoneData::dispatchIf(
                $phone->last_sync === null || $phone->last_sync > now()->subDays(2),
                $phone
            );
            $this->visitCounter->execute($phone);
            return $phone;
        } catch (PhoneNumberParseException $e) {
            throw new InvalidPhoneException($e->getMessage());
        }
    }
}
