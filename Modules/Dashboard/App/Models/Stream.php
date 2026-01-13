<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StreamFactory;

class Stream extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'streams';
    protected $fillable = [
        'title',
        'description',
        'url',
        'teacher_id',
        'school_id',
        'major_id',
        'class_id',
        'class_category_id',
        'stream_date',
        'start_time',
        'end_time',
        'views',
        'status_id',
        'file',
        'file_name',
        'thumbnail',
    ];

    public function stream_status()
    {
        return $this->belongsTo(StreamStatus::class, 'status_id', 'id');
    }
    public function stream_class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    public function stream_major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function stream_teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function stream_school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function stream_class_category()
    {
        return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
    }

    protected static function newFactory()
    {
        //return StreamFactory::new();
    }

    
}
