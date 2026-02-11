<table id="table-data" class="w-full text-left text-sm text-gray-300">
    <thead class="bg-gray-800/60 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4">#</th>
            <th class="px-6 py-4">Images</th>
            <th class="px-6 py-4">Title</th>
            <th class="px-6 py-4">Category</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-center">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-700">
        @forelse ($results as $i => $result)
        <tr class="hover:bg-gray-800/40 transition">

            <td class="px-6 py-4 font-medium">{{ $i + 1 }}</td>


            @if ($result->file)
            @php
            $files = json_decode($result->file, true);
            @endphp

            @if (!empty($files) && isset($files[0]['path']))
            <td>
                <img src="{{ asset($files[0]['path']) }}" alt="{{ $files[0]['name'] ?? 'Image' }}"
                    style="width:75px; height:75px;" class="object-cover rounded">

            </td>
            @endif
            @endif


            </td>
            <td class="px-6 py-4 font-medium text-white">
                {{ $result->title ?? '-' }}
            </td>
            <td class="px-6 py-4 font-medium text-white">{{ $result->category->name ?? '-' }}</td>
            <td>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium
                {{ $result->is_public ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                    <span class="w-2 h-2 rounded-full
                        {{ $result->is_public ? 'bg-green-400' : 'bg-red-400' }}">
                    </span>

                    {{ $result->is_public ? 'Public' : 'Private' }}
                </span>
            </td>

            <td class="px-6 py-4">
                <div class="flex space-x-2">
                    <!-- View -->
                    <a href="{{ route("admin.result-photos.show",$result->id) }}" class="p-2 text-blue-600 hover:text-blue-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>


                    <a href="{{ route('admin.result-photos.edit',$result->id) }}" class="p-2 text-green-600 hover:text-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>


                    <form action="{{ route('admin.result-photos.destroy', $result->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:text-red-700 transition-colors"
                            data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="py-10 text-center">
                <img src="{{ asset('images/empty-data.png') }}" class="mx-auto mb-3 max-w-[120px]">
                <p class="text-gray-400">No Data</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
