<?php

namespace Modules\Dashboard\App\Http\Controllers\RegisterController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userRegisters = User::role('user')->get();
        return view('dashboard::register.index', compact('userRegisters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::register.createOrUpdate');
    }


    public function show($id)
    {
        $userRegister = User::role('user')->where('id', $id)->first();
        return view('dashboard::register.show', compact('userRegister'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.register.index')->with("message", 'User Delete successfull');
        } catch (Exception $e) {
            return redirect()->route('admin.register.index')->with("error", $e->getMessage());
        }
    }
}
