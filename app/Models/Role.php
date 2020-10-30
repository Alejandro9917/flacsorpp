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
        return $this->hasMany(Permison::class, 'id');
    }

    //Relación con Users
    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}
