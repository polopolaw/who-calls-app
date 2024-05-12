<?php

declare(strict_types=1);

namespace App\States\CommentSource;

class InternalState extends CommentState
{

    public function shouldBeNotify(): bool
    {
        // TODO if user has more reputation than 100 not notify
        return true;
    }

    public function humanName(): string
    {
        return __('Inner');
    }
}
