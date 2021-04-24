<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'password',
    ];

    public function folders()
    {
        // return $this->hasMany('App\Models\Folder');
        return $this->hasMany(Folder::class);
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject');
        // return $this->hasMany(Subject::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setDateOfBirthAttribute($value) 
    // {
    //     $this->attributes['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    // }

    // public function getDateOfBirthAttribute() 
    // {
    //     return Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_birth'])->format('m/d/Y');
    // }
}
