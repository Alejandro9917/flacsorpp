<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTypes extends Model
{
    use HasFactory;

    protected $table = 'file_types';

    protected $fillable = [
        'name'
    ];

    //Relación con Citations
    public function files(){
        return $this->hasMany(File::class);
    }
    //Relación con Citations
    public function fileTypesMetadataForms(){
        return $this->hasMany(FileTypesMetadataForms::class,  'file_type_id', 'id');
    }

}
