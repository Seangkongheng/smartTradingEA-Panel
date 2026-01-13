<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\SettingTitle;

class SectionTtitleController extends Controller
{

    public function edit($id)
    {

        $settingEdit =SettingTitle::find($id);
        return view('dashboard::settingTitle.edit',compact('settingEdit'));
    }

    public function update(Request $request, $id)
    {
         try{

            $settingTitle = SettingTitle::findOrFail($id);
            $logoNmae = $settingTitle->logo;
            $header_backgroundName = $settingTitle->header_background;

            // upload new logo if exists
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logoNmae = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/'), $logoNmae);

                if ($settingTitle->logo && file_exists(public_path('images/' . $settingTitle->logo))) {
                    unlink(public_path('images/' . $settingTitle->logo));
                }
            }


            // upload new logo if exists
            if ($request->hasFile('header_background')) {
                $file = $request->file('header_background');
                $header_backgroundName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/'), $header_backgroundName);

                if ($settingTitle->icon && file_exists(public_path('images/' . $settingTitle->header_background))) {
                    unlink(public_path('images/' . $settingTitle->header_background));
                }
            }
            $settingTitle->update([
                'title' => $request->title,
                'description' => $request->description,
                'header_background' => $header_backgroundName,
                'logo' => $logoNmae,
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Title Updated Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }
}
