<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\PlaceCommentContract;
use App\DTO\CommentData;
use App\Models\Phone;
use App\Notifications\CommentCreated;
use GenderDetector\Gender;
use GenderDetector\GenderDetector;
use Illuminate\Support\Facades\Notification;

class PlaceComment implements PlaceCommentContract
{
    protected GenderDetector $detector;

    public function __construct(GenderDetector $detector)
    {
        $this->detector = $detector;
    }

    public function execute(array $data, string $source): void
    {
        $data = new CommentData(...$data);
        $phone = Phone::query()
            ->firstOrcreate([
                'phone' => $data->phone,
            ]);
        $user = auth()->user();
        $gender = match ($this->detector->getGender($data->name)) {
            Gender::Female, Gender::MostlyFemale => 'female',
            Gender::Male, Gender::MostlyMale => 'male',
            Gender::Unisex, null => 'unisex'
        };

        $comment = $phone->comments()
            ->create([
                'user_id' => $user->id ?? null,
                'avatar' => $user ? null : randomAvatar($gender),
                'gender' => $gender,
                'name' => $data->name,
                'content' => $data->content,
                'phone' => $data,
                'source_class' => $source,
                'feedback_type' => $data->feedback_type,
                'emoji' => $data->emoji
            ]);
        $sourceState = new $source($comment);
        if ($sourceState->shouldBeNotify()) {
            Notification::route('telegram', 186093823)
                ->notify(new CommentCreated($comment));
        }
    }
}
