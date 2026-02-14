<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Reward;

class RewardController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        $rewards = Reward::where('is_public', true)
            ->orWhereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->latest()
            ->get();
        return response()->json([
            'success' => true,
            'data' => $rewards
        ]);
    }


}
