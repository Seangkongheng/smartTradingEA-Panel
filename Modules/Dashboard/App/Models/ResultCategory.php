<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ResultCategoryFactory;

class ResultCategory extends Model
{
    use HasFactory;

    protected $table = 'result_categories';

    protected $primarykey = 'id';

    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];
}
