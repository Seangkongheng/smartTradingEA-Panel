<?php

namespace Modules\Dashboard\App\Http\Controllers\StudentController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(28);
        return view('dashboard::student.index', compact('students'));
    }

    public function create()
    {
        return view('dashboard::student.createOrUpdate');
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $schoolPartnerId = $request->school_partner_id;
        $schoolName = $request->school_name;

        // If selected "inputschool"
        if ($schoolPartnerId === "inputschool") {
            $schoolPartnerId = null;
        } else {
            $schoolName = null;
        }

        // // validation
        $request->validate([
            'name' => 'required|string',
            'class_level_id' => 'required',
            'province_id' => 'required',
            'school_partner_id' => 'required',
            // 'school_name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // user create
            Student::create([
                'name' => $request->name,
                'class_level_id' => $request->class_level_id,
                'province_id' => $request->province_id,
                'school_partner_id' => $schoolPartnerId,
                'school_name' => $schoolName,
            ]);
            //  dd($project);

            DB::commit();
            return redirect()->back()->with('message', 'project created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        $studentsEdit = Student::findOrFail($id);

        return view('dashboard::student.createOrUpdate', compact('studentsEdit'));
    }

    public function update(Request $request, $id)
    {
        try {
            $project = Student::findOrFail($id);
            $project->update([
                'name' => $request->name,
                'class_level_id' => $request->class_level_id,
                'province_id' => $request->province_id,
                'school_partner_id' => $request->school_partner_id,
                'school_name' => $request->school_name,
            ]);
            return redirect()->route('admin.student.index')->with('message', 'project Update successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.student.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $project = Student::findOrFail($id);
            $project->delete();
            return redirect()->route('admin.student.index')->with('message', 'project Delete successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.student.index')->with('error', $e->getMessage());
        }
    }

    public function studentsearch(Request $request)
    {
        $search_string = $request->search_string;
        $projectQuery = Student::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $students = $projectQuery->orderBy('id', 'desc')->paginate(10);
        if ($students->count() >= 1) {
            return view('dashboard::student.partials.tableInformation.studentTable', compact('students'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
