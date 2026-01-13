<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">កំណត់</span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">បណ្តាញសង្គម</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.platform.index') }}"
            class="flex items-center gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span class="font-medium">ត្រឡបក្រោយ</span>
        </a>
    </div>
</div>
<div class="main-content w-full ">

        {{-- Start Content create --}}
        <div class="col-start-1 col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content   rounded-lg  bg-white" id="styled-profile" role="tabpanel"   style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div  class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg"> <i class="fas fa-user-circle text-yellow-500 mr-2"></i>
                            <span class="kantumruy-pro text-lg"> កែប្រែបណ្តាញសង្គម </span>
                        </h1>
                    </div>
                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-10  rounded-2xl">

                        <form action="{{ route('admin.platform.update',$plateformEdit->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">ឈ្មោះ</label>
                                <div class="flex items-center gap-3">
                                    <input type="text" name="name"  value="{{ old('name', $plateformEdit->name ?? '') }}" class="flex-1 px-4 py-2 rounded-lg border  kantumruy-pro border-gray-200 focus:ring-2 outline-none focus:ring-green-500"  placeholder="ឧ.Facebook">
                                </div>
                            </div>

                            <div class="mb-6">
                                 <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">លីង</label>
                                <div class="flex items-center gap-3">
                                    <input type="text" name="link" value="{{ old('link',$plateformEdit->link ?? "") }}"  class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 outline-none kantumruy-pro focus:ring-green-500"   placeholder="ឧ.facebook.com">
                                 </div>
                            </div>

                                @php
                                    $existingIconUrl = isset($plateformEdit) && $plateformEdit->icon ? asset('icons/' . $plateformEdit->icon) : null;
                                @endphp

                              <div class="mb-6 w-full">
                                <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">
                                    រូបតំណាង (Icon)
                                </label>
                                <div class="flex w-full items-center gap-3">
                                    <label for="icon_image"
                                        class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out relative w-full">

                                        <input type="file" id="icon_image" name="icon" accept="image/png,image/jpeg,image/jpg"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                                        <div id="icon-image-preview" class="mb-4 w-full flex justify-center">
                                            <img
                                                id="icon-preview-img"
                                                class="max-h-24 rounded-lg border border-gray-200 {{ $existingIconUrl ? '' : 'hidden' }}"
                                                src="{{ $existingIconUrl }}"
                                                alt="Icon preview"
                                                style="max-width: 100%; height: auto;"
                                            />
                                        </div>

                                        <div id="icon-upload-icon" class="w-12 h-12 text-gray-400 mb-4">
                                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                        </div>

                                        <div id="icon-upload-text" class="text-center">
                                            <p class="text-sm text-gray-600">
                                                <span class="font-semibold kantumruy-pro text-blue-600">ចុចដើម្បីផ្ទុករូបភាព</span>
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG</p>
                                        </div>

                                        <span id="icon-file-name" class="mt-4 text-sm text-gray-500"></span>
                                    </label>
                                </div>
                            </div>



                            <!-- Form Actions -->
                            <div class="flex justify-end pt-8 border-t border-gray-100">
                                <button type="submit"
                                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium  kantumruy-pro transition-colors">
                                    {{ isset($userEdit->id) ? 'ធ្វើបច្ចុប្បន្នភាព' : 'រក្សាទុកការកំណត់' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Content create --}}

</div>



<script>
document.getElementById('icon_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('icon-image-preview');
    const fileName = document.getElementById('icon-file-name');
    const uploadIcon = document.getElementById('icon-upload-icon');
    const uploadText = document.getElementById('icon-upload-text');

    preview.innerHTML = '';
    fileName.textContent = '';

    if (file) {
        uploadIcon.classList.add('hidden');
        uploadText.classList.add('hidden');
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'max-h-24 rounded-lg border border-gray-200';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
        fileName.textContent = file.name;
    } else {
        uploadIcon.classList.remove('hidden');
        uploadText.classList.remove('hidden');
    }
});
</script>
