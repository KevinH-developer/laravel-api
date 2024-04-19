<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    use HasFactory;

    protected $table = 'proyects';

    protected $fillable = [
        'proyectName',
        'description',
        'objective',
        'duration',
        'category',
        'image_path',
        'username'
    ];
}
