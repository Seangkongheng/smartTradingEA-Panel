<?php

namespace Modules\Dashboard\App\Http\Controllers\ProjectController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::project.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard::project.createOrUpdate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'logo' => 'required|file|mimes:png,jpg,jpeg|max:5120'
        ]);

        DB::beginTransaction();
        try {

            $fileName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('school/images'), $fileName);

            Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'logo' => $fileName,  // FIXED
            ]);

            DB::commit();
            return redirect()->route('admin.project.index')
                ->with('message', 'គម្រោងបានបង្កើតបានជោគជ័យ!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }



    public function edit($id)
    {
        $projectsEdit = Project::findOrFail($id);
        return view('dashboard::project.createOrUpdate', compact('projectsEdit'));
    }


    public function update(Request $request, $id)
    {
        try {

            $Project = Project::findOrFail($id);

            if ($request->has('logo')) {
                $fileName = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('school/images'), $fileName);
                $Project['logo'] = $fileName;
            }

            $Project->update([
                'name' => $request->name,
                'description' => $request->description,

            ]);
            return redirect()->route('admin.project.index')->with('message', 'classLevel Update successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.project.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return redirect()->route('admin.project.index')->with('message', 'ClassLevel Delete successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.project.index')->with('error', $e->getMessage());
        }
    }

    public function projectsearch(Request $request)
    {
        $search_string = $request->search_string;
        $projectQuery = Project::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $projects = $projectQuery->orderBy('id', 'desc')->paginate(10);
        if ($projects->count() >= 1) {
            return view('dashboard::project.partials.tableInformation.projectTable', compact('classLevels'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
