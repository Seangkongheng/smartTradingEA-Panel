<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\APIFrontEnd\App\Models\Membership;
use Modules\APIFrontEnd\App\Models\MembershipAccount;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('apifrontend::index');
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
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $request->validate([
                'exness_email' => 'required|email',
                'tradingview_username' => 'nullable|string',
                'account_numbers' => 'required|array|min:1|max:10',
                'account_numbers.*' => 'required|string',
                'note' => 'nullable|string|max:255',
            ]);
            $user = $request->user();

            // Noted Stop if membership already exists
            if (Membership::where('user_id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You already have a membership request.',
                ], 409);
            }

            $membership = Membership::create([
                'user_id' => $user->id,
                'exness_email' => $request->exness_email,
                'tradingview_username' => $request->tradingview_username,
                'note' => $request->note,
                'submitted_at' => Carbon::now('Asia/Phnom_Penh'),
                'status' => 'pending',
            ]);

            foreach ($request->account_numbers as $accountNumber) {
                MembershipAccount::create([
                    'membership_id' => $membership->id,
                    'account_number' => $accountNumber,
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Membership submitted successfully',
                'data' => $membership->load('accounts'),
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $membership = Membership::with('accounts')->findOrFail($id);

            // Only allow update if rejected
            if ($membership->status !== 'rejected') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Only rejected membership can be edited.',
                ], 403);
            }

            // Update main membership fields
            $membership->update([
                'exness_email' => $request->exness_email,
                'tradingview_username' => $request->tradingview_username,
                'note' => $request->note,
                'status' => 'pending', // reset status to pending after edit
                'submitted_at' => now(),
            ]);

            // Update accounts
            // Delete accounts that were removed
            $existingIds = $membership->accounts->pluck('id')->toArray();
            $newIds = array_filter(array_column($request->accounts, 'id'));
            $toDelete = array_diff($existingIds, $newIds);
            MembershipAccount::whereIn('id', $toDelete)->delete();

            // Update or create accounts
            foreach ($request->accounts as $acc) {
                if (! empty($acc['id'])) {
                    MembershipAccount::find($acc['id'])->update(['account_number' => $acc['account_number']]);
                } else {
                    MembershipAccount::create([
                        'membership_id' => $membership->id,
                        'account_number' => $acc['account_number'],
                        'status' => 'pending',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Membership updated successfully',
                'data' => $membership->load('accounts'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getMembership(Request $request)
    {
        $user = $request->user();
        $membership = Membership::with('accounts')->where('user_id', $user->id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $membership,
        ]);
    }
}
