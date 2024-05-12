<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Phone;
use Illuminate\Support\Facades\Cache;

class AddNewVisit
{
    public function execute(Phone $phone): void
    {
        $key = 'visit_count:'.request()->ip().$phone->phone;

        if (! Cache::has($key)) {
            $expiresAt = now()->addMinutes(10);
            $phone->visits()->create();
            Cache::put($key, true, $expiresAt);
        }
    }
}
