{{-- Subscription Details Page --}}
<div class="min-h-screen ">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <p class="text-sm text-slate-500">
                    Placed on
                    <span class="font-medium text-slate-700">
                        {{ $subscription->created_at->format('F d, Y \a\t H:i') }}
                    </span>
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    Customer:
                    <span class="font-medium text-slate-800">
                        {{ $subscription->user->first_name ?? 'Unknown' }}
                        {{ $subscription->user->last_name ?? '' }}
                    </span>
                    ({{ $subscription->user->email ?? 'No Email' }})
                </p>
            </div>

            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'confirmed' => 'bg-blue-100 text-blue-800',
                    'paid' => 'bg-green-100 text-green-800',
                    'canceled' => 'bg-red-100 text-red-800',
                ];
            @endphp

            <span class="px-5 py-2 rounded-full text-sm font-semibold {{ $statusColors[$subscription->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($subscription->status) }}
            </span>
        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PAYMENT INFO --}}
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Payment Information</h2>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Payment Status</span>
                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-medium">
                        {{ ucfirst($subscription->payment_status ?? 'Pending') }}
                    </span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Method</span>
                    <span class="font-medium text-slate-800">
                        {{ $subscription->payment_method ?? 'N/A' }}
                    </span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Bank</span>
                    <span class="font-medium text-slate-800">
                        {{ $subscription->payment_method ?? 'N/A' }}
                    </span>
                </div>

                <div class="pt-4 border-t flex justify-between items-center">
                    <span class="font-semibold text-slate-900">Total</span>
                    <span class="text-2xl font-bold text-blue-600">
                        ${{ number_format($subscription->total_price ?? 0, 2) }}
                    </span>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- SUBSCRIPTION ITEM --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Subscription Details</h2>

                    <div class="flex items-center gap-5 p-5 rounded-xl bg-slate-50 border">
                        <div class="w-14 h-14 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-lg">
                            1
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-900">
                                {{ $subscription->marketplace->title ?? 'Marketplace N/A' }}
                            </h3>
                            <p class="text-sm text-slate-600">
                                Plan:
                                <span class="font-medium text-slate-900">
                                    {{ $subscription->subscriptionPlan->name ?? 'No plan' }}
                                </span>
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-lg font-bold text-purple-600">
                                ${{ number_format($subscription->total_price ?? 0, 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- UPDATE STATUS --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Update Order Status</h2>

                    <form action="{{ route('admin.update', $subscription->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <select name="status"
                            class="w-full px-4 py-3  text-black rounded-xl border-2 border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none">
                            <option value="rejected" {{ $subscription->status == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                            <option value="confirmed" {{ $subscription->status == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                        </select>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">
                            Update Status
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
