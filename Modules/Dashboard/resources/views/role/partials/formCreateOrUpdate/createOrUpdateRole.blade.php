<div class="bg-white w-full p-8 rounded-2xl" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
             <div  class="card-title inter font-[500] border-b flex items-center py-2  justify-center w-full text-center ">
             <h1 class="m-0 p-0 text-lg"><i class="fas fa-graduation-cap text-yellow-500 mr-2"></i>
                    <span class="kantumruy-pro text-lg"> តួនាទី </span>
            </h1>
    </div><br>
    <form method="POST" action="{{ isset($roleEdit->id)? route('admin.role.update',$roleEdit->id):  route('admin.role.store') }}" enctype="multipart/form-data">
        @csrf
            @if(isset($roleEdit->id))
                @method('PUT')
            @endif
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                <div class="md:col-span-3 flex items-center h-full">
                    <label for="khmer_name" class="text-lg kantumruy-pro text-right pr-4">
                        តួនាទី
                    </label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" id="khmer_name" name="name"  value="{{ old('name',isset($roleEdit->id)? $roleEdit->name : "") }}" class="px-6 py-3.5 text-black bg-gray-100 w-full rounded-xl outline-none focus:ring-1  focus:ring-green-500 focus:border-green-500" placeholder="Ex.Admin.." required>
                    @error('title')
                        <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <p class="text-center text-2xl font-bold border-b border-gray-300 py-4">Permission</p>
            @include('dashboard::role.partials.formCreateOrUpdate.roleHasPermision')

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inter px-5 py-2 p-8  backdrop-blur-lg text-white bg-green-600 kantumruy-pro rounded-lg items-center gap-0.5 inline-flex border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out"
                    id="submit-button"> <span class="kantumruy-pro">{{ isset($roleEdit->id)? "កែប្រែ" : "រក្សាទុក" }}</span> <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" class="fill-current">
                        <path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
