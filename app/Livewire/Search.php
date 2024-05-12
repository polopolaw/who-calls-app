<?php

namespace App\Livewire;

use App\Contracts\SearchPhoneContract;
use App\Exceptions\InvalidPhoneException;
use App\Livewire\Forms\SearchForm;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    public SearchForm $form;
    #[Url]
    public string $phone = '';
    public $validatedPhone;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.search');
    }

    public function search(): void
    {
        $this->validate();
        $this->validatePhone();
        $this->phone = removeLeadingPlus($this->validatedPhone->phone);
    }

    public function mount(Request $request): void
    {
        if ($request->has('phone')) {
            $this->form->phone = unifyPhone($request->get('phone'));
            $this->search();
        }
    }

    public function validatePhone(): void
    {
        try {
            $search = app(SearchPhoneContract::class);
            $this->validatedPhone = $search->execute($this->form->phone);
        } catch (InvalidPhoneException $e) {
            $this->validatedPhone = null;
        }
    }
}
