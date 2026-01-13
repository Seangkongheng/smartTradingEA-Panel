<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolPartner;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\Project;
use Modules\Dashboard\App\Models\Province;
use Modules\Dashboard\App\Models\SchoolPartner;

class SchoolPartnerController extends Controller
{
    public function index()
    {
        $schoolPartners = SchoolPartner::orderBy('id', 'desc')->paginate(12);
        $provinces = Province::select('id', 'kh_name')->get();
        return view('dashboard::schoolPartner.schoolPartner.index', compact('schoolPartners', 'provinces'));
    }

    public function analytice()
    {
        return view('dashboard::schoolPartner.schoolPartner.analytices');
    }
    public function create()
    {
        $projects = Project::with('schoolParter')->get();
        $provinces = Province::with('schoolParter')->get();

        return view('dashboard::schoolPartner.schoolPartner.createOrUpdate', compact('projects', 'provinces'));
    }

    public function store(Request $request)
    {
        // dd($request->input());

        // validation
        $request->validate([
            'kh_name' => 'required|string',
            'en_name' => 'required|string',
            'province_id' => 'required',
            'project_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // user create
            $schoolPartner = schoolPartner::create([

                'kh_name' => $request->kh_name,
                'en_name' => $request->en_name,
                'province_id' => $request->province_id,
                'project_id' => $request->project_id,
            ]);

            DB::commit();
            return redirect()->route('admin.school-partner.index')->with('message', 'សាលាបានបង្កើតបានជោគជ័យ!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Noted : This function show edit page
    public function edit($id)
    {
        $projects = Project::with('schoolParter')->get();
        $provinces = Province::with('schoolParter')->get();
        $schoolPartnersEdit = schoolPartner::findOrFail($id);

        return view('dashboard::schoolPartner.schoolPartner.createOrUpdate', compact('schoolPartnersEdit', 'projects', 'provinces'));
    }

    // Noted : This function for update
    public function update(Request $request, $id)
    {
        try {
            $schoolPartner = schoolPartner::findOrFail($id);
            $schoolPartner->update([
                'kh_name' => $request->kh_name,
                'en_name' => $request->en_name,
                'province_id' => $request->province_id,
                'project_id' => $request->project_id,
            ]);
            return redirect()->route('admin.school-partner.index')->with('message', 'សាលាបានកែប្រែបានជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.school-partner.index')->with('error', $e->getMessage());
        }
    }


    // Noted : This funciton for delete
    public function destroy($id)
    {
        try {
            $schoolPartner = schoolPartner::findOrFail($id);
            $schoolPartner->delete();
            return redirect()->route('admin.school-partner.index')->with('message', 'សាលារៀនបានលុបបានជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.school-partner.index')->with('error', $e->getMessage());
        }
    }


    // Noted : This funciton for search
    public function schoolPartnerSearch(Request $request)
    {
        $search_string = $request->search_string;
        $schoolPartnerQuery = schoolPartner::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $schoolPartners = $schoolPartnerQuery->orderBy('id', 'desc')->paginate(10);
        if ($schoolPartners->count() >= 1) {
            return view('dashboard::schoolPartner.schoolPartner.partials.tableInformation.schoolPartnerTable', compact('schoolPartners'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
