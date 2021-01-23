<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $table = 'metadata_fieds';


    public function forms(){
        return $this->belongsToMany(User::class);
    }
}
