{{-- Marketplace Show Page - Tailwind Redesign --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    {{-- Hero Section --}}
    <div class="bg-white rounded-2xl shadow-lg p-10 flex flex-col md:flex-row md:justify-between md:items-center gap-6">
        <h1 class="text-4xl font-bold text-slate-900">{{ $marketplace->title }}</h1>
        <span class="px-6 py-2 rounded-full font-semibold text-sm uppercase tracking-wide
            {{ $marketplace->is_public ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-800' }}">
            {{ $marketplace->is_public ? 'Public' : 'Private' }}
        </span>
    </div>

    {{-- Two Column Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column: Details & Features --}}
        <div class="space-y-6">

            {{-- Feature Card --}}
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-900">Features</h3>
                </div>
                <div class="text-slate-600 [&_ul]:list-disc [&_ul]:pl-5 [&_li]:mb-2">
                    {!! $marketplace->feature !!}
                </div>
            </div>

            {{-- Description Card --}}
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-900">Description</h3>
                </div>
                <p class="text-slate-600">{{ $marketplace->description ?? 'No description provided.' }}</p>
            </div>

        </div>

        {{-- Right Column: Pricing Plans --}}
        <div class="lg:col-span-2 space-y-6">

            <h2 class="text-3xl font-bold text-white text-center mb-6">Marketplace Plans</h2>

            @forelse($marketplace->subscriptionPlans as $index => $marketplacePlan)
                @php
                    $plan = $marketplacePlan->plan;
                    $isPopular = $index === 1;
                @endphp

                <div class="border-2 {{ $isPopular ? 'border-indigo-500 shadow-lg' : 'border-gray-200' }}
                    rounded-xl p-6 transition-transform hover:scale-105 hover:shadow-xl relative">

                    @if($isPopular)
                        <span class="absolute -top-3 right-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase">
                            Popular
                        </span>
                    @endif

                    <h3 class="text-2xl font-bold text-white mb-2">{{ $plan->name ?? 'Unnamed Plan' }}</h3>
                    @if($plan->desc)
                        <p class="text-slate-600 mb-4">{{ $plan->desc }}</p>
                    @endif

                    <div class="flex items-baseline gap-2 mb-4">
                        <span class="text-lg font-semibold text-white">$</span>
                        <span class="text-4xl font-extrabold text-white">{{ $marketplacePlan->price ?? $plan->price ?? '0' }}</span>
                        <span class="text-sm text-slate-500">/month</span>
                    </div>

                    <button class="w-full py-3 rounded-lg font-semibold text-white
                        {{ $isPopular ? 'bg-gradient-to-r from-indigo-500 to-purple-600' : 'bg-gray-200 text-slate-900' }}
                        transition transform hover:scale-105">
                        Subscribe
                    </button>

                </div>
            @empty
                <div class="bg-white rounded-xl shadow p-10 text-center text-slate-400 space-y-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-lg">No subscription plans available yet.</p>
                </div>
            @endforelse

        </div>

    </div>
</div>
