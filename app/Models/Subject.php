<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    // Relation
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function folder()
    {
        return $this->belongsTo('App\Models\Folder');
    }

    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }
}
