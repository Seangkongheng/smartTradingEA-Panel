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
        'updated_at',
        'created_at'
    ];

    public function marketplaces()
    {
        return $this->belongsToMany(
            Maketplace::class,
            'marketplace_plans',
            'plan_id',
            'marketplace_id'
        )->withPivot('price');
    }

}
