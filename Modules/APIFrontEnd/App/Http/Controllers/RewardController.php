<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;

class RewardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    $rewards = \Modules\Dashboard\App\Models\Reward::whereHas('users', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })
    ->where('is_public',1)
    ->latest()
    ->get();

    return response()->json([
        'success' => true,
        'data' => $rewards,
    ]);
}

}
