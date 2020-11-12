<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    protected $table = 'citations';

    protected $fillable = [
        'content', 'title', 'pointer', 'reference', 'file_id',
    ];

    //Relacion con files
    public function file(){
        return $this->belongsTo(File::class, 'id', 'file_id');
    }
}
