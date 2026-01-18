<style>
    /* Custom animations for tooltip */
    .tooltip {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .group:hover .tooltip {
        opacity: 1;
        transform: translate(-50%, -0.20rem);
    }
</style>



<!-- Main Form Container -->
    @stack('alert-toast')


    <div class="flex flex-col lg:flex-row  shadow-lg  bg-[#131d41]  mt-12 text-white gap-8 p-6 rounded-[2rem]" style="box-shadow: rgba(50, 50, 93, 0.08) 0px 13px 27px -5px, rgba(0, 0, 0, 0.08) 0px 8px 16px -8px;">

        {{--  Navigation Tabs  --}}
        <div class="lg:w-1/4 space-y-4">
            <div class="p-4  rounded-xl">

                {{--  dashbaord setting  --}}
                <h2 class="text-lg font-semibold text-white mb-4 kantumruy-pro mt-2">
                    <svg class="w-5 h-5 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    General Setting
                </h2>
                 <nav class="space-y-2">
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-slate-300 transition-colors" data-tab="roles-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Roles
                    </button>
                    <button type="button"class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="permissions-settings">
                       <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.591.948c.83-.627 1.95.174 1.593 1.118a1.724 1.724 0 001.092 2.158c.956.267.956 1.631 0 1.898a1.724 1.724 0 00-1.092 2.158c.357.944-.763 1.745-1.593 1.118a1.724 1.724 0 00-2.591.948c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-2.591-.948c-.83.627-1.95-.174-1.593-1.118a1.724 1.724 0 00-1.092-2.158c-.956-.267-.956-1.631 0-1.898a1.724 1.724 0 001.092-2.158c-.357-.944.763-1.745 1.593-1.118a1.724 1.724 0 002.591-.948z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Permissions
                    </button>
                </nav>
            </div>
        </div>

        {{--  Form Content  --}}
        <div class="lg:w-3/4 space-y-8">

             {{--  Roles Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.rolesSettingForm')

             {{-- Permissions Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.permissionsSettingForm')

        </div>
    </div>
    </form>

<script>
    // Tab Functionality
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.tab;
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('bg-green-50', 'text-green-700'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));

            button.classList.add('bg-green-50', 'text-green-700');
            document.getElementById(targetId).classList.remove('hidden');
        });
    });

    // Dynamic Field Management
    function addMenuItem() {
        const template = `
            <div class="dynamic-item flex gap-3 items-center">
                <input type="text" name="menu_labels[]"
                       class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500"
                       placeholder="ឈ្មោះម៉ឺនុយ">
                <input type="url" name="menu_urls[]"
                       class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500"
                       placeholder="URL">
                <button type="button" onclick="removeField(this)"
                        class="px-3 py-2 text-red-500 hover:text-red-600">
                    ✕
                </button>
            </div>`;
        document.getElementById('menu-items').insertAdjacentHTML('beforeend', template);
    }

    function addSocialLink() {
        const template = `
            <div class="dynamic-item flex gap-3 items-center">
                <select name="social_platforms[]" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500">
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter</option>
                    <option value="instagram">Instagram</option>
                </select>
                <input type="url" name="social_urls[]"
                       class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500"
                       placeholder="URL">
                <button type="button" onclick="removeField(this)"
                        class="px-3 py-2 text-red-500 hover:text-red-600">
                    ✕
                </button>
            </div>`;
        document.getElementById('social-links').insertAdjacentHTML('beforeend', template);
    }

    function removeField(button) {
        button.closest('.dynamic-item').remove();
    }

    // Image Preview
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.querySelector('img').src = e.target.result;
                preview.classList.remove('hidden');
                input.closest('.file-upload-group').querySelector('.file-upload-content').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Color Preview
    function updateColorPreview(color, previewId) {
        document.getElementById(previewId).style.backgroundColor = color;
    }

    // Initialize first tab
    document.querySelector('.tab-button').click();
</script>
