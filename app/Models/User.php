<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'firts_name', 'second_name', 'first_lastname',
        'second_lastname', 'birthday', 'status', 'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relación con Collection
    public function collections(){
        return $this->hasMany(Collection::class, 'id');
    }

    //Relación con Files
    public function files(){
        return $this->hasMany(File::class, 'id');
    }
}
