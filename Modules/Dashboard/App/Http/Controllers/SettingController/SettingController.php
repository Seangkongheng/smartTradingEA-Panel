<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Dashboard\App\Models\AboutUs;
use Modules\Dashboard\App\Models\Contact;
use Modules\Dashboard\App\Models\SettingLivePage;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\SocailPlatform;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{

    public function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        $permissions = Permission::all();
        return view('dashboard::setting.index',compact('roles','permissions'));
    }


}
