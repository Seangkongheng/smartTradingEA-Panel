<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\CommunityFactory;

class Community extends Model
{
    use HasFactory;



    protected $table = 'communities';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'description',
        'file',
        'is_public',
        'updated_at',
        'created_at'
    ];
}

