<?php

namespace App\Livewire;


use App\Livewire\Forms\PlaceCommentForm;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CommentForm extends Component
{
    public $show = false;
    public $submitted = false;
    #[Reactive]
    public $validatedPhone;

    public PlaceCommentForm $form;
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->form->phone = $this->validatedPhone?->phone;

        $this->show = (bool)$this->form->phone;

        return $this->submitted
            ? view('livewire.submitted-comment')
            : view('livewire.comment-form');
    }

    public function mount()
    {
        $this->submitted = Cache::get('comment-submit'.request()->ip, false);
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->form->store();
        $this->submitted = true;
        Cache::put('comment-submit'.request()->ip, true, 900);
    }
}
