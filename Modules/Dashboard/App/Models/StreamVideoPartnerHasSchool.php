<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StreamVideoPartnerHasSchoolFactory;

class StreamVideoPartnerHasSchool extends Model
{
    use HasFactory;


    protected $table = 'stream_video_partner_has_schools';
    protected $primarykey = 'id';
    protected $fillable = [
        'stream_video_partner_id',
        'school_partner_id',
        'updated_at',
        'created_at'
    ];



}
