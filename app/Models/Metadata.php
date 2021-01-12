<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;

    protected $table = 'meta_data_forms';

    protected $fillable =[
        'form_name', 'header', 'priority', 'class_container',
        'is_accordion', 'is_collapsed', 'extra_js', 'extra_css',
        'is_required'
    ];
}
