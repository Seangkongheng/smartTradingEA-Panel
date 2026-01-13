<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolPartner;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\ClassLevel;

class ClassLevelController extends Controller
{
    public function index()
    {
        $classLevels = ClassLevel::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::schoolPartner.classLevel.index', compact('classLevels'));
    }


    public function create()
    {
        return view('dashboard::schoolPartner.classLevel.createOrUpdate');
    }


    public function store(Request $request)
    {

        // validation
        $request->validate([
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // user create
            ClassLevel::create([
                'name' => $request->name,

            ]);

            DB::commit();
            return redirect()->route('admin.class-level.index')->with('message', 'ថ្នាក់បង្កើតជោគជ័យ!');
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
        $classLevelsEdit = ClassLevel::findOrFail($id);
        return view('dashboard::schoolPartner.classLevel.createOrUpdate', compact('classLevelsEdit'));
    }


    public function update(Request $request, $id)
    {
        try {
            $classLevel = ClassLevel::findOrFail($id);
            $classLevel->update([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.class-level.index')->with('message', 'ថ្នាក់កែប្រែបានជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.class-level.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $classLevel = ClassLevel::findOrFail($id);
            $classLevel->delete();
            return redirect()->route('admin.class-level.index')->with('message', 'ថ្នាក់បង្កើតបានជោគជ័យ!');
        } catch (Exception $e) {
            return redirect()->route('admin.class-level.index')->with('error', $e->getMessage());
        }
    }

    public function classLevelSearch(Request $request)
    {
        $search_string = $request->search_string;
        $classLevelQuery = ClassLevel::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $classLevels = $classLevelQuery->orderBy('id', 'desc')->paginate(10);
        if ($classLevels->count() >= 1) {
            return view('dashboard::schoolPartner.classLevel.partials.tableInformation.classLevelTable', compact('classLevels'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
