<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCategory extends Model
{
    use HasFactory;

    protected $table = 'education_categories';

    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];
}
