<?php

declare(strict_types=1);

namespace App\Services\Telegram\Exceptions;

use Exception;

class TelegramApiException extends Exception
{
    public function render(): false
    {
        return false;
    }
}
