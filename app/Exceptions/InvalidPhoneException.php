<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidPhoneException extends Exception
{
    public function report(): false
    {
        return false;
    }
}
