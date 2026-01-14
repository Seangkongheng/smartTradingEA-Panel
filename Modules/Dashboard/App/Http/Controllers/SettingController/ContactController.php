<?php

namespace Modules\Dashboard\App\Http\Controllers\SettingController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public function index()
    {
        return view('dashboard::contact.index');
    }


    public function create()
    {
      return view('dashboard::contact.createOrUpdate');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'value' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $imageName = null;
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $imageName = "icon". '-' . $file->getClientOriginalName();
                $file->move(public_path('icons'), $imageName);
            }

            // user create
            $contact = Contact::create([
                'name' => $request->name,
                'value' => $request->value,
                'icon' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('admin.setting.index')->with('message', 'Contact Created Successfully!');
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
         $contactEdit = Contact::findOrFail($id);
         return view('dashboard::contact.edit',compact('contactEdit'));
    }


    public function update(Request $request, $id)
    {
        try{
            $contact = Contact::findOrFail($id);
            $imageName = $contact->icon;

            // upload new logo if exists
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('icons/'), $imageName);

                if ($contact->icon && file_exists(public_path('icons/' . $contact->icon))) {
                    unlink(public_path('icons/' . $contact->icon));
                }
            }
            $contact->update([
                'name' => $request->name,
                'icon' => $imageName,
                'value' => $request->value,
            ]);

            return redirect()->route('admin.setting.index')->with('message', 'Contact Updated Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try{
            $contact= Contact::findOrFail($id);
            if ($contact->icon && file_exists(public_path('icons' . $contact->icon))) {
                @unlink(public_path('icon/' . $contact->icon));
            }
            $contact->delete();
            return redirect()->route('admin.setting.index')->with('message', 'Contact Delete Successfully!');
        }catch(Exception $e){
            return redirect()->route('admin.setting.index')->with('error', $e->getMessage());
        }

    }
}
