<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\AboutUs;
use Modules\Dashboard\App\Models\Contact;
use Modules\Dashboard\App\Models\Footer;
use Modules\Dashboard\App\Models\SettingLivePage;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\SocailPlatform;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('id','desc')->get();
        $footer = Footer::latest('id')->first();
        $aboutUs = AboutUs::latest('id')->first();
        $roles = Role::orderBy('id','desc')->get();
        $permissions = Permission::all();
        $settings =SettingTitle::all();
        $settingLiveTitles = SettingLivePage::all();
        $platforms = SocailPlatform::all();

        return view('dashboard::setting.index',compact('contacts','footer','aboutUs','roles','permissions','settings','settingLiveTitles','platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
