<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'front',
        'back',
        'num_of_study',
        'level_of_card',
        'expiry_date'
    ];

    // Relation
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
