<!-- Permissions Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-5">
    @forelse ($roles as $role )
    <div
        class="bg-white rounded-xl shadow-sm p-10 border border-gray-100 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex justify-between items-center">
            <p class="text-gray-500 text-xs font-medium">សរុប 0 អ្នកប្រើប្រាស់</p>
            <span class="text-indigo-500 text-xs font-semibold bg-indigo-50 px-2 py-1 rounded-full">{{ $role['name']?? មិនមាន}}</span>
        </div>
        <h4 class="text-lg font-semibold text-gray-800 mt-2">{{ $role['name']?? "មិនមាន" }}</h4>

        {{--  start button  --}}
        <div class="mt-4 flex justify-between items-center">
           <a href="{{ route('admin.role.edit',$role->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">កែប្រែ</a>
           <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST"  onsubmit="return confirm('Delete this contact?')" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 text-xs font-medium hover:text-red-700 transition duration-200">
                    លុប
                </button>
            </form>
        </div>
        {{--  end button  --}}
    </div>
    @empty
        <div class="col-span-full flex flex-col justify-center items-center mt-10">
            <img src="{{ asset('images/empty-data.png') }}" alt="" class="mx-auto mb-2" style="max-width:120px;">
        <div class="text-gray-400">មិនមានទិន្នន័យ</div> </div>
    @endforelse

</div>
