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
        'expiry_date'
    ];

    // Relation
    public function subject()
    {
        // return $this->belongsTo('App\Models\Subject');
        return $this->belongsTo(Subject::class);
    }
}
