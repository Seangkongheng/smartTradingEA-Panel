<?php

namespace Modules\Dashboard\App\Http\Controllers\MembershipController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\Membership;
use Modules\APIFrontEnd\App\Models\MembershipAccount;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('accounts')->paginate(15);

        return view('dashboard::membership.index', compact('memberships'));
    }

    public function create()
    {
        return view('dashboard::membership.createOrUpdate');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $membership = Membership::with('accounts')->find($id);

        return view('dashboard::membership.show', compact('membership'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search_string;
        $status = $request->status;

        $memberships = Membership::whereHas('user', function ($query) use ($search_string) {
            $query->where('email', 'like', '%'.$search_string.'%')
                ->orWhere('first_name', 'like', '%'.$search_string.'%');
        });

        // Apply status filter if provided
        if ($status == 1) {
            $memberships->where('status', 'pending');
        } elseif ($status == 2) {
            $memberships->where('status', 'confirmed');
        } elseif ($status == 3) {
            $memberships->where('status', 'rejected');
        }

        $memberships = $memberships->orderBy('id', 'desc')->paginate(10);

        if ($memberships->count() >= 1) {
            return view('dashboard::membership.partials.tableInformation.productTable', compact('memberships'))->render();
        } else {
            return response()->json([
                'status' => 'Nothing found',
            ]);
        }
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
            $user_id = Auth()->user()->id;

            $data = [
                'status' => $request->status,
            ];

            // CONFIRMED
            if ($request->status === 'confirmed') {
                $data['license_key'] = $request->license_key;
                $data['approved_by'] = $user_id;
                $data['approved_at'] = Carbon::now('Asia/Phnom_Penh');

                // clear reject fields
                $data['rejected_by'] = null;
                $data['rejected_at'] = null;
            }

            // REJECTED
            if ($request->status === 'rejected') {
                $data['rejected_by'] = $user_id;
                $data['rejected_at'] = Carbon::now('Asia/Phnom_Penh');

                // clear approve fields
                $data['approved_by'] = null;
                $data['approved_at'] = null;
            }

            // PENDING
            if ($request->status === 'pending') {
                $data['approved_by'] = null;
                $data['approved_at'] = null;
                $data['rejected_by'] = null;
                $data['rejected_at'] = null;
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
