<?php

namespace App\Models;

use Brick\PhoneNumber\PhoneNumberType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Builder|Phone query()
 */
class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'last_sync',
        'type',
        'region_code',
        'country_code',
        'national_number'
    ];

    protected $casts = [
        'type' => PhoneNumberType::class,
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
