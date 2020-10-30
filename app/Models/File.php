<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'name', 'type', 'status', 'created_by', 'collection_id',
    ];

    //Relación con Authors
    public function authors(){
        return $this->belongsToMany(Author::class, 'files_authors', 'file_id', 'author_id');
    }

    //Relación con Citations
    public function citations(){
        return $this->hasMan(Citation::class);
    }

    //Relacion con Collection
    public function collection(){
        return $this->belongsTo(Collection::class, 'collection_id', 'id');
    }

    //Relación con Tags
    public function tags(){
        return $this->belongsToMany(Tags::class, 'file_tags', 'file_id', 'tag_id');
    }

    //Relacion con Users
    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
