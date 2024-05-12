<?php

declare(strict_types=1);

namespace App\DTO;

class CommentData
{

    public function __construct(
        public string $phone,
        public string $name,
        public string $content,
        public ?string $avatar = null,
        public ?string $date = null,
        public ?int $vote = 0,
        public ?string $created_at = null,
        public ?string $call_type = null,
        public ?string $caller_name = null,
        public ?string $feedback_type = null,
        public ?string $emoji = null,
    )
    {
        $this->name = sanitizeString($this->name);
        $this->content = sanitizeString($this->content);
    }
}
