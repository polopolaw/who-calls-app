<?php

namespace App\Livewire;

use App\Enums\FeedbackType;
use App\Models\Visit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class GeneralInfo extends Component
{
    public $country = '';

    public $show = false;

    public $positiveComments = 0;
    public $negativeComments = 0;
    public $neutralComments = 0;

    public $mood = 50;
    #[Reactive]
    public $validatedPhone;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->show = (bool)$this->validatedPhone;
        $data = $this->comments();
        $this->positiveComments = $data->where('feedback_type', FeedbackType::USEFUL)->count();
        $this->neutralComments = $data->where('feedback_type', FeedbackType::NEUTRAL)->count();
        $this->negativeComments = $data->where('feedback_type', FeedbackType::NEGATIVE)->count();

        $this->mood = $this->mood();
        return view('livewire.general-info');
    }

    #[Computed(cache: true)]
    public function comments()
    {
        return \App\Models\Comment::query()
            ->where('phone_id', $this->validatedPhone?->id)
            ->where('approved', true)
            ->select(['feedback_type'])
            ->get();
    }
    #[Computed]
    public function visits(): int
    {
        return Visit::query()
            ->where('phone_id', $this->validatedPhone?->id)
            ->count();
    }

    public function mood(): int
    {
        $sum = $this->positiveComments + $this->neutralComments + $this->negativeComments;
        return $sum
            ? (10 * $this->positiveComments + 5 * $this->neutralComments) / $sum * 10 % 100
            : 50;
    }
}
