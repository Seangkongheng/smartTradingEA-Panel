<?php

namespace Modules\Dashboard\App\Http\Controllers\AttachmentController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Attachment;

class AttachmentController extends Controller
{

    public function index()
    {
        $attachments = Attachment::orderBy('id', 'desc')->get();
        return view('dashboard::attachment.index', compact('attachments'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $attachment = Attachment::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%' . $search_string . '%')
                ->orWhere('description', 'like', '%' . $search_string . '%');

        });


        if ($status) {
            if ($status == 1) {
                $attachment->where('is_public', 1); // Active
            } elseif ($status == 3) {
                $attachment->where('is_public', 0); // Blocked
            }
        }

        $attachments = $attachment->orderBy('id', 'desc')->paginate(10);

        if ($attachments->count() >= 1) {
            return view('dashboard::attachment.partials.tableInformation.AttachmentTable', compact('attachments'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }


    public function create()
    {
        return view('dashboard::attachment.createOrUpdate');
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
                'file.*' => 'nullable|max:102400', // 100 MB
            ]);

            $allFiles = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName(); // unique filename
                    $uploadedFile->move(public_path('documents'), $filename);

                    $allFiles[] = [
                        'name' => $originalName,
                        'path' => 'documents/' . $filename,
                    ];
                }
            }
            Attachment::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,
            ]);

            return redirect()->route('admin.attachment.index')
                ->with('message', 'Attachment Created.');
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        return view('dashboard::attachment.createOrUpdate');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attachmentEdit = Attachment::where('id', $id)->first();
        return view('dashboard::attachment.createOrUpdate', compact('attachmentEdit'));
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

            $attachment = Attachment::findOrFail($id);

            $oldDocuments = $request->input('old_documents', []);
            $oldDocuments = array_map(fn($v) => json_decode($v, true), $oldDocuments);
            $newFile = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName();
                    $uploadedFile->move(public_path('documents'), $filename);

                    $newFile[] = [
                        'name' => $originalName,
                        'path' => 'documents/' . $filename,
                    ];
                }
            }
            // Merge old and new file
            $allFiles = array_merge($oldDocuments, $newFile);
            $attachment->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => !empty($allFiles) ? json_encode($allFiles) : null,

            ]);
            return redirect()->route('admin.attachment.index')
                ->with('message', 'Attachment Updated.');
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
            $attachment = Attachment::findOrFail($id);

            if (!empty($lessonDetail->file)) {
                $files = json_decode($attachment->file, true);
                foreach ($files as $f) {
                    if (File::exists(public_path($f['path']))) {
                        File::delete(public_path($f['path']));
                    }
                }
            }

            $attachment->delete();
            return redirect()->route('admin.attachment.index')->with('message', 'Attachment Deleted!');
        } catch (Exception $e) {
            return redirect()->route('admin.attachment.index')->with('error', $e->getMessage());
        }
    }
}
