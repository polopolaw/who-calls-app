<?php

namespace App\Models;

use App\Enums\FeedbackType;
use App\Models\Collections\CommentCollection;
use App\States\CommentSource\CommentState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_id',
        'user_id',
        'name',
        'avatar',
        'content',
        'vote',
        'source_class',
        'approved',
        'feedback_type',
        'emoji'
    ];

    protected $casts = [
        'feedback_type' => FeedbackType::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }

    public function newCollection(array $models = []): CommentCollection
    {
        return new CommentCollection($models);
    }

    public function getSourceAttribute(): CommentState
    {
        return new $this->source_class($this);
    }

}
