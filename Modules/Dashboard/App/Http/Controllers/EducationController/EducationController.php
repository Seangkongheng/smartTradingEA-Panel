<?php

namespace Modules\Dashboard\App\Http\Controllers\EducationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = \Modules\Dashboard\App\Models\Education::with('category')->get();

        return view('dashboard::education.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \Modules\Dashboard\App\Models\EducationCategory::all();

        return view('dashboard::education.createOrUpdate', compact('categories'));

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
                'education_category_id' => 'required|exists:education_categories,id',
                'link' => 'nullable|url',
            ]);

            \Modules\Dashboard\App\Models\Education::create([
                'title' => $request->title,
                'description' => $request->description,
                'education_category_id' => $request->education_category_id,
                'link' => $request->link,
            ]);

            return redirect()->route('admin.educations.index')->with('success', 'Education created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the education: '.$e->getMessage());
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
        $categories = \Modules\Dashboard\App\Models\EducationCategory::all();
        $educationEdit = \Modules\Dashboard\App\Models\Education::findOrFail($id);

        return view('dashboard::education.createOrUpdate', compact('educationEdit', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $education = \Modules\Dashboard\App\Models\Education::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'education_category_id' => 'required|exists:education_categories,id',
                'link' => 'nullable|url',
            ]);

            $education->update([
                'title' => $request->title,
                'description' => $request->description,
                'education_category_id' => $request->education_category_id,
                'link' => $request->link,
            ]);

            return redirect()->route('admin.educations.index')->with('success', 'Education updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the education: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $education = \Modules\Dashboard\App\Models\Education::findOrFail($id);
            $education->delete();

            return redirect()->route('admin.educations.index')->with('success', 'Education deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.educations.index')->with('error', 'An error occurred while deleting the education: '.$e->getMessage());
        }
    }
}
