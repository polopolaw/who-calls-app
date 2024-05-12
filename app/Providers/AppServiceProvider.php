<?php

namespace App\Providers;

use App\Actions\ApproveComment;
use App\Actions\DeleteComment;
use App\Actions\ParsePhone;
use App\Actions\PlaceComment;
use App\Actions\SearchPhone;
use App\Contracts\ApproveCommentContract;
use App\Contracts\DeleteCommentContract;
use App\Contracts\ParsePhoneContract;
use App\Contracts\PlaceCommentContract;
use App\Contracts\SearchPhoneContract;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        $this->app->bind(PlaceCommentContract::class, PlaceComment::class);
        $this->app->bind(ApproveCommentContract::class, ApproveComment::class);
        $this->app->bind(DeleteCommentContract::class, DeleteComment::class);
        $this->app->bind(SearchPhoneContract::class, SearchPhone::class);
        $this->app->bind(ParsePhoneContract::class, ParsePhone::class);
    }

    public function boot(): void
    {
        Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));
    }
}
