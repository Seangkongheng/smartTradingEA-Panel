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

class MajorPartnerController extends Controller
{
    public function index()
    {
        $majors = MajorPartner::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::schoolPartner.majors.index', compact('majors'));
    }

    public function create()
    {
        $projects= Project::select('id','name')->get();
        return view('dashboard::schoolPartner.majors.createOrUpdate', compact("projects"));
    }


    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|string',
            'project_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // user create
            MajorPartner::create([
                'name' => $request->name,
                'project_id'=>$request->project_id,
            ]);


            DB::commit();
            return redirect()->route('admin.major-partner.index')->with('message', 'មុខវិទ្យាបង្កើតជោគជ័យ!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $majorEdit = MajorPartner::findOrFail($id);
        $projects= Project::select('id','name')->get();
        return view('dashboard::schoolPartner.majors.createOrUpdate', compact("majorEdit", "projects"));
    }

    public function update(Request $request, $id)
    {
        try {
            $major = MajorPartner::findOrFail($id);
            $major->update([
                'name' => $request->name,
                'project_id'=>$request->project_id
            ]);


            return redirect()->route('admin.major-partner.index')->with("message", "មុខវិទ្យាកែប្រែជោគជ័យ");
        } catch (Exception $e) {
            return redirect()->route('admin.major-partner.index')->with("error", $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $major = MajorPartner::findOrFail($id);
            $major->delete();
            return redirect()->route('admin.major-partner.index')->with("message", "មុខវិទ្យាលុបជោគជ័យ");
        } catch (Exception $e) {
            return redirect()->route('admin.major-partner.index')->with("error", $e->getMessage());
        }
    }

    public function majorSearch(Request $request)
    {
        $search_string = $request->search_string;

        $majorQuery = MajorPartner::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $majors = $majorQuery->orderBy('id', 'desc')->paginate(10);
        if ($majors->count() >= 1) {
            return view('dashboard::schoolPartner.majors.partials.tableInformation.majorTable', compact('majors'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
