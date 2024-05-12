<?php

declare(strict_types=1);

namespace App\Enums;

enum FeedbackType: string
{
    case NEGATIVE = 'negative';
    case USEFUL = 'useful';
    case NEUTRAL = 'neutral';

    public function tailwindClass(): string {
        return match($this) {
            FeedbackType::NEGATIVE => 'bg-green-600',
            FeedbackType::NEUTRAL => 'bg-gray-600',
            FeedbackType::USEFUL => 'bg-rose-600',
        };
    }

    public function humanName(): string {
        return match($this) {
            FeedbackType::NEGATIVE => __('Useful'),
            FeedbackType::NEUTRAL => __('Neutral'),
            FeedbackType::USEFUL => __('Negative'),
        };
    }
}
