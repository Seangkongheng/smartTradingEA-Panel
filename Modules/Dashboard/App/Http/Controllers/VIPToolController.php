<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\VIPTool;

class VIPToolController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vipTools= VIPTool::all();

        return view('dashboard::vipTool.index', compact('vipTools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::vipTool.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'link' => 'nullable|url',
            ]);

            VIPTool::create([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]);

            return redirect()->route('admin.vip-tools.index')->with('success', 'VIP Tool created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the VIP Tool: '.$e->getMessage());
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

        $vipToolEdit = VIPTool::findOrFail($id);

        return view('dashboard::vipTool.createOrUpdate', compact('vipToolEdit', ));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $vipTool = VIPTool::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'link' => 'nullable|url',
            ]);

            $vipTool->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]);

            return redirect()->route('admin.vip-tools.index')->with('success', 'VIP Tool updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the VIP Tool: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $vipTool = VIPTool::findOrFail($id);
            $vipTool->delete();

            return redirect()->route('admin.vip-tools.index')->with('success', 'VIP Tool deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.vip-tools.index')->with('error', 'An error occurred while deleting the VIP Tool: '.$e->getMessage());
        }
    }
}
