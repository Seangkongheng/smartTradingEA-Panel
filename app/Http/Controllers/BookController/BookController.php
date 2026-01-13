<?php

namespace App\Http\Controllers\BookController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Dashboard\App\Models\Classes;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SettingTitle;
use Modules\Dashboard\App\Models\Stream;

class BookController extends Controller
{
    public function index()
    {
        $libraryTitleSectionLibrary = SettingTitle::select('title', 'description', 'header_background', 'logo')->where('id', 4)->first();
        $books = Stream::whereNotNull('file')
            ->where('file', '!=', '[]')
            ->orderBy('stream_date', 'desc')
            ->paginate(15);


        $schools = School::pluck('kh_name', 'id');
        return view('frontEnd.book.index', compact('libraryTitleSectionLibrary', 'books', 'schools'));
    }


    public function getClasses($school_id)
    {
        $school = School::findOrFail($school_id);
        $classes = $school->classes;
        $majors = $school->majors;
        $books = Stream::where('school_id', $school_id)
            ->with([
                'stream_school',
                'stream_major',
                'stream_class',
                'stream_class_category',
            ])->orderBy('stream_date', 'desc')->get();
        return response()->json([
            'classes' => $classes,
            'majors' => $majors,
            'books' => $books
        ]);
    }


    public function getCategories($class_id)
    {
        $class = Classes::findOrFail($class_id);
        $categories = $class->category;
        return response()->json(['categories' => $categories]);
    }
    public function getBook(Request $request)
    {
        $query = Stream::query();

        if ($request->has('school_id')) {
            $query->where('school_id', $request->school_id);
        }

        if ($request->has('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->has('category_id')) {
            $query->where('class_category_id', $request->category_id);
        }

        if ($request->has('major_id')) {
            $query->where('major_id', $request->major_id);
        }

        $books = $query->with(relations: ['stream_major', 'stream_class', 'stream_school', 'stream_class_category'])->orderBy('stream_date', 'desc')->get();
        return response()->json(['books' => $books]);
    }





}
