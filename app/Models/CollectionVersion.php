<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionVersion extends Model
{
    use HasFactory;

    protected $table = 'collection_versions';

    protected $fillable = [
        'slug', 'version_number', 'description',
        'json_changes', 'status', 'created_by',
        'collection_id'
    ];

    //Relación con Collectioons
    public function collection(){
        return $this->belongsTo(Collection::class, 'id', 'collection_id');
    }

    //Relación con Users
    public function users(){
        return $this->belongsTo(User::class, 'id', 'created_by');
    }
}
