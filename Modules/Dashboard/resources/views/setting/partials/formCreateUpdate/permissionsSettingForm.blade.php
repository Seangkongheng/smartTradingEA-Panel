<div class="tab-content hidden" id="permissions-settings">
    <div class="space-y-6 relative">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-900 kantumruy-pro border-l-4 border-green-600 pl-4">
                ការកំណត់សិទ្ធ
            </h3>
            <a href="{{ route('admin.permission.create') }}" class=" bg-green-600 text-white rounded-full p-2 shadow-lg hover:bg-green-700 transition-all duration-200 flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span></span>
            </a>
        </div>

      @php
    $groupedPermissions = [];

    // Group permissions by the prefix (e.g., news, users, slider)
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
    $countPermission =count($permissions);
@endphp

<!-- Permissions Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5">
    @forelse ($groupedPermissions as $title
    => $permissionList)
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold text-gray-800 kantumruy-pro">មុខងារ {{ ucfirst($title) }}</h4>
                <span class="text-indigo-500 text-xs font-semibold bg-indigo-50 px-2 py-1 rounded-full">{{ ucfirst($title) }}</span>
            </div>
            <ul>
                @forelse ($permissionList as $permission)
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <span class="text-gray-700 text-sm font-medium">{{ ucfirst($permission['name']) }}</span>
                       <div class="flex space-x-3 items-center">
                    <a href="{{ route('admin.permission.edit', $permission['id']) }}"
                       class="text-indigo-600 text-xs font-medium hover:text-indigo-800 transition duration-200">
                        កែប្រែ
                    </a>

                    <form action="{{ route('admin.permission.destroy', $permission['id']) }}" method="POST"  onsubmit="return confirm('Delete this contact?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-500 text-xs font-medium hover:text-red-700 transition duration-200">
                            លុប
                        </button>
                    </form>
                </div>

                    </li>
                @empty
                    <li><span>មិនមានទិន្នន័យ</span></li>
                @endforelse
            </ul>
        </div>
    @empty
      <div class="col-span-full flex flex-col justify-center items-center mt-10">
            <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2" style="max-width:120px;">
        <div class="text-gray-400">មិនមានទិន្នន័យ</div> </div>
    @endforelse
</div>


        {{--  button see all   --}}
      @if($countPermission >= 5)
            <div class="view-all flex justify-center items-center p-3">
                <div class="view-all-content flex items-center gap-2">
                    <a href="{{ route('admin.permission.index') }}"><span class="text-green-600">មើលទាំងអស់</span></a>
                    <span><i class="fas fa-arrow-right"></i></span>
                </div>
            </div>
        @endif


    </div>
</div>
