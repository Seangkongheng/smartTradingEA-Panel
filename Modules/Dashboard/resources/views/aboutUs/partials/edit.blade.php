<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">កំណត់</span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">អំពីយើង</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.setting.index') }}"
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
                        <h1 class="m-0 p-0 text-lg">   <i class="fas fa-cog text-yellow-500 mr-2"></i>
                            <span class="kantumruy-pro text-lg"> កែប្រែ About Us</span>
                        </h1>
                    </div>
                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-10  rounded-2xl">
                         <form action="{{ route('admin.about.update',$aboutUsEdit->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ឈ្មោះគេហទំព័រ</label>
                                    <input type="text"  name="name"  value="{{ old('name', $aboutUsEdit->name ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500"  placeholder="ឈ្មោះគេហទំព័រ">
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">អំពីយើង</label>
                                    <input  type="text"  name="description" value="{{ old('description', $aboutUsEdit->description ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500" required placeholder="អំពីយើង..">
                                    @error('description')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                               <!-- Logo Upload -->
                                <div class="space-y-2 py-2">
                                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ឡូហ្គោ</label>
                                    <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                                        <input type="file" name="logo" id="logo-input" class="sr-only" accept="image/*" onchange="previewImage(this, 'logo-preview-img')">
                                        <div id="logo-preview-box" class="{{ $aboutUsEdit->logo ?? '' ? '' : 'hidden' }} mb-4 w-full text-center">
                                            <img id="logo-preview-img" class="max-h-48 mx-auto rounded-lg border border-gray-200" alt="Logo image preview"
                                                @if(isset($aboutUsEdit->id) && !empty($aboutUsEdit->logo))
                                                    src="{{ asset('aboutImages/logo/' . $aboutUsEdit->logo) }}"
                                                @endif
                                            />
                                        </div>
                                        <div class="file-upload-content">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600 text-center"><span class="font-semibold text-green-600 kantumruy-pro">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                                            <p class="text-xs text-gray-500 mt-1 text-center">PNG, JPG, JPEG</p>
                                        </div>
                                    </label>
                                </div>
                                <!-- Favicon Upload -->
                                <div class="space-y-2 p-2">
                                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">Favicon</label>
                                    <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                                        <input type="file" name="icon" id="favicon-input" class="sr-only" accept="image/*" onchange="previewImage(this, 'favicon-preview-img')">
                                        <div id="favicon-preview-box" class="{{ $aboutUsEdit->icon ?? '' ? '' : 'hidden' }} mb-4 w-full text-center">
                                            <img id="favicon-preview-img" class="max-h-48 mx-auto rounded-lg border border-gray-200" alt="Favicon image preview"
                                                @if(isset($aboutUsEdit->id) && !empty($aboutUsEdit->icon))
                                                    src="{{ asset('aboutImages/icon/' . $aboutUsEdit->icon) }}"
                                                @endif
                                            />
                                        </div>
                                        <div class="file-upload-content">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600 text-center"><span class="font-semibold text-green-600 kantumruy-pro">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                                            <p class="text-xs text-gray-500 mt-1 text-center">PNG, ICO, JPG</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Slider Upload -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ផ្ទាំងស្លាយ</label>
                                <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                                    <input type="file" name="slider[]" id="slider-input" class="sr-only" accept="image/*" multiple onchange="previewMultipleImages(this, 'slider-image-preview')">
                                    <div id="slider-image-preview" class="mb-4 w-full grid grid-cols-3 gap-2 {{ empty($aboutUsEdit->slider) ? 'hidden' : '' }}">
                                        @if(!empty($aboutUsEdit->slider))
                                            @foreach(json_decode($aboutUsEdit->slider, true) as $image)
                                                <img class="slider-preview max-h-24 rounded-lg border border-gray-200" alt="Slider image preview" src="{{ asset('aboutImages/slider/' . $image) }}">
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="file-upload-content">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-center text-gray-600"><span class="font-semibold text-green-600 text-center kantumruy-pro">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Multiple allowed)</p>
                                    </div>
                                </label>
                            </div>

                            <div class="flex justify-end pt-8 border-t border-gray-100">
                                <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors kantumruy-pro">
                                   កែប្រែ
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
    function previewImage(input, previewId) {
    const previewImg = document.getElementById(previewId);
    const previewBox = previewImg.closest('[id$="-preview-box"]');
    const file = input.files[0];
    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/ico'];

    if (file && allowedTypes.includes(file.type)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            previewBox.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        alert('Please select a valid image file (PNG, JPG, JPEG, ICO).');
        input.value = ''; // Clear the input
        previewImg.src = '';
        previewBox.classList.add('hidden');
    }
}

function previewMultipleImages(input, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    const files = input.files;
    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

    previewContainer.innerHTML = '';

    if (files && files.length > 0) {
        previewContainer.classList.remove('hidden');

        Array.from(files).forEach((file) => {
            if (allowedTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('slider-preview', 'max-h-24', 'rounded-lg', 'border', 'border-gray-200');
                    img.alt = 'Slider image preview';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                alert('One or more files are not valid images (PNG, JPG, JPEG).');
            }
        });
    } else {
        previewContainer.classList.add('hidden');
    }
}
</script>
