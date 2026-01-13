<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\TeacherFactory;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='teachers';
    protected $primarykey='id';
    protected $fillable = [
        'title',
        'name',
        'major_id',
        'school_id',
        'profile',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return TeacherFactory::new();
    }

    public function major(){
        return $this->belongsTo(Major::class ,'major_id');
    }
    public function school(){
        return $this->belongsTo(School::class ,'school_id');
    }
}
