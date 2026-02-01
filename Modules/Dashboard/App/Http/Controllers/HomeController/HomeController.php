<?php

namespace Modules\Dashboard\App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth()->user();
        $authName = $user->first_name .''.$user->last_name;
        return view('dashboard::index.index',compact('authName'));
    }

}
