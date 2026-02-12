<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    use HasFactory;

    protected $table = 'trading_accounts';

    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'setting_title',
        'server_name',
        'account_id',
        'password',
        'total_profit',
        'is_public',
        'updated_at',
        'created_at',
    ];
}
