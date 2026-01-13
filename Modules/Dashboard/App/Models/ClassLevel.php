<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ClassLevelFactory;

class ClassLevel extends Model
{
    use HasFactory;


    protected $table = 'class_levels';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'updated_at',
        'created_at'
    ];

}

