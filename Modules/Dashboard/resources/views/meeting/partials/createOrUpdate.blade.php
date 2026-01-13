<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class=" text-balance lg:text-lg xl:text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">Subscribe</span>
            <span class="text-gray-300 mx-1 lg:mx-2">/</span>
            <span class="text-gray-600">{{ isset($schoolEdit->id) ? 'Update Subscribe' : 'Create Subscribe ' }}</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.school.index') }}"
            class="flex items-center gap-1 lg:gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span class="font-medium text-nowrap">Back</span>
        </a>
    </div>
</div>
    @include('dashboard::subscribe.partials.formCreate.createOrUpdate')
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Configuration for image uploads
    const uploadConfigs = [
        {
            inputId: 'profile_image',
            previewId: 'profile-image-preview',
            previewImgId: 'profile-preview',
            iconId: 'profile-upload-icon',
            textId: 'profile-upload-text',
            fileNameId: 'profile-file-name',
            multiple: false
        },
        {
            inputId: 'slider_images',
            previewId: 'slider-image-preview',
            previewImgClass: 'slider-preview',
            iconId: 'slider-upload-icon',
            textId: 'slider-upload-text',
            fileNameId: 'slider-file-name',
            multiple: true
        }
    ];

    uploadConfigs.forEach(config => {
        const input = document.getElementById(config.inputId);
        const previewContainer = document.getElementById(config.previewId);
        const uploadIcon = document.getElementById(config.iconId);
        const uploadText = document.getElementById(config.textId);
        const fileNameSpan = document.getElementById(config.fileNameId);

        input.addEventListener('change', function () {
            const files = this.files;
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

            // Clear previous previews
            if (config.multiple) {
                previewContainer.innerHTML = '';
            }

            // Validate and process files
            let validFiles = Array.from(files).filter(file => {
                if (file.size > maxSize) {
                    alert(`File ${file.name} exceeds 5MB limit.`);
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    alert(`File ${file.name} is not a supported type (PNG, JPG, JPEG).`);
                    return false;
                }
                return true;
            });

            if (validFiles.length === 0) {
                input.value = ''; // Clear invalid input
                return;
            }

            // Update file names
            fileNameSpan.textContent = validFiles.map(file => file.name).join(', ');

            // Show previews
            validFiles.forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (config.multiple) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'slider-preview max-h-24 rounded-lg border border-gray-200';
                        img.alt = 'Slider image preview';
                        previewContainer.appendChild(img);
                    } else {
                        const previewImg = document.getElementById(config.previewImgId);
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            });

            // Update UI
            previewContainer.classList.remove('hidden');
            uploadIcon.classList.add('hidden');
            uploadText.classList.add('hidden');
        });
    });
});
</script>
