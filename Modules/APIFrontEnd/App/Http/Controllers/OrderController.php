<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\APIFrontEnd\App\Models\Order;
use Modules\APIFrontEnd\App\Models\OrderItem;
use Modules\Dashboard\App\Models\MarketplacePlan;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        try {
            $request->validate([
                'marketplace_id' => 'required|exists:marketplaces,id',
                'marketplace_plan_id' => 'required|exists:marketplace_plans,id',
                'bank_account_name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/']
            ]);
            $user = $request->user();

            $marketplacePlan = MarketplacePlan::findOrFail(
                $request->marketplace_plan_id
            );

            $order = Order::create([
                'user_id' => $user->id,
                'bank_account_name' => $request->bank_account_name,
                'total_price' => $marketplacePlan->price,
                'status' => 'pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'marketplace_id' => $request->marketplace_id,
                'marketplace_plan_id' => $marketplacePlan->id,
                'price' => $marketplacePlan->price,
            ]);

            return response()->json([
                'message' => 'Order submitted successfully',
                'uuid' => $order->uuid,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function OrderDetail($uuid)
    {
        try {
            $orderDetail = Order::with('items.marketplacePlan', 'items.marketplace')->where('uuid',$uuid);

            return response()->json([
                'order-detail' => $orderDetail,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmPayment($uuid)
    {
        try {
            $order = Order::where('uuid',$uuid)->first();

            if ($order->status !== 'pending') {
                return response()->json(['message' => 'Invalid order state'], 400);
            }
            $order->update([
                'status' => 'awaiting_verification',
                'payment_confirmed_at' => now()
            ]);
            return response()->json(['message' => 'Payment confirmed']);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }






}
