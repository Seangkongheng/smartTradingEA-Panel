<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcriptionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $subscriptions = DB::table('user_subscriptions as us')
            ->leftJoin('plans as p', 'us.subscription_plan_id', '=', 'p.id')
            ->leftJoin('marketplaces as m', 'us.marketplace_id', '=', 'm.id')
            ->where('us.user_id', $user->id)
            ->select(
                'us.*',
                'p.id as plan_id',
                'p.name as plan_name',
                'm.title as marketplace_title',
                'm.description as marketplace_description',
                'm.feature as marketplace_feature'
            )
            ->get();

        return response()->json([
            'subcriptions' => $subscriptions,
        ]);
    }
}
