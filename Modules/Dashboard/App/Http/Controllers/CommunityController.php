<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Dashboard\App\Models\Community;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::orderBy('id', 'desc')->get();

        return view('dashboard::community.index', compact('communities'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $community = Community::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%'.$search_string.'%')
                ->orWhere('description', 'like', '%'.$search_string.'%');

        });

        if ($status) {
            if ($status == 1) {
                $community->where('is_public', 1); // Active
            } elseif ($status == 3) {
                $community->where('is_public', 0); // Blocked
            }
        }

        $communities = $community->orderBy('id', 'desc')->paginate(10);

        if ($communities->count() >= 1) {
            return view('dashboard::community.partials.tableInformation.productTable', compact('communities'))->render();
        } else {
            return response()->json([
                'status' => 'Nothing found',
            ]);
        }
    }

    public function create()
    {
        return view('dashboard::community.createOrUpdate');
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
                    $uploadedFile->move(public_path('documents'), $filename);

                    $allFiles[] = [
                        'name' => $originalName,
                        'path' => 'documents/'.$filename,
                    ];
                }
            }
            Community::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => ! empty($allFiles) ? json_encode($allFiles) : null,
            ]);

            return redirect()->route('admin.community.index')
                ->with('message', 'community Created.');
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $community = Community::where('id', $id)->first();

        return view('dashboard::community.show',compact('community'));
    }

    public function edit($id)
    {
        $communityEdit = Community::where('id', $id)->first();
        return view('dashboard::community.createOrUpdate', compact('communityEdit'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate request
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file.*' => 'nullable|max:102400', // 100 MB
            ]);

            $attachment = Community::findOrFail($id);

            $oldDocuments = $request->input('old_documents', []);
            $oldDocuments = array_map(fn ($v) => json_decode($v, true), $oldDocuments);
            $newFile = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $uploadedFile) {
                    $originalName = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->hashName();
                    $uploadedFile->move(public_path('documents'), $filename);

                    $newFile[] = [
                        'name' => $originalName,
                        'path' => 'documents/'.$filename,
                    ];
                }
            }
            // Merge old and new file
            $allFiles = array_merge($oldDocuments, $newFile);
            $attachment->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_public' => $request->is_public,
                'file' => ! empty($allFiles) ? json_encode($allFiles) : null,

            ]);

            return redirect()->route('admin.community.index')
                ->with('message', 'Community Updated.');
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $community = Community::findOrFail($id);

            if (! empty($community->file)) {
                $files = json_decode($community->file, true);
                foreach ($files as $f) {
                    if (File::exists(public_path($f['path']))) {
                        File::delete(public_path($f['path']));
                    }
                }
            }

            $community->delete();

            return redirect()->route('admin.community.index')->with('message', 'Community Deleted!');
        } catch (Exception $e) {
            return redirect()->route('admin.community.index')->with('error', $e->getMessage());
        }
    }
}
