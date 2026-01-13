<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\ClassCategory;
use Modules\Dashboard\App\Models\Classes as ModelsClasses;
use Modules\Dashboard\App\Models\Classes;
use Modules\Dashboard\App\Models\ClassHasClassCategory;
use Modules\Dashboard\App\Models\School;
use Modules\Dashboard\App\Models\SchoolHasClass;

class ClassController extends Controller
{
    // Noted : This function for display class list
    public function index()
    {
        $classes = Classes::orderBy('id','desc')->paginate(12);
        return view('dashboard::school.class.index',compact('classes'));
    }


    // Noted : This function for create class
    public function create()
    {
        $schools = School::orderBy('id', 'desc')->pluck('kh_name', 'id');
        $categories = ClassCategory::orderBy('id', 'desc')->get();
        return view('dashboard::school.class.createOrUpdate', compact('categories', 'schools'));
    }


    // Noted : This function for store class
    public function store(Request $request)
    {
        try {
            // validation
            $request->validate([
                'name' => 'required|string',
                'category_id' => 'required'
            ]);

            DB::beginTransaction();
            try {
                // user create
                $class = Classes::create([
                    'name' => $request->name,
                ]);

                foreach ($request->category_id as $cateId) {
                    ClassHasClassCategory::create([
                        'class_id' => $class->id,
                        'class_category_id' => $cateId
                    ]);
                }

                // school has class
                SchoolHasClass::create([
                    'class_id' => $class->id,
                    'school_id' => $request->school_id
                ]);


                DB::commit();
                return redirect()->route('admin.class.index')->with('message', 'Class Created Successfully!');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        $classEdit = Classes::findOrFail($id);
        $categories = ClassCategory::orderBy('id', 'desc')->get();
        $schools = School::orderBy('id', 'desc')->pluck('kh_name', 'id');
        $selectedCategoryIds = $classEdit->category->pluck('id')->toArray();
        return view('dashboard::school.class.createOrUpdate', compact('categories', 'classEdit', 'schools', 'selectedCategoryIds'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $class = Classes::findOrFail($id);

            // Update class name
            $class->update([
                'name' => $request->name,
            ]);

            $class->category()->sync($request->category_id);
            SchoolHasClass::updateOrCreate(
                ['class_id' => $class->id],
                ['school_id' => $request->school_id]
            );

            DB::commit();
            return redirect()->route('admin.class.index')->with('message', 'Class updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.class.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }



    public function destroy($id)
    {
        try {
            $class = Classes::findOrFail($id);
            $class->schools()->detach();
            $class->category()->detach();
            $class->delete();
            return redirect()->route('admin.class.index')->with('message', 'Class Delete successfully!');
        } catch (Exception $e) {
            return redirect()->route('admin.class.index')->with('error', $e->getMessage());
        }
    }

    public function classSearch(Request $request)
    {
        $search_string = $request->search_string;
        $classQuery = Classes::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $classes = $classQuery->orderBy('id', 'desc')->paginate(10);
        if ($classes->count() >= 1) {
            return view('dashboard::school.class.partials.tableInformation.classTable', compact('classes'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
