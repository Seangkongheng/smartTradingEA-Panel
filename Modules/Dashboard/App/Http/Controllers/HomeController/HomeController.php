<?php

namespace Modules\Dashboard\App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\Membership;
use Modules\APIFrontEnd\App\Models\UserSubcription;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $totalRevenue = 0;
        $user = Auth()->user();
        $authName = $user->first_name . '' . $user->last_name;
        $totalSaless = UserSubcription::where('status', 'confirmed')->count();
        $totalRegisters = User::role('user')->count();
        $totalSales = UserSubcription::where('status', 'confirmed')->get();
        foreach ($totalSales as $totalSale) {
            $totalRevenue += $totalSale->total_price;
        }
        $usersActives = User::withoutRole('user')->where('is_active', 1)->count();
        $totalMembershipPendings = Membership::where("status", "pending")->count();
        $totalMembershipConfirms = Membership::where("status", "confirmed")->count();
            $totalSubscriptionConfirmeds = UserSubcription::where('status', 'confirmed')->count();
                   $totalSubscriptionPendings = UserSubcription::where('status', 'pending')->count();

        return view('dashboard::index.index', compact('authName', 'totalSaless', 'totalSubscriptionPendings','totalSubscriptionConfirmeds','totalRegisters', 'totalRevenue', 'usersActives', 'totalMembershipPendings', 'totalMembershipConfirms'));
    }

}
