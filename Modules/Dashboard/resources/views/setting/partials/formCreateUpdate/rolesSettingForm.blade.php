<div class="tab-content hidden" id="roles-settings">
    <div class="space-y-6 relative ">

        <div class="flex justify-between items-center">
            <h3 class="text-xl  text-white font-bold kantumruy-pro border-l-4 border-green-600 pl-4">
                Roles
            </h3>
            <a href="{{ route('admin.role.create') }}"
                class=" bg-green-600 text-white rounded-full p-2 shadow-lg hover:bg-green-700 transition-all duration-200 flex items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span></span>
            </a>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-5">
            @forelse ($roles as $role )
            <div
                class="bg-white rounded-xl shadow-sm p-10 border border-gray-100 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 text-xs font-medium">Total Users 0 </p>
                    <span class="text-indigo-500 text-xs font-semibold bg-indigo-50 px-2 py-1 rounded-full">{{
                        $role['name']?? មិនមាន}}</span>
                </div>
                <h4 class="text-lg font-semibold text-gray-800 mt-2">{{ $role['name']?? "មិនមាន" }}</h4>

                {{-- start button --}}
                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('admin.role.edit',$role->id) }}"
                        class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">Edit</a>
                    <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST"
                        onsubmit="return confirm('Delete this contact?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-500 text-xs font-medium hover:text-red-700 transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
                {{-- end button --}}
            </div>
            @empty
            <div class="col-span-full flex flex-col justify-center items-center mt-10">
                <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2" style="max-width:120px;">
                <div class="text-gray-400">Data not Found</div>
            </div>
            @endforelse

        </div>


        {{-- Button see all --}}
        @if(count($roles) >= 6)
        <div class="view-all flex justify-center items-center p-3">
            <div class="view-all-content flex items-center gap-2">
                <a href="{{ route('admin.role.index') }}"><span class="text-green-600">View All</span></a>
                <span><i class="fas fa-arrow-right"></i></span>
            </div>
        </div>
        @endif
    </div>
</div>
