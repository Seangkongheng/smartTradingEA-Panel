<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Footer;

class FooterController extends Controller
{

    public function index()
    {
        // return view('dashboard::index');
    }


    public function create()
    {
        return view('dashboard::create');
    }


    public function store(Request $request)

    {
        try{
            $request->validate([
                'copyright'=>"required"
            ]);
            Footer::create([
                'copyright'=>$request->copyright,
                'description'=>$request->description
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Footer Created Successfully!');
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
          $footerEdit = Footer::findOrFail($id);
         return view('dashboard::footer.edit',compact('footerEdit'));
    }


    public function update(Request $request, $id)
    {
        try{
            $footer = Footer::findOrFail($id);
            $footer->update([
                'copyright' => $request->copyright,
                'description'=>$request->description
            ]);
            return redirect()->route('admin.setting.index')->with('message', 'Footer Update Successfully!');
        }catch(Exception $e){
              return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try{
            $footer= Footer::findOrFail($id);
            $footer->delete();
            return redirect()->route('admin.setting.index')->with('message', 'Footer Delete Successfully!');
        }catch(Exception $e){
           return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }
    }
}
