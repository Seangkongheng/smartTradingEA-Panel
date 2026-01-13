<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SettingTitleFactory;

class SettingTitle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='settings';
    protected $primarykey='id';
    protected $fillable = [
        'title',
        'description',
        'header_background',
        'logo',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return SettingTitleFactory::new();
    }
}
