<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ClassCategoryFactory;

class ClassCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
   protected $table='class_categories';
    protected $primarykey='id';
    protected $fillable = [
        'name',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return ClassCategoryFactory::new();
    }
}
