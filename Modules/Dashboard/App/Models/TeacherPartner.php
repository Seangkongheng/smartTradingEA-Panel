<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\TeacherPartnerFactory;

class TeacherPartner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='teacher_partners';
    protected $primarykey='id';
    protected $fillable = [
        'title',
        'name',
        'project_id',
        'profile',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return TeacherFactory::new();
    }

    // public function major(){
    //     return $this->belongsTo(Major::class ,'major_id');
    // }
    public function project(){
        return $this->belongsTo(Project::class ,'project_id');
    }
}
