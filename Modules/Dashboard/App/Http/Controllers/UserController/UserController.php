<?php

namespace Modules\Dashboard\App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Modules\Dashboard\App\Models\UserDetail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::orderBy('id', 'desc')->get();
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
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // user create
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles($request->roles);
            $imageName = null;
            // upload image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('profiles'), $imageName);
            }

            // create user detail
            UserDetail::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'is_active' => $is_active,
                'profile' => $imageName,
            ]);


            DB::commit();
            return redirect()->route('admin.user.index')->with('message', 'User created successfully!');
        } catch (\Exception $e) {
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
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->syncRoles($request->roles);
            $user->save();
            // Handle image upload
            $imageName = $user->userDetail->profile ?? null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('profiles'), $imageName);
            }

            // Update user detail
            $userDetail = $user->userDetail ?? new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->first_name = $request->first_name;
            $userDetail->last_name = $request->last_name;
            $userDetail->date_of_birth = $request->date_of_birth;
            $userDetail->phone_number = $request->phone_number;
            $userDetail->is_active = $is_active;
            $userDetail->profile = $imageName;
            $userDetail->save();
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
            $userDetail = UserDetail::where('user_id', $id)->first();
            $user->delete();
            $userDetail->delete();
            return redirect()->route('admin.user.index')->with("message", 'User Delete successfull');
        } catch (Exception $e) {
            return redirect()->route('admin.user.index')->with("error", $e->getMessage());
        }
    }

    public function block($id)
    {
        try {
            $userDetail = UserDetail::where('user_id', $id)->first();
            $userDetail->is_active = 0;
            $userDetail->save();
            return back()->with('message', 'User has been blocked successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function unblock($id)
    {
        try {
            $userDetail = UserDetail::where('user_id', $id)->where('is_active', 0)->first();
            $userDetail->is_active = 1;
            $userDetail->save();
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
    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $users = User::where(function ($query) use ($search_string) {
            $query->where('username', 'like', '%' . $search_string . '%')
                ->orWhere('email', 'like', '%' . $search_string . '%')
                ->orWhereHas('userDetail', function ($q) use ($search_string) {
                    $q->where('first_name', 'like', '%' . $search_string . '%')
                        ->orWhere('last_name', 'like', '%' . $search_string . '%');
                });
        });

        // Apply status filter if provided
        if ($status == 2) {
            // Active
            $users->whereHas('UserDetail', function ($q) {
                $q->where('is_active', 1);
            });
        } elseif ($status == 3) {
            // Block
            $users->whereHas('UserDetail', function ($q) {
                $q->where('is_active', 0);
            });
        }

        $users = $users->orderBy('id', 'desc')->paginate(10);

        if ($users->count() >= 1) {
            return view('dashboard::user.partials.tableInformation.userTable', compact('users'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }

}
