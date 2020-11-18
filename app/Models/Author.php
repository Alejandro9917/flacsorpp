<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'first_name', 'second_name', 'first_lastname', 'second_lastname',
        'birthday', 'email'
    ];

    //Relacion con file_autor
    public function files(){
        return $this->belongsToMany(File::class, 'file_authors', 'author_id', 'file_id');
    }
}
