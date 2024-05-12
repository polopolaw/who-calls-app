<?php

declare(strict_types=1);

namespace App\States\CommentSource;

class TinkoffState extends CommentState
{

    public function shouldBeNotify(): bool
    {
        return false;
    }

    public function humanName(): string
    {
        return __('Tinkoff');
    }
}
