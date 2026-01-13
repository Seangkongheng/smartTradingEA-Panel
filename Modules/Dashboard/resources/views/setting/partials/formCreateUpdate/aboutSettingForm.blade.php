<div class="tab-content hidden" id="navbar-settings">
    <div class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-900 kantumruy-pro border-l-4 border-green-600 pl-4">
            អំពីយើង
        </h3>

        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($userEdit->id))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ឈ្មោះគេហទំព័រ</label>
                    <input type="text"  name="name"  value="{{ old('name', $about->copyright ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500"  placeholder="ឈ្មោះគេហទំព័រ">
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">អំពីយើង</label>
                    <input  type="text"  name="description" value="{{ old('description', $about->description ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500" required placeholder="អំពីយើង..">
                    @error('description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo Upload --}}
                <div class="space-y-2 py-2">
                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ឡូហ្គោ</label>
                    <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <input type="file" name="logo" id="logo-input" class="sr-only" accept="image/*" onchange="previewImage(this, 'logo-preview-img')">
                        <div id="logo-preview-box" class="mb-4 w-full text-center hidden" >
                            <img id="logo-preview-img" class="max-h-32 mx-auto rounded-lg border border-gray-200" alt="Logo preview">
                        </div>
                        <div class="file-upload-content">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 text-center"><span class="font-semibold text-green-600">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                            <p class="text-xs text-gray-500 mt-1  text-center">PNG, JPG, JPEG</p>
                        </div>
                    </label>
                </div>
                {{-- Favicon Upload --}}
                <div class="space-y-2 p-2">
                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">Favicon</label>
                    <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <input type="file" name="icon" id="favicon-input" class="sr-only" accept="image/*" onchange="previewImage(this, 'favicon-preview-img')">
                        <div class="mb-4 w-full text-center hidden" id="favicon-preview-box">
                            <img id="favicon-preview-img" class="max-h-24 mx-auto rounded-lg border border-gray-200" alt="Favicon preview">
                        </div>
                        <div class="file-upload-content">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 text-center"><span  class=" text-center font-semibold text-green-600">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                            <p class="text-xs text-gray-500 mt-1 text-center">PNG, ICO, JPG</p>
                        </div>
                    </label>
                </div>
            </div>

            {{--  Slider Upload --}}
            <div class="space-y-2 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ផ្ទាំងស្លាយ</label>
                <label class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                    <input type="file" name="slider[]" id="slider-input" class="sr-only" accept="image/*" multiple onchange="previewMultipleImages(this, 'slider-preview-list')">
                    <div id="slider-preview-list" class="mb-4 w-full grid grid-cols-2 md:grid-cols-4 gap-2"></div>
                    <div class="file-upload-content">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-sm text-center text-gray-600"><span class="font-semibold text-green-600 text-center">ចុចដើម្បីផ្ទុករូបភាព</span></p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Multiple allowed)</p>
                    </div>
                </label>
            </div>

            <div class="flex justify-end pt-8 border-t border-gray-100">
                <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                    {{ isset($userEdit->id) ? 'ធ្វើបច្ចុប្បន្នភាព' : 'រក្សាទុកការកំណត់' }}
                </button>
            </div>
        </form>
    </div>
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
