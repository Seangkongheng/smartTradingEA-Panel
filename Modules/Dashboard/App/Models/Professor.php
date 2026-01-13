<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ProfessorFactory;

class Professor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'teacher_quotes';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'name',
        'quote',
        'major_id',
        'profile',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return ProfessorFactory::new();
    }

    public function major(){
        return $this->belongsTo(Major::class,'major_id');
    }
}
