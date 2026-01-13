<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\App\Models\Classes;
use Modules\Dashboard\App\Models\Major;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SteamComment;
use Modules\Dashboard\App\Models\Stream;
use Modules\Dashboard\App\Models\StreamStatus;
use Modules\Dashboard\App\Models\Teacher;

use function Symfony\Component\VarDumper\Dumper\esc;

class StreamingController extends Controller
{

    public function index()
    {
        $objStream = new Stream();
        $streams = $objStream::with('stream_status', 'stream_class', 'stream_major')->orderBy('id', 'desc')->paginate(12);
        return view('dashboard::school.streaming.index', ["streams" => $streams]);
    }


    public function create()
    {
        $objSchool = new School();
        $objStatus = new StreamStatus();

        $schools = $objSchool::all();
        $statuses = $objStatus::all();

        return view(
            'dashboard::school.streaming.addOrEdit',
            [
                "schools" => $schools,
                "statuses" => $statuses
            ]
        );
    }

    // Noted : This function for store stream video
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $stream = new Stream();
        $this->saveOrUpdate($stream, $request);
        return redirect()->route('admin.streaming.index')->with('message', 'Stream created successfully.');
    }


    // Noted : This function for show stream video
    public function show($id)
    {
        $stream = Stream::findOrFail($id);
        $comments = SteamComment::with('replies')->where('stream_id', $id)->get();

        return view('dashboard::school.streaming.show', ["stream" => $stream, 'comments' => $comments]);
    }


    // Noted : This function for edit page
    public function edit($id)
    {
        $objStream = new Stream();
        $objSchool = new School();
        $objStatus = new StreamStatus();
        $objTeacher = new Teacher();
        $objClass = new Classes();

        $stream = $objStream::find($id);
        $school = $objSchool::find($stream->school_id);
        $schools = $objSchool::all();

        $classes = $school->classes;
        $class = $objClass::find($stream->class_id);
        $categories = $class->categories;
        $majors = $school->majors;
        $teachers = $objTeacher::where('school_id', $stream->school_id)->get();
        $statuses = $objStatus::all();

        if (!$stream) {
            return redirect()->route('admin.streaming.index')->with('error', 'Stream not found.');
        }
        return view(
            'dashboard::school.streaming.addOrEdit',
            [
                "streamingEdit" => $stream,
                "schools" => $schools,
                "classes" => $classes,
                "majors" => $majors,
                "teachers" => $teachers,
                "categories" => $categories,
                "statuses" => $statuses
            ]
        );
    }

    // Noted : This function for update stream video
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $stream = Stream::findOrFail($id);
        $this->saveOrUpdate($stream, $request);

        return redirect()->route('admin.streaming.index')->with('message', 'Stream updated successfully.');
    }

    // Noted : This function for destroy
    public function destroy($id)
    {
        $stream = Stream::findOrFail($id);
        // Delete the thumbnail if it exists
        if ($stream->thumbnail && Storage::disk('public')->exists($stream->thumbnail)) {
            Storage::disk('public')->delete($stream->thumbnail);
        }

        // Delete the file if it exists
        if ($stream->file && Storage::disk('public')->exists($stream->file)) {
            Storage::disk('public')->delete($stream->file);
        }

        $stream->delete();

        return redirect()->route('admin.streaming.index')->with('message', 'Stream deleted successfully.');
    }


    // Noted :This function foro validate
    private function validateRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'teacher_id' => 'required|integer',
            'school_id' => 'required|integer',
            'major_id' => 'required|integer',
            'class_id' => 'required|integer',
            'class_category_id' => 'required|integer',
            'stream_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'status_id' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'file.*' => 'nullable|mimes:pdf|max:5120',
        ]);
    }

    // Noted: This function for save or update
    private function saveOrUpdate(Stream $stream, Request $request)
    {

        $stream->title = $request->title;
        $stream->description = $request->description;
        $stream->url = $request->url;
        $stream->views = $request->views;
        $stream->teacher_id = $request->teacher_id;
        $stream->school_id = $request->school_id;
        $stream->class_id = $request->class_id;
        $stream->class_category_id = $request->class_category_id;
        $stream->major_id = $request->major_id;
        $stream->stream_date = $request->stream_date;
        $stream->start_time = $request->start_time;
        $stream->end_time = $request->end_time;
        $stream->status_id = $request->status_id;


        if ($request->hasFile('thumbnail')) {
            if ($stream->thumbnail && Storage::disk('public')->exists($stream->thumbnail)) {
                Storage::disk('public')->delete($stream->thumbnail);
            }
            $stream->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('file')) {
            if ($stream->file && Storage::disk('public')->exists($stream->file)) {
                Storage::disk('public')->delete($stream->file);
            }
            $uploadedFiles = $request->file('file');


            $allFiles = [];
            foreach ($uploadedFiles as $index => $uploadedFile) {
                $originalName = $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->store('documents', 'public');
                $allFiles[] = [
                    'name' => $originalName,
                    'path' => $filePath,
                ];
            }
            $stream->file = json_encode($allFiles);
            $stream->file_name = json_encode($allFiles);
        }

        $stream->save();
    }



    //Ajax Functions to filters data based on school, class, major, and class category
    public function class($school_id)
    {
        $objSchool = new School();
        $school = $objSchool::find($school_id);
        $classes = $school->classes;

        return response()->json($classes);
    }

    public function major($school_id)
    {
        $objSchool = new School();
        $school = $objSchool::find($school_id);
        $majors = $school->majors;

        return response()->json($majors);
    }

    public function teacher($school_id)
    {
        $objTeacher = new Teacher();
        $teachers = $objTeacher::where('school_id', $school_id)->get();

        return response()->json($teachers);
    }

    public function classCategory($class_id)
    {
        $objClass = new Classes();
        $class = $objClass::find($class_id);
        $categories = $class->categories;

        return response()->json($categories);
    }



    public function streamingSearch(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $streamingQuery = Stream::where(function ($query) use ($search_string) {
            $query->where('title', 'like', '%' . $search_string . '%')
                ->orWhere('description', 'like', '%' . $search_string . '%');
        });



        if ($status == 1) {
            $streamingQuery->where('status_id', 1);
        } else if ($status == 2) {
            $streamingQuery->where('status_id', 2);
        } else if ($status == 3) {
            $streamingQuery->where('status_id', 3);
        }

        $streams = $streamingQuery->orderBy('id', 'desc')->paginate(10);
        if ($streams->count() >= 1) {
            return view('dashboard::school.streaming.partials.tableInformation.classTable', compact('streams'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }

    public function destroyComment($id)
    {
        $comment = SteamComment::findOrFail($id);
        $comment->delete();
        return back()->with('message', 'កាពិភាក្សាលុបបានជោគជ័យ។');
    }
}
