<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolPartner;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\MajorPartner;
use Modules\Dashboard\App\Models\Project;
use Modules\Dashboard\App\Models\SchoolPartner;
use Modules\Dashboard\App\Models\TeacherPartner;

class TeacherPartnerController extends Controller
{
    public function index()
    {
        $teachers = TeacherPartner::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::schoolPartner.teacher.index', compact('teachers'));
    }


    public function create()
    {
        $projects = Project::select('id', 'name')->get();
        return view('dashboard::schoolPartner.teacher.createOrUpdate', compact("projects"));
    }


    public function store(Request $request)
    {

        // validation
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'project_id' => 'required',
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
            $teacher = TeacherPartner::create([
                'title' => $request->title,
                'name' => $request->name,
                'project_id' => $request->project_id,
                'profile' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('admin.teacher-partner.index')->with('message', 'គ្រូបង្រៀនបង្កើតបានជោគជ័យ!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $teacher = TeacherPartner::findOrFail($id);
        return view('dashboard::schoolPartner.teacher.show', compact("teacher"));
    }


    public function edit($id)
    {
        $teacherEdit = TeacherPartner::findOrFail($id);
        $projects = Project::all();

        return view('dashboard::schoolPartner.teacher.createOrUpdate', compact('teacherEdit', 'projects'));
    }

    // Function update teacher
    public function update(Request $request, $id)
    {
        try {
            $teacher = TeacherPartner::findOrFail($id);
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
                'project_id' => $request->project_id,
                'profile' => $imageName,
            ]);

            return redirect()->route('admin.teacher-partner.index')->with('message', 'គ្រូបង្រៀនកែប្រែបានជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.teacher-partner.index')->with('error', $e->getMessage());
        }
    }


    // Function delete teacher
    public function destroy($id)
    {
        try {
            $teacher = TeacherPartner::findOrFail($id);
            if ($teacher->profile && file_exists(public_path('school/images/' . $teacher->profile))) {
                @unlink(public_path('school/teachers/' . $teacher->profile));
            }
            $teacher->delete();
            return redirect()->route('admin.teacher-partner.index')->with('message', 'គ្រូបង្រៀនបានលុបដោយជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.teacher-partner.index')->with('error', $e->getMessage());
        }

    }
    public function getMajors($school_id)
    {
        $objSchool = new SchoolPartner();
        $school = $objSchool::find($school_id);
        $majors = $school->majors;
        return response()->json($majors);
    }

    public function teacherSearch(Request $request)
    {
        $search_string = $request->search_string;
        $teacherQuery = TeacherPartner::where(function ($query) use ($search_string) {
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
