<?php

namespace Modules\APIFrontEnd\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\OrderItemFactory;
use Modules\Dashboard\App\Models\Maketplace;
use Modules\Dashboard\App\Models\MarketplacePlan;

class OrderItem extends Model
{
    use HasFactory;


    protected $table = 'order_items';
    protected $primarykey = 'id';
    protected $fillable = [
        'order_id',
        'marketplace_id',
        'marketplace_plan_id',
        'price',
        'created_at',
        'updated_at',
    ];

    public function marketplacePlan()
    {
        return $this->belongsTo(MarketplacePlan::class, 'marketplace_plan_id', 'id');
    }

    public function marketplace()
    {
        return $this->belongsTo(Maketplace::class, 'marketplace_id', 'id');
    }

}
