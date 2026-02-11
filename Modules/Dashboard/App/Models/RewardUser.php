<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\RewardUserFactory;

class RewardUser extends Model
{
    use HasFactory;

     protected $table = 'reward_users';

    protected $primarykey = 'id';

    protected $fillable = [
        'reward_id',
        'user_id',
        'updated_at',
        'created_at',
    ];
}
