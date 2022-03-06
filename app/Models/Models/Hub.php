<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hub extends Model
{
    use HasFactory;

    protected $fillable = [
        'hubModel',
        'hole',
        'pcdRight',
        'pcdLeft',
        'centerFlangeRight',
        'centerFlangeLeft',
        'hubMemo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('Models\User');
    }
}
