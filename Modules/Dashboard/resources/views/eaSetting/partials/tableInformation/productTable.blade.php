<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">File</th>
            <th class="px-6 py-4">Title</th>
            <th class="px-6 py-4">Total Download</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-center">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-700">
        @forelse ($eaSettings as $i => $eaSetting)

        @php
        $ext = strtolower(pathinfo($eaSetting->file ?? '', PATHINFO_EXTENSION));
        $icon = match($ext) {
        'pdf' => 'text-red-500',
        'doc', 'docx' => 'text-blue-500',
        'xls', 'xlsx' => 'text-green-500',
        'png', 'jpg', 'jpeg' => 'text-purple-500',
        default => 'text-gray-400'
        };
        @endphp

        <tr class="hover:bg-gray-800/40 transition">
            {{-- Index --}}
            <td class="px-6 py-4 font-medium">{{ $i + 1 }}</td>

            {{-- File Icon --}}
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 {{ $icon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6M7 20h10a2 2 0 002-2V8l-6-6H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-400 text-xs uppercase">{{ $ext ?: 'file' }}</span>
                </div>
            </td>

            {{-- Title --}}
            <td class="px-6 py-4 font-medium text-white">
                {{ $eaSetting->title ?? '-' }}
            </td>

            <td class="px-6 py-4 font-medium text-white">
                {{ $eaSetting->total_downloads ?? '0' }}
            </td>

            {{-- Status --}}
            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium
                {{ $eaSetting->is_public ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                    <span class="w-2 h-2 rounded-full
                        {{ $eaSetting->is_public ? 'bg-green-400' : 'bg-red-400' }}">
                    </span>

                    {{ $eaSetting->is_public ? 'Public' : 'Private' }}
                </span>
            </td>


            {{-- Actions --}}
            <td class="px-6 py-4">
                <div class="flex justify-center gap-2">

                    {{-- Edit --}}
                    <a href="{{ route('admin.eaSettings.edit', $eaSetting->id) }}"
                        class="p-2 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.5 2.5 0 113.536 3.536L12.536 14.5H9V11z" />
                        </svg>
                    </a>

                    {{-- Noted : Delete Button --}}
                    <form action="{{ route('admin.eaSettings.destroy', $eaSetting->id) }}" method="POST"
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
            <td colspan="5" class="py-10 text-center">
                <img src="{{ asset('images/empty-data.png') }}" class="mx-auto mb-3 max-w-[120px]">
                <p class="text-gray-400">No Data</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
