<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SchoolHasMajorFactory;

class SchoolHasMajor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='school_has_majors';
    protected $primarykey='id';
    protected $fillable = [
        'school_id',
        'major_id',
        'updated_at',
        'created_at'
    ];


    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    protected static function newFactory()
    {
        //return SchoolHasMajorFactory::new();
    }
}
