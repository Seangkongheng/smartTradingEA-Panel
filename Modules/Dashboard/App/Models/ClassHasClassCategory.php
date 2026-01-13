<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ClassHasClassCategoryFactory;

class ClassHasClassCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='class_has_class_category';
    protected $primarykey='id';
    protected $fillable = [
        'class_id',
        'class_category_id',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return ClassHasClassCategoryFactory::new();
    }
}
