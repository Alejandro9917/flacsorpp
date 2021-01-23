<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldTypes extends Model
{
    use HasFactory;

    protected $table = 'field_types';


    public function fields(){
        return $this->hasMany(Fields::class);
    }
}
