<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\MajorPartnerFactory;

class MajorPartner extends Model
{
    use HasFactory;

    protected $table = 'major_partners';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'project_id',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return MajorFactory::new();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

