<?php

namespace Modules\Dashboard\App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::get();
        return view('dashboard::role.index',compact('roles','permissions'));
    }

 
    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::get();
        return view('dashboard::role.createOrUpdated',compact('roles','permissions'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'unique:roles,name'],
                'permissions' => ['required', 'array'],
            ]);

            $role = Role::create([
                'name' => $request->name,
            ]);
            foreach ($request->permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
            return redirect()->route('admin.role.index')->with('message', 'Role inserted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.role.index')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        $roleEdit = Role::findOrFail($id);
        $rolepermission = Role::findOrFail($id)->permissions->pluck('name')->toArray();
        $permissions = Permission::all();
        return view('dashboard::role.createOrUpdated',compact('roleEdit','permissions','rolepermission'));
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => ['required', 'string', 'unique:roles,name,' . $id],
                'permissions' => ['required', 'array']
            ]);
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permissions);
            return redirect()->route('admin.role.index')->with('message', 'Role updated successfully');
       }
       catch (\Exception $e) {
            return redirect()->route('admin.role.index')->with('error',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $role=Role::findById($id);
            $role->delete();
            return redirect()->route('admin.role.index')->with('message','Role Delete Successfull');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.role.index')->with('error',$e->getMessage());
        }
    }
}
