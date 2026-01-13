<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StudentHasViewVideoStreamPartnerFactory;

class StudentHasViewVideoStreamPartner extends Model
{
    use HasFactory;

    protected $table = 'student_has_view_videos';
    protected $primarykey = 'id';
    protected $fillable = [
        'student_id',
        'stream_video_partner_id',
        'updated_at',
        'created_at'
    ];

}
