<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Dashboard\App\Models\TradingAccount;

class TradingAccountController extends Controller
{

    public function index()
    {
        $tradingAccounts = TradingAccount::select('id', 'title', 'setting_title', 'server_name','password','account_id', 'total_profit','is_public')->where('is_public',1)->get();
        return response()->json($tradingAccounts);
    }
}
