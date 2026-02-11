<?php

namespace Modules\Dashboard\App\Http\Controllers\AlbumPhotoController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
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
          $categories = ResultCategory::all();
        $resultEdit = Result::findOrFail($id);
        return view('dashboard::albumPhoto.result.createOrUpdate', compact('resultEdit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'result_category_id' => 'required|exists:result_categories,id',
                'file.*' => 'nullable|max:102400',
            ]);
            $result = Result::findOrFail($id);

            $oldDocuments = $request->input('old_documents', []);
            $oldDocuments = array_map(fn($v) => json_decode($v, true), $oldDocuments);
            $newFile = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName();
                    $uploadedFile->move(public_path('resultPhotos'), $filename);

                    $newFile[] = [
                        'name' => $originalName,
                        'path' => 'resultPhotos/' . $filename,
                    ];
                }
            }
            // Merge old and new file
            $allFiles = array_merge($oldDocuments, $newFile);
            $result->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,

            ]);
            return redirect()->route('admin.result-photos.index')
                ->with('message', 'Result Updated.');
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $result = Result::findOrFail($id);
            if (!empty($result->file)) {
                $files = json_decode($result->file, true);
                foreach ($files as $f) {
                    if (File::exists(public_path($f['path']))) {
                        File::delete(public_path($f['path']));
                    }
                }
            }

            $result->delete();
            return redirect()->route('admin.result-photos.index')->with('message', 'Result Deleted!');
        } catch (Exception $e) {
            return redirect()->route('admin.result-photos.index')->with('error', $e->getMessage());
        }


    }
}
