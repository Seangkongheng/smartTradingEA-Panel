<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ClassesFactory;

class Classes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'classes';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return MajorFactory::new();
    }

    public function category()
    {
        return $this->belongsToMany(ClassCategory::class, 'class_has_class_category', 'class_id', 'class_category_id');
    }



    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_has_classes', 'class_id', 'school_id');
    }



    public function categories()
    {
        return $this->belongsToMany(ClassCategory::class, 'class_has_class_category', 'class_id', 'class_category_id');
    }




}
