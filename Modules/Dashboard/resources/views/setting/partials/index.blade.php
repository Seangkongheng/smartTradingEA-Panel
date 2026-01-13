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

<div class="title-table mt-5 flex flex-col md:flex-row  items-center justify-between gap-4">
    <!-- Title Section -->
    <div class="flex-1 flex justify-between w-full md:min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro m-0 p-0">
            <span class="text-green-600">កាកំណត់</span></span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">តារាង</span>
        </h1>
         <a href="{{ route('admin.professor.create') }}" class="flex md:hidden items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-white hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="kantumruy-pro font-medium text-green-600">បន្ថែម</span>
        </a>
    </div>
    <!-- Controls Section -->
    <div class="flex items-center justify-start  gap-3 flex-1 w-full md:max-w-[800px]">
        <div class="flex-1 md:min-w-[160px]">
            <form action="" method="POST">
                <div class="relative">
                    <input disabled type="text" name="search" placeholder="ស្វែងរក..."
                        class="w-full kantumruy-pro pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50  focus:ring-1 focus:ring-green-400 focus:border-green-400 focus:outline-none placeholder-gray-400 text-gray-700 focus:border-none transition-all">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Status Dropdown -->
        <div class="relative sm:w-[160px]">
            <select disabled name="status" class="w-full px-2 md:px-4 kantumruy-pro  pr-8 py-2.5 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:ring-1 focus:ring-green-500 focus:outline-none focus:border-green-500 text-gray-700 appearance-none transition-all">
                <option value="1" selected>ស្ថានភាព</option>
                <option value="2">Active</option>
                <option value="3">Block</option>
            </select>
            <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        <button disabled class="hidden md:flex items-center gap-2 px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="kantumruy-pro font-medium text-gray-400">បន្ថែម</span>
        </button>
    </div>
</div>

<!-- Main Form Container -->
    @stack('alert-toast')


    <div class="flex flex-col lg:flex-row  shadow-lg bg-white gap-8 p-6 rounded-[2rem]" style="box-shadow: rgba(50, 50, 93, 0.08) 0px 13px 27px -5px, rgba(0, 0, 0, 0.08) 0px 8px 16px -8px;">

        {{--  Navigation Tabs  --}}
        <div class="lg:w-1/4 space-y-4">
            <div class="p-4 bg-gray-50 rounded-xl">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 kantumruy-pro">
                    <svg class="w-5 h-5 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    ការកំណត់គេហទំព័រ
                </h2>
               <nav class="space-y-2">
                    {{--  <!-- អំពីគេហទំព័រ -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="navbar-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8h4a2 2 0 012 2v7a2 2 0 01-2 2h-4m-4 0H5a2 2 0 01-2-2v-7a2 2 0 012-2h4" />
                        </svg>
                        អំពីគេហទំព័រ
                    </button>  --}}

                    <!-- ទំនាក់ទំនង -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="contact-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10a9 9 0 11-6.219-8.575M21 10l-9 9-4.5-4.5" />
                        </svg>
                        ទំនាក់ទំនង
                    </button>

                    <!-- បណ្តាញសង្គម -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="platform-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 100-6 3 3 0 000 6zM9 21a3 3 0 100-6 3 3 0 000 6zM20.24 17.24a3 3 0 10-1.48-5.66 3 3 0 001.48 5.66zM9 17l6-4M15 7L9 3" />
                        </svg>
                         បណ្តាញសង្គម
                    </button>


                    <!-- កំណត់ចំណង់ជើង -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="title-setting">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h10" />
                        </svg>
                        កំណត់ចំណង់ជើង
                    </button>

                    <!-- កំណត់ទំព័រផ្សាយផ្ទាល់ -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="live-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6v12h4l5 3V3L8 6H4z" />
                        </svg>
                        កំណត់ទំព័រផ្សាយផ្ទាល់
                    </button>

                    <!-- កាកំណត់ Footer -->
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="footer-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20h18M4 4h16v12H4z" />
                        </svg>
                        កាកំណត់ Footer
                    </button>
                </nav>


                {{--  dashbaord setting  --}}
                <h2 class="text-lg font-semibold text-gray-800 mb-4 kantumruy-pro mt-2">
                    <svg class="w-5 h-5 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    ការកំណត់ផ្ទាំង Dashbaord
                </h2>
                 <nav class="space-y-2">
                    <button type="button" class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="roles-settings">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        កាកំណត់តួនាទី&nbsp;(Roles)
                    </button>
                    <button type="button"class="tab-button w-full px-4 py-3 text-left rounded-lg flex items-center gap-2 hover:bg-white transition-colors" data-tab="permissions-settings">
                       <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 002.591.948c.83-.627 1.95.174 1.593 1.118a1.724 1.724 0 001.092 2.158c.956.267.956 1.631 0 1.898a1.724 1.724 0 00-1.092 2.158c.357.944-.763 1.745-1.593 1.118a1.724 1.724 0 00-2.591.948c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-2.591-.948c-.83.627-1.95-.174-1.593-1.118a1.724 1.724 0 00-1.092-2.158c-.956-.267-.956-1.631 0-1.898a1.724 1.724 0 001.092-2.158c-.357-.944.763-1.745 1.593-1.118a1.724 1.724 0 002.591-.948z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        ការកំណត់សិទ្ធ&nbsp;(Permissions)
                    </button>
                </nav>
            </div>
        </div>

        {{--  Form Content  --}}
        <div class="lg:w-3/4 space-y-8">

            {{--  About us Settings Tab   --}}
            {{--  @include('dashboard::setting.partials.formCreateUpdate.aboutSettingForm')  --}}

            {{--  Countact us Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.contactSettingForm')


             {{--  platform us Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.platformSettingForm')

            {{--  title Settings Tab  --}}
            @include('dashboard::setting.partials.formCreateUpdate.generalSettingForm')

            {{--  live setting Settings Tab  --}}
             @include('dashboard::setting.partials.formCreateUpdate.livePageSettingForm')

            {{--  Footer Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.footerSettingForm')

             {{--  Roles Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.rolesSettingForm')

             {{-- Permissions Settings Tab   --}}
            @include('dashboard::setting.partials.formCreateUpdate.permissionsSettingForm')

        </div>
    </div>
    </form>

    @include('dashboard::setting.partials.previewContent')
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
