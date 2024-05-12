<?php

declare(strict_types=1);


use Illuminate\Support\Facades\File;

if (!function_exists('randomAvatar')) {
    function randomAvatar(string $gender = 'male'): string
    {
        $files = File::allFiles(resource_path("images/avatars/$gender"));

        $randomFile = $files[array_rand($files)];
        return "avatars/$gender/" . $randomFile->getFilename();
    }
}

if (!function_exists('unifyPhone')) {
    function unifyPhone(string $number): string
    {
        $number = str_replace(" ", "", $number);
        $number = (!empty($number) && $number[0] !== '+') ? '+' . $number : $number;
        return $number;
    }
}

if (!function_exists('sanitizeString')) {
    function sanitizeString(string $str): string
    {
        return $str;
    }
}

if (!function_exists('removeLeadingPlus')) {
    function removeLeadingPlus(string $phone): string
    {
        return (str_starts_with($phone, '+')) ? substr($phone, 1) : $phone;
    }
}

if (!function_exists('getEmoji')) {
    function getEmoji(int $moodValue): string
    {
        if ($moodValue <= 0) {
            return "🤬";
        } elseif ($moodValue <= 30) {
            return "😡";
        } elseif ($moodValue <= 50) {
            return "😐";
        } elseif ($moodValue <= 80) {
            return "🙂";
        } else {
            return "😌";
        }
    }
}
