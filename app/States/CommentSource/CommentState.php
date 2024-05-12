<?php

declare(strict_types=1);

namespace App\States\CommentSource;

use App\Models\Comment;

abstract class CommentState
{
    public function __construct(protected Comment $comment) {}
    abstract public function shouldBeNotify(): bool;
    abstract public function humanName(): string;
}
