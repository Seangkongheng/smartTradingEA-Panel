<?php

namespace Modules\APIFrontEnd\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\UserSubcriptionFactory;
use Modules\Dashboard\App\Models\Maketplace;
use Modules\Dashboard\App\Models\Plan;

class UserSubcription extends Model
{
    use HasFactory;


    protected $table = 'user_subscriptions';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_id',
        'marketplace_id',
        'subscription_plan_id',
        'status',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    public function marketplace()
    {
        return $this->belongsTo(Maketplace::class, 'marketplace_id');
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(Plan::class, 'subscription_plan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
