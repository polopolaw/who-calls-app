<?php

namespace App\Livewire\Forms;

use App\Contracts\PlaceCommentContract;
use App\States\CommentSource\InternalState;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class PlaceCommentForm extends Form
{
    #[Validate('max:255')]
    public $name = '';

    #[Validate('max:500')]
    public $content = '';

    #[Validate('')]
    public $phone = '';

    #[Validate('')]
    public $emoji = '';
    #[Validate('')]
    public $feedback_type = '';


    /**
     * @throws ValidationException
     */
    public function store(): void
    {
        $this->validate();
        app(PlaceCommentContract::class)->execute($this->all(), InternalState::class);
    }
  }
