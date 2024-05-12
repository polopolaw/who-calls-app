<?php

declare(strict_types=1);

namespace App\States\CommentSource;

class ZaimOcto extends CommentState
{

    public function shouldBeNotify(): bool
    {
        return true;
    }

    public function humanName(): string
    {
        return __('ZaimOcto');
    }

    public function slug(): string
    {
        return 'zaim_octo';
    }
}
