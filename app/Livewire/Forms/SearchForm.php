<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SearchForm extends Form
{
    #[Validate('required|min:5')]
    public $phone = '';
}
