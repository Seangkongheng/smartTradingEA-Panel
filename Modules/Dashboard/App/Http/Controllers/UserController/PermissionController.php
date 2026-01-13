<?php

namespace Modules\Dashboard\App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard::permission.index',compact("permissions"));
    }


    public function create()
    {
        return view('dashboard::permission.createOrUpdated');
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'unique:permissions,name'],
            ]);
            Permission::create([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.permission.index')->with("message","Permission Create Succesfully");
        } catch (Exception $e) {
            return redirect()->route('admin.permission.index')->with("error",$e->getMessage());
        }
    }

    public function show($id)
    {
        return view('dashboard::show');
    }

    public function edit($id)
    {
        $permissionEdit = Permission::findOrFail($id);
        return view('dashboard::permission.createOrUpdated',compact('permissionEdit'));
    }


    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => ['required', 'string'],
            ]);
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('admin.permission.index')->with('message', 'Permission Update successfull');
        }catch(Exception $e){
            return redirect()->route('admin.permission.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $Permission = Permission::findOrFail($id);
            $Permission->delete();
            return redirect()->route('admin.permission.index')->with('message', 'Permission Delete successfull');
        } catch (\Exception $e) {
             return redirect()->route('admin.permission.index')->with('error', $e->getMessage());
        }
    }
}
