<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SettingLivePageFactory;

class SettingLivePage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $table='setting_living_page';
    protected $primarykey='id';
    protected $fillable = [
        'title',
        'description',
        'image',
        'updated_at',
        'created_at'
    ];

}
