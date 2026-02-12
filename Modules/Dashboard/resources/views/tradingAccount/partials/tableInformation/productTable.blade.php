<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">Title</th>
            <th class="px-6 py-4">Setting Title</th>
            <th class="px-6 py-4">Server Name</th>
            <th class="px-6 py-4">Account ID</th>
            <th class="px-6 py-4">Password</th>
            <th class="px-6 py-4">Total Profit</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-center">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-700">
        @forelse ($tradingAccounts as $i => $tradingAccount)
            <tr class="hover:bg-gray-800/40 transition">
                <td class="px-6 py-4 font-medium">{{ $i + 1 }}</td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->title ?? '-' }}
                </td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->setting_title ?? '-' }}
                </td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->server_name ?? '-' }}
                </td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->account_id ?? '-' }}
                </td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->password ?? '-' }}
                </td>
                <td class="px-6 py-4 font-medium text-white">
                    {{ $tradingAccount->total_profit ?? '-' }} %
                </td>



                {{-- Status --}}
                <td class="px-6 py-4">
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium
                {{ $tradingAccount->is_public ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                        <span
                            class="w-2 h-2 rounded-full
                        {{ $tradingAccount->is_public ? 'bg-green-400' : 'bg-red-400' }}">
                        </span>

                        {{ $tradingAccount->is_public ? 'Public' : 'Private' }}
                    </span>
                </td>

                <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.trading-accounts.edit', $tradingAccount->id) }}"
                            class="p-2 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.5 2.5 0 113.536 3.536L12.536 14.5H9V11z" />
                            </svg>
                        </a>

                        <form action="{{ route('admin.trading-accounts.destroy', $tradingAccount->id) }}"
                            method="POST" onsubmit="return confirm('Are you sure?')">
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
                <td colspan="9" class="py-10 text-center">
                    <img src="{{ asset('images/empty-data.png') }}" class="mx-auto mb-3 max-w-[120px]">
                    <p class="text-gray-400">No Data</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
