<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Dashboard\App\Models\Result;
use Modules\Dashboard\App\Models\ResultCategory;

class ResultCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('apifrontend::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCategory()
    {
        $categories = ResultCategory::select('id', 'name')->get();

        return response()->json($categories);
    }

    public function getPhotoByCategory($categoryId)
    {
        $results = Result::select('id', 'title', 'file', 'description')->where('result_category_id', $categoryId)->where('is_public', 1)->get();

        return response()->json($results);
    }
}
