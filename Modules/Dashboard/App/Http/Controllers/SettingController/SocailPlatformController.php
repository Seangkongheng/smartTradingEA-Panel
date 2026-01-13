<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\App\Models\SocailPlatform;

class SocailPlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = SocailPlatform::orderBy('id', 'desc')->paginate(12);
        return view('dashboard::platform.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::platform.createOrEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        DB::beginTransaction();
        try {
            $imageName = null;
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $imageName = 'icon-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('icons'), $imageName);
            }
            SocailPlatform::create([
                'name' => $request->name,
                'link' => $request->link,
                'icon' => $imageName
            ]);

            DB::commit();
            return redirect()->route('admin.setting.index')->with('message', 'Created Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create platform: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
         $plateformEdit = SocailPlatform::findOrFail($id);
         return view('dashboard::platform.createOrEdit',compact('plateformEdit'));
    }


    public function update(Request $request, $id)
    {
        try{
            $platform= SocailPlatform::findOrFail($id);
            $imageName = $platform->icon;

            // upload new logo if exists
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('icons/'), $imageName);

                if ($platform->icon && file_exists(public_path('icons/' . $platform->icon))) {
                    unlink(public_path('icons/' . $platform->icon));
                }
            }
            $platform->update([
                'name' => $request->name,
                'link' => $request->link,
                'icon' => $imageName
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Updated Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
         try{
            $platform= SocailPlatform::findOrFail($id);
            if ($platform->icon && file_exists(public_path('icons' . $platform->icon))) {
                @unlink(public_path('icon/' . $platform->icon));
            }
            $platform->delete();
            return redirect()->route('admin.setting.index')->with('message', 'Delete Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }

    }
}
