<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];

    //Relación con Permisons
    public function permisons()
    {
        //! TODO: Encontré que esta relacion estaba la llave local y debe de ser la clave externa
        return $this->hasMany(Permison::class, 'role_id');
    }

    //Relación con Users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
