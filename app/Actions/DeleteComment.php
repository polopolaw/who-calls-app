<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\ApproveCommentContract;
use App\Contracts\DeleteCommentContract;
use App\Models\Comment;

class DeleteComment implements DeleteCommentContract
{
    public function execute(Comment $comment): void
    {
        $comment->delete();
    }
}
