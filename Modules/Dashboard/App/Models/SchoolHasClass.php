<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SchoolHasClassFactory;

class SchoolHasClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='school_has_classes';
    protected $primarykey='id';
    protected $fillable = [
        'school_id',
        'class_id',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return SchoolHasClassFactory::new();
    }
}
