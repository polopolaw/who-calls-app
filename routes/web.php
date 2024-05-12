<?php

use App\Http\Controllers\TelegramManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(TelegramManageController::class)
    ->name('telegram.')
    ->group(function () {
        Route::get('approve-comment/{comment}', 'approve')
            ->name('comment.approve');
        Route::get('delete-comment/{comment}', 'delete')
            ->name('comment.delete');
    })
    ->middleware('signed');;
