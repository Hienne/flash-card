<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    // Relation
    public function user()
    {
        // return $this->belongsTo('App\Models\User');
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        // return $this->hasMany('App\Models\Subject');
        return $this->hasMany(Subject::class);
    }
}
