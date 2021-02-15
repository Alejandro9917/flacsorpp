<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTypesMetadataForms extends Model
{
    use HasFactory;

    protected $table = 'file_types_metadata_forms';

    protected $fillable = [
        'file_type_id',
        'meta_data_forms_id',
        'visible'
    ];

    //Relación con FileTypes
    public function fileType(){
        return $this->belongsTo(FileType::class, 'file_type_id', 'id');
    }
    //Relación con MetadataForms
    public function metadata(){
        return $this->belongsTo(Metadata::class, 'meta_data_forms_id', 'id');
    }

}
