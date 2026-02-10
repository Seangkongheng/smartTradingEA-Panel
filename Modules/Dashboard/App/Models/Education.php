<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\EducationFactory;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'description',
        'education_category_id',
        'link',
        'is_public',
        'updated_at',
        'created_at',
    ];


    public function category()
    {
        return $this->belongsTo( \Modules\Dashboard\App\Models\EducationCategory::class, 'education_category_id');
    }
}
