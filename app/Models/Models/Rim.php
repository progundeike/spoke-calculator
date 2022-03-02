<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rim extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo('Models\User');
    }
}
