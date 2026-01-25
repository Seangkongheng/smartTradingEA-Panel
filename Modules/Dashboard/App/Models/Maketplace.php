<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\MaketplaceFactory;

class Maketplace extends Model
{
    use HasFactory;

    protected $table = 'marketplaces';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'description',
        'feature',
        'note',
        'is_public',
        'updated_at',
        'created_at'
    ];

    public function subscriptionPlans()
    {
        // Specify foreign key
        return $this->hasMany(MarketplacePlan::class, 'marketplace_id', 'id')->with('plan');
    }



}
