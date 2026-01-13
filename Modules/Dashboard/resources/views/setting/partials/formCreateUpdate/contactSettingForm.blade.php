<div class="tab-content hidden" id="contact-settings">
    <h3 class="text-xl font-semibold text-gray-900 kantumruy-pro border-l-4 border-green-600 pl-4 mb-6">
            ទំនាក់ទំនង
        </h3>
        <form  action="{{ isset($userEdit->id) ? route('admin.contact.update', $userEdit->id) : route('admin.contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($userEdit->id))
                @method('PUT')
            @endif
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">ឈ្មោះ</label>
                <div class="flex items-center gap-3">
                   <input type="text" name="name"  class="flex-1 px-4 py-2 rounded-lg border outline-none border-gray-200 focus:ring-2 focus:ring-green-500"  placeholder="ឧ.លេខទូរស័ព្ទ" required >
                </div>
            </div>
             <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">តម្លៃ/ព័ត៌មាន</label>
                <div class="flex items-center gap-3">
                   <input type="text" name="value"  class="flex-1 px-4 py-2 rounded-lg border outline-none border-gray-200 focus:ring-2 focus:ring-green-500"   placeholder="ឧ.00000000" required >
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 kantumruy-pro mb-2">រូបតំណាង (Icon)</label>
                <div class="flex w-full items-center gap-3">
                    <label for="icon_image" class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <input type="file" id="icon_image" name="icon"  class="sr-only" accept="image/png,image/jpeg,image/jpg" required >
                        <div id="icon-image-preview" class="mb-4 w-full flex justify-center">
                            @if(!empty($userEdit->icon_image))
                                <img class="max-h-24 rounded-lg border border-gray-200" alt="Icon preview" src="{{ asset('contactIcons/' . $userEdit->icon_image) }}">
                            @endif
                        </div>
                        <div id="icon-upload-icon" class="w-12 h-12 text-gray-400 mb-4 {{ empty($userEdit->icon_image) ? '' : 'hidden' }}">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div id="icon-upload-text" class="text-center {{ empty($userEdit->icon_image) ? '' : 'hidden' }}">
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
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                    {{ isset($userEdit->id) ? 'ធ្វើបច្ចុប្បន្នភាព' : 'រក្សាទុកការកំណត់' }}
                </button>
            </div>
        </form>
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
