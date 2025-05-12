<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guid extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
    ];
}
