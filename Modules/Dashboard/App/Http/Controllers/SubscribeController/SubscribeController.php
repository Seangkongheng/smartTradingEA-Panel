<?php

namespace Modules\Dashboard\App\Http\Controllers\SubscribeController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\Order;
use Modules\APIFrontEnd\App\Models\UserSubcription;
use Carbon\Carbon;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subscriptions = UserSubcription::with([
            'marketplace',
            'subscriptionPlan',
            'marketplace.plans',
        ])
            ->get();

        return view('dashboard::subscribe.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::subscribe.createOrUpdate');
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
        $subscription = UserSubcription::find($id);

        return view('dashboard::subscribe.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $subscription = UserSubcription::find($id);
            $order = Order::find($subscription->order_id);
            $subscription->update([
                'status' => $request->status,
                'confirmation_date' => Carbon::now('Asia/Phnom_Penh'),
            ]);

            $order->update([
                'status' => $request->status,

            ]);

            return redirect()->route('admin.subscribes.index')->with('message', 'Subscribes Updated');
        } catch (Exception $e) {
            return redirect()->route('admin.subscribes.index')->with('error', $e->getMessage());
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
