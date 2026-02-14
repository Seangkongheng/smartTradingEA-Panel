<?php

namespace Modules\Dashboard\App\Http\Controllers\MembershipController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\Membership;
use Modules\APIFrontEnd\App\Models\MembershipAccount;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::with('accounts')->get();

        return view('dashboard::membership.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::membership.createOrUpdate');
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

        $membership = Membership::with('accounts')->find($id);

        return view('dashboard::membership.show', compact('membership'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          
            'license_key' => $request->status === 'confirmed'
                ? 'required|string|max:255'
                : 'nullable',
        ]);

        try {
            $membership = Membership::findOrFail($id);

            $data = [
                'status' => $request->status,
            ];

            // CONFIRMED
            if ($request->status === 'confirmed') {
                $data['license_key'] = $request->license_key;
                $data['approved_by'] = auth()->user()->name ?? null;
                $data['approved_at'] = Carbon::now('Asia/Phnom_Penh');

                // clear reject fields
                $data['rejected_by'] = null;
                $data['rejected_at'] = null;
            }

            // REJECTED
            if ($request->status === 'rejected') {
                $data['rejected_by'] = auth()->user()->name ?? null;
                $data['rejected_at'] = Carbon::now('Asia/Phnom_Penh');

                // clear approve fields
                $data['approved_by'] = null;
                $data['approved_at'] = null;
                $data['license_key'] = null;
            }

            // PENDING
            if ($request->status === 'pending') {
                $data['approved_by'] = null;
                $data['approved_at'] = null;
                $data['rejected_by'] = null;
                $data['rejected_at'] = null;
                $data['license_key'] = null;
            }

            $membership->update($data);

            return redirect()
                ->route('admin.membership.show', $membership->id)
                ->with('success', 'Membership status updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: '.$e->getMessage());
        }
    }

    public function updateAcountStatus(Request $request, $accountId)
    {

        try {
            $account = MembershipAccount::findOrFail($accountId);
            $account->update(['status' => $request->status]);

            return redirect()
                ->route('admin.membership.show', $account->membership_id)
                ->with('success', 'Account status updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $membership = Membership::findOrFail($id);
            $membership->accounts()->delete();
            $membership->delete();

            return redirect()->route('admin.membership.index')->with('success', 'Membership deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: '.$e->getMessage());
        }

    }
}
