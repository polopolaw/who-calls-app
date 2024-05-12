<?php

namespace App\Jobs;

use App\Contracts\PlaceCommentContract;
use App\DTO\CommentData;
use App\Models\Phone;
use App\States\CommentSource\ZaimOcto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ParsePhoneData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(protected Phone $phone)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $provider = ZaimOcto::class;
        $response = Http::post("http://127.0.0.1:9000/phone",
                $this->phone->only(['id', 'phone', 'region_code', 'country_code', 'national_number'])
        );
        if ($response->ok()) {
            $data = $response->json();

            foreach ($data as $commentData) {
                $commentData['phone'] = $this->phone->phone;
                $action = app(PlaceCommentContract::class);
                $action->execute($commentData, $provider);
            }
        }
    }
}
