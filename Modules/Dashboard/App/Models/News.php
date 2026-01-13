<?php

namespace Modules\Dashboard\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\NewsFactory;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $table='news';
    protected $primarykey='id';
    protected $fillable = [
        'title',
        'image',
        'url',
        'content',
        'is_public',
        'post_by',
        'impressions_count',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return NewsFactory::new();
    }

    public function postBy (){
        return $this->belongsTo(User::class ,'post_by');
    }
}
