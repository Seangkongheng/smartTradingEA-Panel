<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Dashboard\App\Models\Education;
use Modules\Dashboard\App\Models\EducationCategory;

class EducationController extends Controller
{
    public function index()
    {
        // $educations = Edducation::with where('is_public',1)->get();
        return view('apifrontend::index');
    }

    public function getCategory()
    {
        $categories = EducationCategory::all();

        return response()->json($categories);
    }

    public function getVideosByCategory($categoryId)
    {
        $videos = Education::where('education_category_id', $categoryId)->get();

        return response()->json($videos);
    }


}
