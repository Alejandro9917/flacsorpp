<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'cod_tag', 'name', 'color',
    ];

    //Relación con Files
    public function files(){
        return $this->belongsToMany(File::class, 'file_tags', 'tag_id', 'file_id');
    }
}
