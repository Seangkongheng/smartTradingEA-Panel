<div class="tab-content hidden" id="title-setting">
    <div class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-900 kantumruy-pro border-l-4 border-green-600 pl-4">
            កំណត់ចំណង់ជើង
        </h3>


        <table id="table-data" class="w-full text-left bg-transparent border-collapse">
            <thead class="bg-gray-50">
                <tr class="text-sm border-b border-gray-200">
                    <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ល.រ</th>
                    <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ទំព័រ</th>
                    <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ចំណង់ជើង</th>
                    {{--  <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">ការពិពណ៌នា</th>  --}}
                    <th class="px-6 py-4 kantumruy-pro font-medium text-gray-500">សកម្មភាព</th>
                </tr>
            </thead>

            <tbody class="text-gray-700 divide-y divide-gray-100">

                @foreach ( $settings as $i=> $setting )
                <tr>
                    <td class="px-6 py-4 kantumruy-pro text-gray-600">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 kantumruy-pro text-gray-600"><span class="bg-green-600 px-3 py-1 text-white rounded-lg">ទំព័រ {{ $setting->page ?? "" }}</span></td>
                    <td class="px-6 py-4 kantumruy-pro text-gray-600">{{ $setting->title ?? "" }}</td>
                    {{--  <td class="px-6 line-clamp-1 py-4 kantumruy-pro text-gray-600">{{ $setting->description ?? "" }}</td>  --}}
                    <td class="px-6 py-4 kantumruy-pro text-gray-600">
                        <div class="flex space-x-2">
                            <!-- Edit -->
                            <a href="{{ route('admin.title.edit',$setting->id) }}"
                                class="p-2 text-green-600 hover:text-green-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
