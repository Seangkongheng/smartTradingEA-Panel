<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ResultFactory;

class Result extends Model
{
    use HasFactory;
    protected $table = 'result_photos';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'description',
        'file',
        'is_public',
        'result_category_id',
        'is_public',
        'updated_at',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(ResultCategory::class, 'result_category_id');
    }


}
