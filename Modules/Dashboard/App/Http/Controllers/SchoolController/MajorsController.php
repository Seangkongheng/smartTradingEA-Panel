<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Major;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SchoolHasMajor;

class MajorsController extends Controller
{

    public function index()
    {
        $majors = Major::orderBy('id', 'desc')->paginate(12);

        return view('dashboard::school.majors.index', compact('majors'));
    }


    public function create()
    {
        $schools = School::orderBy('id', 'desc')->pluck('kh_name', 'id');
        return view('dashboard::school.majors.createOrUpdate', compact("schools"));
    }


    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|string',
            'school_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // user create
            $major = Major::create([
                'name' => $request->name,
            ]);

            // school has major
            SchoolHasMajor::create([
                'major_id' => $major->id,
                'school_id' => $request->school_id
            ]);

            DB::commit();
            return redirect()->route('admin.major.index')->with('message', 'មុខវិទ្យាបង្កើតជោគជ័យ!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $schools = School::orderBy('id', 'desc')->pluck('kh_name', 'id');
        $majorEdit = Major::findOrFail($id);
        return view('dashboard::school.majors.createOrUpdate', compact("majorEdit", "schools"));
    }

    public function update(Request $request, $id)
    {
        try{
            $major = Major::findOrFail($id);
            $major->update([
                'name' => $request->name,
            ]);

            SchoolHasMajor::updateOrCreate(
                ['major_id' => $major->id],
                ['school_id' => $request->school_id]
            );
            return redirect()->route('admin.major.index')->with("message", "មុខវិទ្យាកែប្រែជោគជ័យ");
        }catch(Exception $e){
             return redirect()->route('admin.major.index')->with("error", $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try{
            $major = Major::findOrFail($id);
            $major->schools()->detach();
            $major->delete();
            return redirect()->route('admin.major.index')->with("message", "មុខវិទ្យាលុបជោគជ័យ");
        }catch(Exception $e){
            return redirect()->route('admin.major.index')->with("error", $e->getMessage());
        }
    }

    public function majorSearch(Request $request){
        $search_string = $request->search_string;

        $majorQuery = Major::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $majors = $majorQuery->orderBy('id', 'desc')->paginate(10);
        if ($majors->count() >= 1) {
            return view('dashboard::school.majors.partials.tableInformation.majorTable', compact('majors'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
