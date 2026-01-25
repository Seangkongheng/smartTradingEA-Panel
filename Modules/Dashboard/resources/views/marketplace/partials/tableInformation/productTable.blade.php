<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">Title</th>
            <th class="px-6 py-4">Plans</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-end">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-700">
        @forelse($marketplaces as $index => $marketplace)
        <tr class="hover:bg-gray-700/40 transition-colors duration-200">
            <td class="px-6 py-4">{{ $index + 1 }}</td>
            <td class="px-6 py-4 font-medium">{{ $marketplace->title }}</td>

            <td class="px-6 py-4">
                <div class="flex flex-wrap gap-2 max-w-xs">
                    @forelse($marketplace->subscriptionPlans as $marketplacePlan)
                    <div class="relative group">
                        <div
                            class="gap-2 px-3 py-2 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-600 rounded-lg shadow-sm hover:shadow-md hover:border-green-500 hover:scale-105 transition-all duration-200 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <span
                                    class="font-semibold text-gray-100 group-hover:text-green-400 text-xs whitespace-nowrap transition-colors">
                                    {{ $marketplacePlan->plan->name ?? 'N/A' }}
                                </span>
                                <span
                                    class="text-gray-400 group-hover:text-green-300 text-xs font-medium transition-colors">
                                    •
                                </span>
                                <span
                                    class="text-green-400 group-hover:text-green-300 font-bold text-xs whitespace-nowrap transition-colors">
                                    ${{ number_format($marketplacePlan->price ?? ($marketplacePlan->plan->price ?? 0),
                                    2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Badge -->
                        @if(isset($marketplacePlan->plan->badge) && $marketplacePlan->plan->badge)
                        <span
                            class="absolute -top-1.5 -right-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full shadow-lg ring-2 ring-gray-900 animate-pulse">
                            {{ $marketplacePlan->plan->badge }}
                        </span>
                        @endif

                        <!-- Tooltip on Hover -->
                        <div
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 whitespace-nowrap z-10 border border-gray-700">
                            <div class="font-semibold">{{ $marketplacePlan->plan->name ?? 'N/A' }}</div>
                            <div class="text-green-400 font-bold mt-0.5">${{ number_format($marketplacePlan->price ??
                                ($marketplacePlan->plan->price ?? 0), 2) }}</div>
                            <!-- Tooltip Arrow -->
                            <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-px">
                                <div class="border-4 border-transparent border-t-gray-900"></div>
                            </div>
                        </div>


                    </div>
                    @empty
                    <span class="text-gray-500 text-xs italic">No plans</span>
                    @endforelse
                </div>
            </td>

            <td class="px-6 py-4">
                @if($marketplace->is_public)
                <span class="px-2 py-1 bg-green-600 text-white rounded-full text-xs">Public</span>
                @else
                <span class="px-2 py-1 bg-red-600 text-white rounded-full text-xs">Private</span>
                @endif
            </td>

            <td class="px-6 py-4">
                <div class="flex justify-center gap-2">
                    {{-- View --}}
                    <a href="{{ route('admin.marketplace.show', $marketplace->id) }}"
                        class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('admin.marketplace.edit', $marketplace->id) }}"
                        class="p-2 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.5 2.5 0 113.536 3.536L12.536 14.5H9V11z" />
                        </svg>
                    </a>


                    <form action="{{ route('admin.marketplace.destroy', $marketplace->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="py-10">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('images/empty-data.png') }}" class="mb-3 max-w-[120px]" alt="No data">
                    <p class="text-gray-400 text-center">No marketplaces available yet.</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
