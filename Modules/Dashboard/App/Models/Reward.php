<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\RewardFactory;
use App\Models\User;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'description',
        'is_public',
        'updated_at',
        'created_at',
    ];

   public function users()
{
    return $this->belongsToMany(
        \App\Models\User::class,
        'reward_users',
        'reward_id',
        'user_id'
    );
}

}
