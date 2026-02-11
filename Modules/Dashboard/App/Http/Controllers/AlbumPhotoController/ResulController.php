<?php

namespace Modules\Dashboard\App\Http\Controllers\AlbumPhotoController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\ResultCategory;

class ResulController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ResultCategory::all();
        return view('dashboard::education.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::education.createOrUpdateCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            ResultCategory::create([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.education-categories.index')->with('success', 'Education category created successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while creating the education category: ' . $e->getMessage());
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
        $categoryEdit = ResultCategory::findOrFail($id);
        return view('dashboard::education.createOrUpdateCategory', compact('categoryEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = ResultCategory::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category updated successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while updating the education category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $category = \Modules\Dashboard\App\Models\EducationCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category deleted successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred while deleting the result category: ' . $e->getMessage());
        }
    }
}
