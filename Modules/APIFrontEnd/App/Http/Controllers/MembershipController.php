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

    public function getMembership(Request $request)
    {
        $user = $request->user();
        $membership = Membership::with('accounts')->where('user_id', $user->id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $membership,
        ]);
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
    public function update(Request $request, $id)
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
