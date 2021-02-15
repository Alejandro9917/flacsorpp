<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldTypes;

class Fields extends Model
{
    use HasFactory;

    protected $table = 'metadata_fields';

    protected $fillable = [
        'field_name',
        'is_required',
        'container_class',
        'id_element',
        'class',
        'validation_rule',
        'default_value',
        'placeholder',
        'json_config',
        'priority',
        'field_type_id',
        'meta_data_form_id'
    ];

    public function forms(){
        return $this->belongsToMany(Metadata::class,'meta_data_form_id','id');
    }

    public function fieldType(){
        return $this->belongsTo(FieldTypes::class, 'field_type_id', 'id');
    }
}
