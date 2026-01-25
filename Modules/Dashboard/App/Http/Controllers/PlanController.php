<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->get();
        return view('dashboard::plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::plan.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required'
            ]);

            Plan::create([
                'name' => $request->name,
                'price' => $request->price
            ]);
            return redirect()->route('admin.plan.index')->with('message', 'Plan Created');
        } catch (Exception $e) {
            return redirect()->route('admin.plan.index')->with('error', $e->getMessage());
        }

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
        $planEdit = Plan::find($id);
        return view('dashboard::plan.createOrUpdate', compact('planEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required'
            ]);
            $planEdit = Plan::find($id);

            $planEdit->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            return redirect()->route('admin.plan.index')->with('message', 'Plan Updated');
        } catch (Exception $e) {
            return redirect()->route('admin.plan.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $plan = Plan::find($id);
            $plan->delete();
            return redirect()->route('admin.plan.index')->with('message', 'Plan Deleted');
        } catch (Exception $e) {
            return redirect()->route('admin.plan.index')->with('error', $e->getMessage());
        }
    }
}
