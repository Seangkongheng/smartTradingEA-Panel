<div class="col-span-2 sm:col-span-1">
    <div class="hover:shadow-md transition-shadow duration-300 p-4 rounded-xl"
        style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;">
        <div class="text-sm text-gray-600 mb-3">បណ្ញាញសង្គម</div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-xl overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($platforms as $platform)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4">
                            <img src="{{ $platform->icon ? asset('icons/' . $platform->icon) : asset('profiles/default_profile.jpg') }}"  class="w-5 h-5 rounded-full object-cover border border-gray-200 shadow-sm">
                        </td>
                        <td class="px-6 py-4 text-gray-800 kantumruy-pro">
                            {{ $platform->name ?? 'មិនមាន' }}
                        </td>
                        <td class="px-6 py-4 text-gray-800 kantumruy-pro">

                        </td>

                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.platform.edit', $platform->id ?? 1) }}"  class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-800"   title="កែសម្រួល">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" stroke-width="2"   stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.platform.destroy', $platform->id ?? 1) }}" method="POST"  class="inline-block" onsubmit="return confirm('តើអ្នកចង់លុបពិតមែនទេ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"   class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800"  title="លុប">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
