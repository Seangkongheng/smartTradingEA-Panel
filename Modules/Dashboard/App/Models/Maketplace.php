<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\MaketplaceFactory;
use Illuminate\Support\Str;


class Maketplace extends Model
{
    use HasFactory;

    protected $table = 'marketplaces';
    protected $primarykey = 'id';
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'feature',
        'note',
        'is_public',
        'updated_at',
        'created_at'
    ];
    protected static function booted()
    {
        static::creating(function ($marketplace) {
            if (!$marketplace->uuid) {
                $marketplace->uuid = (string) Str::uuid();
            }
        });
    }

    public function subscriptionPlans()
    {
        // Specify foreign key
        return $this->hasMany(MarketplacePlan::class, 'marketplace_id', 'id')->with('plan');
    }



}
