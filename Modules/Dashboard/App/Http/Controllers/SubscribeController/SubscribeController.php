<?php

namespace Modules\Dashboard\App\Http\Controllers\SubscribeController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\APIFrontEnd\App\Models\Order;
use Modules\APIFrontEnd\App\Models\UserSubcription;

class SubscribeController extends Controller
{
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

    public function show($id)
    {
        $subscription = UserSubcription::find($id);

        return view('dashboard::subscribe.show', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        try {

            $subscription = UserSubcription::with('subscriptionPlan')->findOrFail($id);

            $planName = strtolower($subscription->subscriptionPlan?->name);

            $now = Carbon::now('Asia/Phnom_Penh');

            $expire_date = null;

            if ($planName === 'monthly') {
                $expire_date = $now->copy()->addMonth();
            }

            if ($planName === 'yearly') {
                $expire_date = $now->copy()->addYear();
            }

            $subscription->update([
                'status' => $request->status,
                'confirmation_date' => $now,
                'expire_date' => $expire_date,
            ]);

            $order = Order::find($subscription->order_id);
            $order?->update([
                'status' => $request->status,
            ]);

            return redirect()
                ->route('admin.subscribes.index')
                ->with('message', 'Subscription Updated');

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.subscribes.index')
                ->with('error', $e->getMessage());
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
