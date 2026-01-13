<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Dashboard\App\Models\Major;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\Teacher;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::school.teacher.index', compact('teachers'));
    }


    public function create()
    {
        $schools = School::all();
        $majors = Major::pluck('name', 'id');
        return view('dashboard::school.teacher.createOrUpdate', compact("schools", "majors"));
    }


    public function store(Request $request)
    {

        // validation
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'major_id' => 'required',
            'school_id' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $imageName = null;
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('school/teachers'), $imageName);
            }

            // user create
            $teacher = Teacher::create([
                'title' => $request->title,
                'name' => $request->name,
                'major_id' => $request->major_id,
                'school_id' => $request->school_id,
                'profile' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('admin.teacher.index')->with('message', 'Teacher Created Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('dashboard::school.teacher.show', compact("teacher"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $objSchool = new School();
        $teacherEdit = Teacher::findOrFail($id);

        $school = $objSchool::find($teacherEdit->school_id);
        $schools = $objSchool::all();

        $majors = $school->majors;
        return view('dashboard::school.teacher.createOrUpdate', compact('teacherEdit', 'schools', 'majors'));
    }

    // Function update teacher
    public function update(Request $request, $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $imageName = $teacher->profile;

            // upload new logo if exists
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('school/teachers'), $imageName);

                if ($teacher->profile && file_exists(public_path('school/teachers/' . $teacher->profile))) {
                    unlink(public_path('school/teachers/' . $teacher->profile));
                }
            }

            $teacher->update([
                'title' => $request->title,
                'name' => $request->name,
                'major_id' => $request->major_id,
                'school_id' => $request->school_id,
                'profile' => $imageName,
            ]);

            return redirect()->route('admin.teacher.index')->with('message', 'Teacher Update Successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.teacher.index')->with('error', $e->getMessage());
        }
    }


    // Function delete teacher
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            if ($teacher->profile && file_exists(public_path('school/images/' . $teacher->profile))) {
                @unlink(public_path('school/teachers/' . $teacher->profile));
            }
            $teacher->delete();
            return redirect()->route('admin.teacher.index')->with('message', 'Teacher Delete Successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.teacher.index')->with('error', $e->getMessage());
        }

    }
    public function getMajors($school_id)
    {
        $objSchool = new School();
        $school = $objSchool::find($school_id);
        $majors = $school->majors;
        return response()->json($majors);
    }

    public function teacherSearch(Request $request)
    {
        $search_string = $request->search_string;
        $teacherQuery = Teacher::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $teachers = $teacherQuery->orderBy('id', 'desc')->paginate(10);
        if ($teachers->count() >= 1) {
            return view('dashboard::school.teacher.partials.tableInformation.teacherTable', compact('teachers'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
