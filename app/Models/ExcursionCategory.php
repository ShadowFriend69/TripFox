<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExcursionCategory extends Model
{
    use softDeletes;
    protected $fillable = ['title', 'slug', 'isActive'];

    public function excursions(): HasMany
    {
        return $this->hasMany(Excursion::class, 'category_id');
    }
}
