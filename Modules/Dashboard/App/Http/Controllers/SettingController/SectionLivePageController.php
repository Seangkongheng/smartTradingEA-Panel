<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\SettingLivePage;

class SectionLivePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $settingLivePageEdit =SettingLivePage::find($id);
        return view('dashboard::settingLivePage.edit',compact('settingLivePageEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         try{
            $settingLivePage = SettingLivePage::findOrFail($id);
            $imageName = $settingLivePage->image;

            // upload new logo if exists
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/'), $imageName);

                if ($settingLivePage->icon && file_exists(public_path('images/' . $settingLivePage->icon))) {
                    unlink(public_path('images/' . $settingLivePage->icon));
                }
            }
            $settingLivePage->update([
                'title' => $request->title,
                'image' => $imageName,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Contact Updated Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
