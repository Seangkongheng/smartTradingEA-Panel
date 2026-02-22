<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">Email</th>
            <th class="px-6 py-4">Exness Email</th>
            <th class="px-6 py-4">Submit Date</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-center">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-700">
        @forelse($membershipsRejected as $index => $membership)
        <tr class="hover:bg-gray-700/40 transition-colors duration-200">
            <td class="px-6 py-4">{{ $index + 1 }}</td>
            <td class="px-6 py-4 font-medium">
                {{ $membership->user->email ?? 'N/A' }}</td>
            <td class="px-6 py-4">{{ $membership->exness_email ?? 'N/A' }}</td>
            <td class="px-6 py-4">{{ $membership->created_at->format('M d, Y') }}</td>
            <td class="px-6 py-4">
                <span
                    class="px-3 py-1 rounded-full font-bold {{ $membership->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : ($membership->status == 'confirmed' ? 'bg-blue-100 text-blue-800' : 'bg-red-400 text-red-800') }}">
                    {{ ucfirst($membership->status) }}</span>
            </td>

            <td class="px-6 py-4">
                <div class="flex justify-center gap-2">
                    {{-- View --}}
                    <a href="{{ route('admin.membership.show', $membership->id) }}"
                        class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    {{-- Noted : Delete Button --}}
                    <form action="{{ route('admin.membership.destroy', $membership->id) }}" method="POST"
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
            <td colspan="9" class="py-10">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('images/empty-data.png') }}" class="mb-3 max-w-[120px]" alt="No data">
                    <p class="text-gray-400 text-center">No memberships available yet.</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>

</table>
