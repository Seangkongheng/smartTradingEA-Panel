<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SchoolPartnerFactory;

class SchoolPartner extends Model
{
    use HasFactory;


    public function province(){
        return $this->belongsTo(Province::class,'province_id');
    }

    protected $table='school_partners';
    protected $primarykey='id';
    protected $fillable = [
        'kh_name',
        'en_name',
        'province_id',
        'project_id',
        'created_at',
        'updated_at'
    ];
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
