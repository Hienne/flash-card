<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'maker',
        'folder_id',
        'name',
        'shared_status',
        'description'
    ];

    // Relation
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function shared_subject() {
        return $this->hasOne(SharedSubject::class);
    }
}
