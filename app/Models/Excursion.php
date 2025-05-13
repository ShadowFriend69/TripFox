<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'category_id',
        'guide_id',
        'title',
        'slug',
        'preview_image',
        'detail_image',
        'preview_text',
        'detail_text',
        'tags',
        'isActive',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExcursionCategory::class, 'category_id');
    }

    public function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }
}
