<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        // $educations = Edducation::with where('is_public',1)->get();
        return view('apifrontend::index');
    }

    public function getCategory()
    {
        $categories = \Modules\Dashboard\App\Models\EducationCategory::all();

        return response()->json($categories);
    }

    public function getVideosByCategory($categoryId)
    {
        $videos = \Modules\Dashboard\App\Models\Education::where('education_category_id', $categoryId)->get();

        return response()->json($videos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apifrontend::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('apifrontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('apifrontend::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
