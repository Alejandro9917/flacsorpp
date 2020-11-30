<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permison extends Model
{
    use HasFactory;

    protected $table = 'permisons';

    protected $fillable = [
        'can_create', 'can_read', 'can_update', 'can_delete',
        'can_upload', 'can_download', 'role_id', 'module_id',
    ];

    //Relación con Modules
    public function module(){
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    //Relación con Roles
    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
