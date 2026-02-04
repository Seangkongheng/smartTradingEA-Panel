<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\EASettingFactory;

class EASetting extends Model
{
    use HasFactory;



    protected $table = 'ea_settings';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'description',
        'file',
        'type_file',
        'total_downloads',
        'profit',
        'balance',
        'drawdown',
        'tradding_hours',
        'is_public',
        'updated_at',
        'created_at'
    ];

}
