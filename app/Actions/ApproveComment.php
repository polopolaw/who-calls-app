<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\ApproveCommentContract;
use App\Models\Comment;

class ApproveComment implements ApproveCommentContract
{
    public function execute(Comment $comment): void
    {
        $comment->update([
                'approved' => true
            ]);
    }
}
