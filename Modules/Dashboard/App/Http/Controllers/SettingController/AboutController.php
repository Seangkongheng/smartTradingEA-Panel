<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\AboutUs;

class AboutController extends Controller
{
    public function index()
    {
        return view('dashboard::index');
    }

    public function create()
    {
        return view('dashboard::create');
    }

    public function store(Request $request)
    {

        try{
            $request->validate([
                'name'=>"required",
                'description'=>"required",
                'logo'=>"required"
            ]);

            $icon = null;
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $icon = "icon". '-' . $file->getClientOriginalName();
                $file->move(public_path('aboutImages/icon/'), $icon);
            }

            $logo = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logo = "logo". '-' . $file->getClientOriginalName();
                $file->move(public_path('aboutImages/logo/'), $logo);
            }


            // slider image
            $slider = [];
            $sliderName = null;
            if ($request->hasFile('slider')) {
                foreach ($request->file('slider') as $file) {
                    $sliderName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('aboutImages/slider/'), $sliderName);
                    $slider[] = $sliderName;
                }
            };

            AboutUs::create([
                'name'=>$request->name,
                'logo'=>$logo,
                'icon'=>$icon,
                'slider'=>json_encode($slider),
                'description'=>$request->description
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Created successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        $aboutUsEdit = AboutUs::find($id);
        return view('dashboard::aboutUs.edit',compact('aboutUsEdit'));
    }


    public function update(Request $request, $id)
    {
        try{
            $aboutUs = AboutUs::findOrFail($id);
            $iconName = $aboutUs->icon;
            // upload new logo if exists
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $iconName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('aboutImages/icon/'), $iconName);

                if ($aboutUs->icon && file_exists(public_path('aboutImages/icon/' . $aboutUs->icon))) {
                    unlink(public_path('aboutImages/icon/' . $aboutUs->icon));
                }
            }


             $logoName = $aboutUs->logo;
            // upload new logo if exists
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logoName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('aboutImages/logo/'), $logoName);

                if ($aboutUs->icon && file_exists(public_path('aboutImages/logo/' . $aboutUs->logo))) {
                    unlink(public_path('aboutImages/logo/' . $aboutUs->logo));
                }
            }


            $slider = [];
            if ($request->hasFile('slider')) {
                // Delete old slider images
                if (!empty($aboutUs->slider)) {
                    $oldSlider = json_decode($aboutUs->slider, true) ?? [];
                    foreach ($oldSlider as $oldImage) {
                        $oldImagePath = public_path('aboutImages/slider/' . $oldImage);
                        if (file_exists($oldImagePath)) {
                            @unlink($oldImagePath);
                        }
                    }
                }

                // Save new slider images
                foreach ($request->file('slider') as $file) {
                    $sliderName = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('aboutImages/slider/'), $sliderName);
                    $slider[] = $sliderName;
                }
            } else {
                if (!empty($aboutUs->slider)) {
                    $slider = json_decode($aboutUs->slider, true) ?? [];
                }
            }

            $aboutUs->update([
                'name' => $request->name,
                'description'=>$request->description,
                'icon'=>$iconName,
                'logo'=>$logoName,
                'slider'=>json_encode($slider),
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Updated Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
             $about = AboutUs::find($id);
            // delete image from folder
            if ($about->icon && file_exists(public_path('aboutImages/icon' . $about->icon))) {
                @unlink(public_path('aboutImages/icon/' . $about->icon));
            }
            if ($about->logo && file_exists(public_path('aboutImages/logo' . $about->logo))) {
                @unlink(public_path('aboutImages/logo/' . $about->logo));
            }
            if ($about->logo && file_exists(public_path('aboutImages/slider' . $about->slider))) {
                @unlink(public_path('aboutImages/slider/' . $about->slider));
            }

            $about->delete();
            return redirect()->route('admin.setting.index')->with('message', 'Delete Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }

    }
}
