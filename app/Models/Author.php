<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'id', 'first_name', 'second_name', 'first_lastname', 'second_lastname',
        'birthday', 'email', 'created_at', 'updated_at'
    ];

    //Relacion con file_autor
    public function files(){
        return $this->belongsToMany(File::class);
    }
}
