<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpokeLengthList extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'cross',
    //     'lengthR',
    //     'lengthL',
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('Models\User');
    }
}
