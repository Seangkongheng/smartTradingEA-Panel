<?php

namespace Modules\Dashboard\App\Http\Controllers\RegisterController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userRegisters = User::role('user')->get();

        return view('dashboard::register.index',compact('userRegisters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('dashboard::register.createOrUpdate');
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
