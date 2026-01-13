@php
$groupedPermissions = [];
foreach ($permissions as $permission) {
    $parts = explode('.', $permission->name);
    if (count($parts) === 2) {
        [$group, $action] = $parts;
        $groupedPermissions[$group][] = [
            'id' => $permission->id,
            'name' => $action
        ];
    }
}
@endphp

<div class="permission-grid px-4 py-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($groupedPermissions as $title => $permissionList)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 py-3 px-4 border-b">
                <p class="text-center text-lg font-semibold text-green-700">
                    {{ ucfirst($title) }}
                </p>
            </div>
            <!-- Checkbox list -->
            <div class="px-6 py-4">
                @forelse ($permissionList as $permission)
                <label class="flex justify-between items-center py-2 cursor-pointer">
                    <span class="text-gray-800 text-base">{{ $permission['name'] }}</span>
                    <input  type="checkbox"  name="permissions[]"value="{{ $title . '.' . $permission['name'] }}"  class="h-5 w-5 text-blue-600 rounded focus:ring-blue-500"  {{ in_array($title . '.' . $permission['name'], $rolepermission ?? []) ? 'checked' : '' }} />
                </label>
                @empty
                <p class="text-center">មិនមានទិន្នន័យ</p>
                @endforelse
            </div>
        </div>
        @empty
        <div class="col-span-full flex flex-col justify-center items-center mt-10">
            <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2" style="max-width:120px;">
            <div class="text-gray-400">មិនមានទិន្នន័យ ! សូមធ្វើការបង្កើត Permission ជាមុនសិន</div>
        </div>
        @endforelse
    </div>
</div>
