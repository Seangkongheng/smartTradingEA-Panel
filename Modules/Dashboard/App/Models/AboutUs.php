<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\AboutUsFactory;

class AboutUs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */    protected $table = 'about_us';
    protected $primarykey = 'id';
    protected $fillable = [
        'description',
        'name',
        'logo',
        'icon',
        'slider',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return AboutUsFactory::new();
    }
}
