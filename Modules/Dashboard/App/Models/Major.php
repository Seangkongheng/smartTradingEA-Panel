<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\MajorFactory;

class Major extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='majors';
    protected $primarykey='id';
    protected $fillable = [
        'name',
        'description',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return MajorFactory::new();
    }

    public function schools(){
        return $this->belongsToMany(School::class , 'school_has_majors','major_id','school_id');
    }
}
