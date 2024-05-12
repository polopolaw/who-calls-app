<?php

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    public $perPage = 10;
    #[Reactive]
    public $validatedPhone;

    public $phone;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $comments = \App\Models\Comment::query()
            ->where('approved', true)
            ->with('user', function ($q) {
                $q->withCount('comments');
            })
            ->whereHas(
                'phone',
                function (Builder $q) {
                    $q->where('phone', $this->validatedPhone?->phone);
                }
            )->paginate($this->perPage);

        return $comments->total()
            ? view('livewire.comment', [
                'comments' => $comments ?? []
            ])
            : view('livewire.comments-not-found');
    }

    #[On('loadMore')]
    public function loadMore(): void
    {
        $this->perPage += 10;
    }
}
