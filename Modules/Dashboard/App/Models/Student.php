<?php

namespace Modules\Dashboard\App\Models;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StudentFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'class_level_id',
        'province_id',
        'gender_id',
        'school_partner_id',
        'school_name',
        'stream_video_partner_id'
    ];
    protected $table = 'students';

    public function province(){
        return $this->belongsTo(Province::class , 'province_id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function schoolPartner(){
        return $this->belongsTo(SchoolPartner::class,'school_partner_id');
    }
    public function classLevel(){
        return $this->belongsTo(ClassLevel::class,'class_level_id');
    }
}
