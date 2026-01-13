<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ProjectFactory;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     *
     */

    public function schoolParter(){
        return $this->HasMany(SchoolPartner::class,'project_id');
    }

    protected $fillable = [
        'name',
        'description',
        'logo',
    ];
    protected $table = 'projects';


}
