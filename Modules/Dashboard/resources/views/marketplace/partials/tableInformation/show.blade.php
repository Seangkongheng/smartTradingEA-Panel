{{-- Admin Marketplace Show Page --}}
<div class="max-w-7xl mx-auto px-6 py-8 space-y-8">

    {{-- Header --}}
    <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-800">
            {{ $marketplace->title }}
        </h1>

        <span class="px-4 py-1 rounded-full text-sm font-medium
            {{ $marketplace->is_public ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
            {{ $marketplace->is_public ? 'Public' : 'Private' }}
        </span>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Marketplace Info --}}
        <div class="space-y-6">

            {{-- Features --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    Features
                </h3>
                <div class="text-gray-600 text-sm [&_ul]:list-disc [&_ul]:pl-5">
                    {!! $marketplace->feature !!}
                </div>
            </div>

            {{-- Description --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    Description
                </h3>
                <p class="text-gray-600 text-sm">
                    {{ $marketplace->description ?? 'No description provided.' }}
                </p>
            </div>

        </div>

        {{-- Right: Plans --}}
        <div class="lg:col-span-2 space-y-4">

            <h2 class="text-xl font-semibold text-gray-800">
                Subscription Plans
            </h2>

            @forelse ($marketplace->subscriptionPlans as $index => $marketplacePlan)
                @php $plan = $marketplacePlan->plan; @endphp

                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $plan->name ?? 'Unnamed Plan' }}
                        </h3>

                        <span class="text-lg font-bold text-indigo-600">
                            ${{ $marketplacePlan->price ?? $plan->price ?? '0' }}
                        </span>
                    </div>

                    @if($plan->desc)
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $plan->desc }}
                        </p>
                    @endif

                    {{-- Payment Link (Admin View) --}}
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Payment Link:</span>
                        @if($marketplacePlan->payment_link)
                            <a href="{{ $marketplacePlan->payment_link }}"
                               target="_blank"
                               class="text-blue-600 underline ml-1">
                                Open Link
                            </a>
                        @else
                            <span class="text-gray-400 ml-1">Not set</span>
                        @endif
                    </div>
                </div>

            @empty
                <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
                    No subscription plans available.
                </div>
            @endforelse

        </div>

    </div>
</div>
