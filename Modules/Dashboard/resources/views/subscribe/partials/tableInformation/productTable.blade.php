<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">Name</th>
            <th class="px-6 py-4">Marketplace</th>
            <th class="px-6 py-4">plan</th>
            <th class="px-6 py-4">Price</th>
            <th class="px-6 py-4">Confirm Date</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-center">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-700">
        @forelse ( $subscriptions as $index=> $order )
        <tr class="hover:bg-gray-700/40 transition-colors duration-200">
            <td class="px-6 py-4">{{ $index + 1 }}</td>
            <td class="px-6 py-4 font-medium">{{ $order->user->first_name?? "" }} {{ $order->user->last_name ?? "" }}
            </td>
            <td class="px-6 py-4 font-medium">{{ $order->marketplace->title ?? 'N/A' }}
            </td>
            <td class="px-6 py-4 font-medium">
                {{ $order->subscriptionPlan->name ?? 'N/A' }}
            </td>
            <td class="px-6 py-4 font-medium">
                $ {{ $order->total_price ?? '0' }}
            </td>
            <td class="px-6 py-4 font-medium">
                {{ $order->updated_at ?? 'N/A' }}
            </td>


            <td class="px-6 py-4">
                @php
                $status = $order->status ?? 'N/A';
                $statusColor = match($status) {
                'pending' => 'bg-yellow-500 text-white',
                'confirmed' => 'bg-green-500 text-white',
                default => 'bg-gray-500 text-white',
                };
                @endphp

                <span class="px-3 py-1 rounded-full font-semibold {{ $statusColor }}">
                    {{ ucfirst($status) }}
                </span>
            </td>


            <td class="px-6 py-4">
                <div class="flex justify-center gap-2">
                    {{-- View --}}
                    <a href="{{ route('admin.subscribes.show', $order->id) }}"
                        class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="py-10">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('images/empty-data.png') }}" class="mb-3 max-w-[120px]" alt="No data">
                    <p class="text-gray-400 text-center">
                        This feature is not implemented yet.
                    </p>
                </div>
            </td>
        </tr>
        @endforelse

    </tbody>

</table>
