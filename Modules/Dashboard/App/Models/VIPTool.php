<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\VIPToolFactory;

class VIPTool extends Model
{
    use HasFactory;

    protected $table = 'vip_tools';

    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'description',
        'link',
        'is_public',
        'updated_at',
        'created_at',
    ];
}
