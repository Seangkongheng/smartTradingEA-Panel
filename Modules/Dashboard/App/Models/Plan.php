<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\PlanFactory;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'price',
        'updated_at',
        'created_at'
    ];


}
