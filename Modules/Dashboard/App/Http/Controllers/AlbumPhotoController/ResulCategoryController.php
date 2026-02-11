<?php

namespace Modules\Dashboard\App\Http\Controllers\AlbumPhotoController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\ResultCategory;

class ResulCategoryController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ResultCategory::all();
        return view('dashboard::albumPhoto.result.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::albumPhoto.result.categroyCreateOrUpdate');
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

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category created successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred while creating the result category: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $categoryEdit = ResultCategory::findOrFail($id);
        return view('dashboard::albumPhoto.result.categroyCreateOrUpdate', compact('categoryEdit'));
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
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred while updating the result category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $category = ResultCategory::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category deleted successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred while deleting the result category: ' . $e->getMessage());
        }
    }
}
