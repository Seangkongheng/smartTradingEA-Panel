<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SocailPlatformFactory;

class SocailPlatform extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='social_platforms';
    protected $primarykey='id';
     protected $fillable = [
        'name',
        'link',
        'icon',
        'updated_at',
        'created_at'
    ];


    protected static function newFactory()
    {
        //return SocailPlatformFactory::new();
    }
}
