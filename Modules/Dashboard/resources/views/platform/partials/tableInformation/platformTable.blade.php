

                <table id="table-data" class="w-full text-left bg-transparent border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="text-sm border-b border-gray-200">
                            <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ល.រ</th>
                             <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">រូបតំណាង</th>
                            <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ឈ្មោះ</th>
                            <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">លឺង</th>
                            <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">សកម្មភាព</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 divide-y divide-gray-100">

                        @forelse ($platforms as $i => $platform)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 kantumruy-pro font-medium text-gray-600">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 kantumruy-pro">
                                <div class="flex items-center space-x-3">
                                    <div class="shrink-0">
                                        <img src="{{  asset('profiles/default_profile.jpg') }}"  class="w-8 h-8 rounded-full object-cover border border-gray-200">
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-800">  {{ $platform->name ?? "" }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 kantumruy-pro">
                                <div class="flex items-center text-nowrap space-x-3">
                                    <div>  <span class="font-medium ">{{ $platform['name']?? "" }} &nbsp;  </span>
                                        <span class="font-bold"> {{   $platform['name'] ?? "" }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 kantumruy-pro">
                                <span class="text-sm px-2.5 py-1 text-nowrap rounded-full bg-gray-100 text-sky-500">
                                    {{ $platform->link ?? "" }}
                                </span>
                            </td>
                            >
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <!-- View -->
                                    <a href="{{ route('admin.platform.show',$platform->id) }}"
                                        class="p-2 text-blue-600 hover:text-blue-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('admin.platform.edit',$platform->id) }}"
                                        class="p-2 text-green-600 hover:text-green-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <!-- Delete -->
                                    <form action="{{ route('admin.platform.destroy', $platform->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-600 hover:text-red-700 transition-colors"
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
                                <td colspan="5" class="py-8 text-center">
                                    <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2"
                                        style="max-width:120px;">
                                    <div class="text-gray-400">មិនមានទិន្នន័យ</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
