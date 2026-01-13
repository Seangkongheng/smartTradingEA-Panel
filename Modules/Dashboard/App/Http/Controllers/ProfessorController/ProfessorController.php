<?php

namespace Modules\Dashboard\App\Http\Controllers\ProfessorController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Major;
use Modules\Dashboard\App\Models\Professor;

class ProfessorController extends Controller
{

    public function index()
    {
        $professors=Professor::orderBy("id","desc")->paginate(12);
        return view('dashboard::professor.index',compact('professors'));
    }


    public function create()
    {
        $majors = Major::pluck('name', 'id');
        return view('dashboard::professor.createOrUpdate',compact('majors'));
    }


    public function store(Request $request)
    {

        // validation
        $request->validate([
            'title' => 'required|string',
            'quote' => 'required',
            'name' => 'required|string',
            'major_id' => 'required',
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
            $proffessor = Professor::create([
                'title' => $request->title,
                'name' => $request->name,
                'quote' => $request->quote,
                'major_id' => $request->major_id,
                'profile' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('admin.professor.index')->with('message', 'Professor Created Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $professor = Professor::findOrFail($id);
        return view('dashboard::professor.show', compact('professor'));
    }

    public function edit($id)
    {
        $professorEdit = Professor::findOrFail($id);
        $majors = Major::pluck('name', 'id');
        return view('dashboard::professor.createOrUpdate', compact('professorEdit', 'majors'));
    }

    // Function update teacher
    public function update(Request $request, $id)
    {
        try{
            $professor = Professor::findOrFail($id);
            $imageName = $professor->profile;

            // upload new logo if exists
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('school/teachers'), $imageName);

                if ($professor->profile && file_exists(public_path('school/teachers/' . $professor->profile))) {
                    unlink(public_path('school/teachers/' . $professor->profile));
                }
            }

            $professor->update([
                'title' => $request->title,
                'name' => $request->name,
                'quote' => $request->quote,
                'major_id' => $request->major_id,
                'profile' => $imageName,
            ]);

            return redirect()->route('admin.professor.index')->with('message', 'Professor Update Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.professor.index')->with('error', $e->getMessage());
        }

    }


    // Function delete professor
    public function destroy($id)
    {
        try{
            $professor = Professor::findOrFail($id);
            if ($professor->profile && file_exists(public_path('school/images/' . $professor->profile))) {
                @unlink(public_path('school/teachers/' . $professor->profile));
            }
            $professor->delete();
            return redirect()->route('admin.professor.index')->with('message', 'Professor Delete Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.professor.index')->with('error', $e->getMessage());
        }
    }

    public function professorSearch(Request $request)  {
        $search_string = $request->search_string;
        $professorQuery = Professor::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $professors = $professorQuery->orderBy('id', 'desc')->paginate(10);
        if ($professors->count() >= 1) {
            return view('dashboard::professor.partials.tableInformation.professorTable', compact('professors'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }

    }
}
