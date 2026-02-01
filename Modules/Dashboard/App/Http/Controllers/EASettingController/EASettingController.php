<?php

namespace Modules\Dashboard\App\Http\Controllers\EASettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\EASetting;
use Illuminate\Support\Facades\File;

class EASettingController extends Controller
{

    public function index()
    {
        $eaSettings = EASetting::orderBy('id', 'desc')->get();
        return view('dashboard::eaSetting.index', compact('eaSettings'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $eaSetting = EASetting::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%' . $search_string . '%')
                ->orWhere('description', 'like', '%' . $search_string . '%');

        });


        if ($status) {
            if ($status == 1) {
                $eaSetting->where('is_public', 1); // Active
            } elseif ($status == 3) {
                $eaSetting->where('is_public', 0); // Blocked
            }
        }

        $eaSettings = $eaSetting->orderBy('id', 'desc')->paginate(10);

        if ($eaSettings->count() >= 1) {
            return view('dashboard::eaSetting.partials.tableInformation.AttachmentTable', compact('eaSettings'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }


    public function create()
    {
        return view('dashboard::eaSetting.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file.*' => 'nullable|max:102400',
            ]);

            $allFiles = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName(); // unique filename
                    $uploadedFile->move(public_path('docuEASettingDocumentsments'), $filename);

                    $allFiles[] = [
                        'name' => $originalName,
                        'path' => 'EASettingDocuments/' . $filename,
                    ];
                }
            }
            EASetting::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,
            ]);

            return redirect()->route('admin.eaSettings.index')
                ->with('message', 'EASetting Created.');
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        return view('dashboard::eaSetting.createOrUpdate');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eaSettingEdit = EASetting::where('id', $id)->first();
        return view('dashboard::eaSetting.createOrUpdate', compact('eaSettingEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            //Validate request
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file.*' => 'nullable|max:102400', // 100 MB
            ]);

            $eaSetting = EASetting::findOrFail($id);

            $oldDocuments = $request->input('old_documents', []);
            $oldDocuments = array_map(fn($v) => json_decode($v, true), $oldDocuments);
            $newFile = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName();
                    $uploadedFile->move(public_path('EASettingDocuments'), $filename);

                    $newFile[] = [
                        'name' => $originalName,
                        'path' => 'EASettingDocuments/' . $filename,
                    ];
                }
            }
            // Merge old and new file
            $allFiles = array_merge($oldDocuments, $newFile);
            $eaSetting->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,

            ]);
            return redirect()->route('admin.eaSettings.index')
                ->with('message', 'EASetting Updated.');
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
            $eaSetting = EASetting::findOrFail($id);

            if (!empty($lessonDetail->file)) {
                $files = json_decode($eaSetting->file, true);
                foreach ($files as $f) {
                    if (File::exists(public_path($f['path']))) {
                        File::delete(public_path($f['path']));
                    }
                }
            }

            $eaSetting->delete();
            return redirect()->route('admin.eaSettings.index')->with('message', 'EASettings Deleted!');
        } catch (Exception $e) {
            return redirect()->route('admin.eaSettings.index')->with('error', $e->getMessage());
        }
    }
}
