<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\APIFrontEnd\App\Models\Order;
use Modules\APIFrontEnd\App\Models\UserSubcription;

class SubcriptionController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        $subscriptions = UserSubcription::with([
            'marketplace',
            'subscriptionPlan' // Make sure these relations exist
        ])
        ->where('user_id', $user->id)
        ->get();

        return response()->json([
            'subcriptions' => $subscriptions
        ]);
    }

}
