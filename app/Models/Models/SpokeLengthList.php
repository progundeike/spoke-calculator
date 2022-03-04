<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpokeLengthList extends Model
{
    use HasFactory;

    protected $fillable = [
        'crossR',
        'crossL',
        'lengthR',
        'lengthL',
        'hubModel',
        'rimModel',
        //'wheelMemo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('Models\User');
    }
}
