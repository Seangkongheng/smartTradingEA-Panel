<?php

namespace Modules\Dashboard\App\Http\Controllers\AlbumPhotoController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Result;
use Modules\Dashboard\App\Models\ResultCategory;

class ResulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::all();
        return view('dashboard::albumPhoto.result.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ResultCategory::all();
        return view('dashboard::albumPhoto.result.createOrUpdate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {

             $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'result_category_id' => 'required|exists:result_categories,id',
                'file.*' => 'nullable|max:102400',
            ]);

            $allFiles = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName();
                    $uploadedFile->move(public_path('resultPhotos'), $filename);

                    $allFiles[] = [
                        'name' => $originalName,
                        'path' => 'resultPhotos/' . $filename,
                    ];
                }
            }

            Result::create([
                'title' => $request->title,
                'description' => $request->description,
                'result_category_id' => $request->result_category_id,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,
                'is_public' => $request->is_public,
            ]);

            return redirect()->route('admin.result-photos.index')->with('success', 'Result created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the result: ' . $e->getMessage());
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
        $resultEdit = Result::findOrFail($id);
        return view('dashboard::albumPhoto.result.createOrUpdate', compact('resultEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = ResultCategory::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the education category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Result::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.result-categories.index')->with('success', 'Result category deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the result category: ' . $e->getMessage());
        }
    }
}
