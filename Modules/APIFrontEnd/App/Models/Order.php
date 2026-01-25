<?php

namespace Modules\APIFrontEnd\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\APIFrontEnd\Database\factories\OrderFactory;

class Order extends Model
{
    use HasFactory;


    protected $table = 'orders';
    protected $primarykey = 'id';
    protected $fillable = [
        'uuid',
        'user_id',
        'status',
        'total_price',
        'bank_account_name',
        'payment_confirmed_at',
        'created_at',
        'updated_at',
    ];
    protected static function booted()
    {
        static::creating(function ($marketplace) {
            if (!$marketplace->uuid) {
                $marketplace->uuid = (string) Str::uuid();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')
            ->with('marketplacePlan'); // optional, to include plan info
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
