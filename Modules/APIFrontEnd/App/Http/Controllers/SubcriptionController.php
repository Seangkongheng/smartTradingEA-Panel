<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\APIFrontEnd\App\Models\Order;

class SubcriptionController extends Controller
{

    public function index()
    {
        $order = Order::with('items.marketplacePlan', 'items.marketplace')->where('user_id', 30)->get();
        return response()->json([
            'order' => $order
        ]);
    }

}
