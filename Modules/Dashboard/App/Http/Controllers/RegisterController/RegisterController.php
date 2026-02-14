<?php

namespace Modules\Dashboard\App\Http\Controllers\RegisterController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {

        $userRegisters = User::role('user')->get();

        return view('dashboard::register.index', compact('userRegisters'));
    }

    public function create()
    {
        return view('dashboard::register.createOrUpdate');
    }

    public function show($id)
    {
        $userRegister = User::role('user')->where('id', $id)->first();

        return view('dashboard::register.show', compact('userRegister'));
    }

    // search user
    public function searchUser(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $userRegisters = User::where('first_name', 'like', '%'.$search_string.'%')
            ->orWhere('email', 'like', '%'.$search_string.'%')
            ->role('user');

        // Apply status filter if provided
        if ($status == 2) {
            // Active
            $userRegisters->where('is_active', 1);
        } elseif ($status == 3) {
            // Blocked
            $userRegisters->where('is_active', 0);
        }

        $userRegisters = $userRegisters->orderBy('id', 'desc')->paginate(10);

        if ($userRegisters->count() >= 1) {
            return view('dashboard::register.partials.tableInformation.productTable', compact('userRegisters'))->render();
        } else {
            return response()->json([
                'status' => 'Nothing found',
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.register.index')->with('message', 'User Delete successfull');
        } catch (Exception $e) {
            return redirect()->route('admin.register.index')->with('error', $e->getMessage());
        }
    }
}
