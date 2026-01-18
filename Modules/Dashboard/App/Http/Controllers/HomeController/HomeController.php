<?php

namespace Modules\Dashboard\App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\AboutUs;
use Modules\Dashboard\App\Models\News;
use Modules\Dashboard\App\Models\Project;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SchoolPartner;
use Modules\Dashboard\App\Models\Stream;
use Modules\Dashboard\App\Models\Teacher;
use Modules\Dashboard\App\Models\UserDetail;
use Modules\Dashboard\App\Models\VideoStreamPartner;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth()->user();
        $authName = $user->first_name .''.$user->last_name;
        return view('dashboard::index.index',compact('authName'));
    }

}
