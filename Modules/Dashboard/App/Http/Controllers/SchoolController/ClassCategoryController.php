<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\ClassCategory;

class ClassCategoryController extends Controller
{

      public function index()
    {
        $classCategories = ClassCategory::orderBy('id','desc')->paginate(12);
        return view('dashboard::school.classCategory.index',compact('classCategories'));
    }


    public function create()
    {
          return view('dashboard::school.classCategory.createOrUpdate');
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
            $category = ClassCategory::create([
                'name' => $request->name,
            ]);
            DB::commit();
            return redirect()->route('admin.category.index')->with('message', 'Category created successfully!');
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
        $categoryEdit = ClassCategory::findOrFail($id);
         return view('dashboard::school.classCategory.createOrUpdate',compact('categoryEdit'));
    }


    public function update(Request $request, $id)   {
        try{
            $category = ClassCategory::findOrFail($id);
            $category->update([
            'name' => $request->name,
            ]);
            return redirect()->route('admin.category.index')->with('message', 'Category Update successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.category.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
            $category = ClassCategory::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.category.index')->with('message', 'Category Delete successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.category.index')->with('error', $e->getMessage());
        }

    }

    public function categorySearch(Request $request){
        $search_string = $request->search_string;
        $CategoryQuery = ClassCategory::where(function ($query) use ($search_string) {
            $query->where('name', 'like', '%' . $search_string . '%');
        });

        $classCategories = $CategoryQuery->orderBy('id', 'desc')->paginate(10);
        if ($classCategories->count() >= 1) {
            return view('dashboard::school.classCategory.partials.tableInformation.classCategoryTable', compact('classCategories'))->render();
        } else {
            return response()->json([
                'status' => "Nothing found",
            ]);
        }
    }
}
