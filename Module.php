<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = [
        'route_regex', 'has_file', 
    ];

    //Relación co Permisons
    public function permisons(){
        return $this->hasMany(Permison::class);
    }
}
