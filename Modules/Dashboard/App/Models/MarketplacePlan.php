<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\MarketplacePlanFactory;

class MarketplacePlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'marketplace_plans';
    protected $fillable = [
        'marketplace_id',
        'plan_id',
        'price'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }



}
