<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\UserSubcription;

class SubcriptionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $subscriptions = UserSubcription::with([
            'marketplace',
            'subscriptionPlan',
        ])
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'subcriptions' => $subscriptions,
        ]);
    }
}
