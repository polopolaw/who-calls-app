<?php

namespace App\Http\Controllers;

use App\Contracts\ApproveCommentContract;
use App\Contracts\DeleteCommentContract;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TelegramManageController extends Controller
{
    public function approve(Request $request, Comment $comment): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        app(ApproveCommentContract::class)->execute($comment);

        return redirect()
            ->route('home');
    }

    public function delete(Request $request, Comment $comment): RedirectResponse
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        app(DeleteCommentContract::class)->execute($comment);

        return redirect()
            ->route('home');
    }
}
