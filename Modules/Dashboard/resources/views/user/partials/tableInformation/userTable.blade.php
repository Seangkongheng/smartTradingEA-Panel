<table id="table-data" class="w-full text-left bg-transparent ">
    <thead class=" ">
        <tr class="text-sm border-b">
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">#</th>
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">Name</th>
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">Email</th>
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">Role</th>
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">Status</th>
            <th class="px-6 py-4 kantumruy-pro font-bold text-white">Action</th>
        </tr>
    </thead>
    <tbody class="text-white divide-y">
        @forelse ($users as $i => $user)
            <tr class="hover:text-amber-400 transition-colors duration-150">
                <td class="px-6 py-4 kantumruy-pro font-medium">{{ $i + 1 }}</td>
                <td class="px-6 py-4 kantumruy-pro ">{{ $user->userDetail->first_name ?? '' }} &nbsp;{{ $user->userDetail->last_name ?? '' }}</td>
                <td class="px-6 py-4 kantumruy-pro ">{{ $user->email ?? '' }}</td>
                <td class="px-6 py-4 kantumruy-pro">
                    @forelse ($user->getRoleNames() as $roleName)
                    <span class="text-sm px-2.5 py-1 rounded-full bg-blue-600 text-white mx-1">
                        {{ $roleName }}
                    </span>
                    @empty
                        <span class="text-sm text-red-500">Please assign</span>
                    @endforelse
                </td>

                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        @php
                            $isActive = $user->userDetail?->is_active ?? null;
                        @endphp
                        <span class="w-2 h-2 rounded-full {{ $isActive === 1 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        <span class="text-sm ">
                            {{ $isActive === 1 ? 'Active' : 'Blocked' }}
                        </span>
                    </div>
                </td>


                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <!-- View -->
                        <a href="{{ route('admin.user.show', $user->id) }}"
                            class="p-2 text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>


                        <a href="{{ route('admin.user.edit', $user->id) }}" class="p-2 text-green-600 hover:text-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>


                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:text-red-700 transition-colors" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-8 text-center">
                    <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2" style="max-width:120px;">
                    <div class="text-gray-400">មិនមានទិន្នន័យ</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
