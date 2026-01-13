<?php

namespace Modules\Dashboard\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\UserDetailFactory;

class userDetail extends Model
{
    use HasFactory;

    protected $table='user_details';
    protected $primarykey='id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'profile',
        'is_active',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return UserDetailFactory::new();
    }

    public function user(){
           return $this->belongsTo(User::class, 'user_id');
    }
}
