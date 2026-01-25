{{-- Modern Order Details Page --}}
<div class="min-h-screenpy-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- Header & Status --}}
        {{-- Order Header & Status - Tailwind Redesign --}}
        <div
            class="bg-white rounded-2xl shadow-lg p-6 md:p-8 flex flex-col md:flex-row md:justify-between md:items-center gap-6">

            {{-- Order Info --}}
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Order #{{ $order->id }}</h1>
                <p class="text-sm md:text-base text-slate-500">
                    Placed on <span class="font-medium text-slate-700">{{ $order->created_at->format('F d, Y \a\t H:i')
                        }}</span>
                </p>
                <p class="text-sm md:text-base text-slate-500">
                    Customer: <span class="font-medium text-slate-700">{{ $order->user->first_name }} {{
                        $order->user->last_name }}</span>
                    (<span class="font-medium text-slate-700">{{ $order->user->email }}</span>)
                </p>
            </div>

            {{-- Order Status --}}
            @php
            $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'confirmed' => 'bg-blue-100 text-blue-800 border-blue-200',
            'paid' => 'bg-green-100 text-green-800 border-green-200',
            'canceled' => 'bg-red-100 text-red-800 border-red-200'
            ];
            $statusColor = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
            @endphp
            <div class="mt-4 md:mt-0">
                <span
                    class="inline-block px-6 py-2 rounded-full text-sm font-semibold border-2 {{ $statusColor }} shadow-sm">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>


        {{-- Grid Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: Payment & Shipping --}}
            <div class="space-y-6">

                {{-- Payment Card --}}
                <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                        Payment Info
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-slate-600">Status</span>
                            @php
                            $paymentStatusColors = [
                            'paid' => 'bg-green-100 text-green-700',
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'failed' => 'bg-red-100 text-red-700'
                            ];
                            $paymentColor = $paymentStatusColors[$order->payment_status ?? 'pending'] ?? 'bg-gray-100
                            text-gray-700';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $paymentColor }}">
                                {{ ucfirst($order->payment_status ?? 'Pending') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-slate-600">Method</span>
                            <span class="font-medium text-slate-900">{{ $order->payment_method ?? 'N/A' }}</span>
                        </div>
                        <div class="pt-4 border-t border-slate-200 flex justify-between items-center">
                            <span class="font-semibold text-slate-900">Total Amount</span>
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($order->total ?? 0, 2)
                                }}</span>
                        </div>
                    </div>
                </div>



            </div>

            {{-- Right Column: Order Items + Update Status --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Order Items --}}
                <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Order Items
                    </h2>
                    <div class="space-y-4">
                        @forelse($order->items as $item)
                        <div
                            class="flex items-center gap-4 p-4 rounded-lg bg-slate-50 border border-slate-200 hover:border-purple-300 transition">
                            <div
                                class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-violet-600 flex items-center justify-center text-white font-semibold">
                                {{ $loop->iteration }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-slate-900">{{ $item->marketplace->title ?? 'Marketplace
                                    N/A' }}</h3>
                                <p class="text-sm text-slate-600">Plan: <span class="font-medium text-slate-900">{{
                                        $item->marketplacePlan->name ?? 'No plan' }}</span></p>
                                <p class="text-purple-600 font-semibold">${{ number_format($item->price ?? 0, 2) }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-slate-400">
                            <p class="font-medium">No items in this order</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Update Status --}}
                <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Update Order Status
                    </h2>
                    <form action="" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <select name="status"
                            class="w-full px-4 py-3 rounded-lg border-2 border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-slate-900 font-medium outline-none">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                        </select>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-semibold py-3 rounded-lg transition transform hover:scale-105 shadow-lg">
                            Update Status
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>
