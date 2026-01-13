<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\VideoStreamPartnerFactory;

class VideoStreamPartner extends Model
{
    use HasFactory;

    protected $table = 'stream_video_partners';
    protected $fillable = [
        'title',
        'description',
        'url',
        'project_id',
        'province_id',
        'school_partner_id',
        'class_level_id',
        'teacher_partner_id',
        'major_id',
        'stream_date',
        'start_time',
        'end_time',
        'views',
        'status_id',
        'file',
        'file_name',
        'thumbnail',
    ];

    public function schoolPartner()
    {
        return $this->belongsToMany(SchoolPartner::class, 'stream_video_partner_has_schools', 'stream_video_partner_id', 'school_partner_id');
    }

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'student_has_view_videos',
            'stream_video_partner_id', // video id column in pivot table
            'student_id'               // student id column
        );
    }



    public function stream_status()
    {
        return $this->belongsTo(StreamStatus::class, 'status_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo(TeacherPartner::class, 'teacher_partner_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_level_id');
    }
    public function major()
    {
        return $this->belongsTo(MajorPartner::class, 'major_id');
    }

}
