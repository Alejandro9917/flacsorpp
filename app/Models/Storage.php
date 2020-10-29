<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'storages';

    protected $fillable = [
        'link', 'cod_father_storage', 'file_id', 
    ];
}
