<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'category_id',
        'guide_id',
        'price',
        'title',
        'slug',
        'preview_image',
        'detail_image',
        'preview_text',
        'detail_text',
        'tags',
        'duration_minutes',
        'locations',
        'language',
        'max_people',
        'transport',
        'isActive',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'locations' => 'array',
        'language' => 'array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExcursionCategory::class, 'category_id');
    }

    public function guide(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
