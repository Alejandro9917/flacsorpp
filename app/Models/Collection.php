<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections';

    protected $fillable = [
        'id', 'name', 'slug', 'priority', 'description', 'is_folder',
        'is_public', 'status', 'created_by', 'collection_id',
        'published_at', 'created_at', 'updated_at'
    ];

    //Relación con Users
    public function User(){
        return $this->belongsTo(User::class, 'crated_by', 'id');
    }

    //Relación con files
    public function File(){
        return $this->hasMany(File::class);
    }
}
