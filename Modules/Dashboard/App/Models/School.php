<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SchoolFactory;

class School extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'schools';

        protected $primaryKey = 'id';

    protected $fillable = [
        'kh_name',
        'en_name',
        'slider',
        'logo',
        'description',
        'information',
        'position',
        'updated_at',
        'created_at'
    ];



    protected static function newFactory()
    {
        //return SchoolFactory::new();
    }


    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'school_has_classes', 'school_id', 'class_id');
    }
    public function majors()
    {
        return $this->belongsToMany(Major::class, 'school_has_majors', 'school_id', 'major_id');
    }
}
