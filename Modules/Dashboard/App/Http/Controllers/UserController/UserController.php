<?php

namespace Modules\Dashboard\App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(12);
        return view('dashboard::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard::user.addOrEdit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $is_active = 1;
        // validation
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $imageName = null;
            // upload image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('profiles'), $imageName);
            }
            // user create
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'is_active' => $is_active,
                'is_verify' => 0,
                'profile' => $imageName,
            ]);
            $user->syncRoles($request->roles);

            DB::commit();
            return redirect()->route('admin.user.index')->with('message', 'User created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $shows = User::findOrFail($id);
        return view('dashboard::user.show', compact('shows'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userEdit = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $userEdit->roles->pluck('name', 'name')->all();
        return view('dashboard::user.addOrEdit', compact('userEdit', 'userRoles', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $is_active = 1;
            // Find user and update
            $user = User::findOrFail($id);
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->syncRoles($request->roles);

            // Handle image upload
            $imageName = $user->profile ?? null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('profiles'), $imageName);
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->is_active = $is_active;
            $user->profile = $imageName;
            $user->save();
            return redirect()->route('admin.user.index')->with('message', 'User update successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.user.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.user.index')->with("message", 'User Delete successfull');
        } catch (Exception $e) {
            return redirect()->route('admin.user.index')->with("error", $e->getMessage());
        }
    }

    public function block($id)
    {
        try {
            $user = User::where('id', $id)->first();
            $user->is_active = 0;
            $user->save();
            return back()->with('message', 'User has been blocked successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function unblock($id)
    {
        try {
            $user = User::where('id', $id)->where('is_active', 0)->first();
            $user->is_active = 1;
            $user->save();
            return back()->with('message', 'User has been unblocked successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // search user
    // public function searchUser(Request $request){
    //     $search_string = $request->search_string;
    //     $status = $request->status;
    //     $users = User::where('username', 'like', '%' . $search_string . '%')
    //     ->orWhere('email', 'like', '%' . $search_string . '%')
    //     ->orWhereHas('userDetail', function ($query) use ($search_string) {
    //         $query->where('first_name', 'like', '%' . $search_string . '%')
    //               ->orWhere('last_name', 'like', '%' . $search_string . '%');
    //     })
    //     ->orderBy('id', 'desc')
    //     ->paginate(10);

    //     if($users->count()>=1){
    //         return view('dashboard::user.partials.tableInformation.userTable',compact('users'))->render();
    //     }else{
    //         return response()->json([
    //             'status'=>"Nothing found",
    //         ]);
    //     }
    // }
    // public function searchUser(Request $request)
    // {
    //     $search_string = $request->search_string;
    //     $status = $request->status;

    //     $users = User::where(function ($query) use ($search_string) {
    //         $query->where('username', 'like', '%' . $search_string . '%')
    //             ->orWhere('email', 'like', '%' . $search_string . '%')
    //             ->orWhereHas('userDetail', function ($q) use ($search_string) {
    //                 $q->where('first_name', 'like', '%' . $search_string . '%')
    //                     ->orWhere('last_name', 'like', '%' . $search_string . '%');
    //             });
    //     });

    //     // Apply status filter if provided
    //     if ($status == 2) {
    //         // Active
    //         $users->whereHas('UserDetail', function ($q) {
    //             $q->where('is_active', 1);
    //         });
    //     } elseif ($status == 3) {
    //         // Block
    //         $users->whereHas('UserDetail', function ($q) {
    //             $q->where('is_active', 0);
    //         });
    //     }

    //     $users = $users->orderBy('id', 'desc')->paginate(10);

    //     if ($users->count() >= 1) {
    //         return view('dashboard::user.partials.tableInformation.userTable', compact('users'))->render();
    //     } else {
    //         return response()->json([
    //             'status' => "Nothing found",
    //         ]);
    //     }
    // }

}
