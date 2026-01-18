  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-white font-bold">User</span>
            <span class="text-gray-300 mx-2">/</span>
            <span  class="text-gray-600">{{ isset($userEdit->id) ? 'Update User' : 'Create User' }}</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.user.index') }}"
            class="flex items-center gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span class="font-medium">Back</span>
        </a>
    </div>
</div>

<div class="main-content w-full bg-[#131d41]  rounded-3xl ">
    <form action="{{ isset($userEdit->id) ? route('admin.user.update', $userEdit->id) : route('admin.user.store') }}"
        method="POST" class="main-full-content w-full grid lg:grid-cols-12 gap-10" enctype="multipart/form-data">
        @csrf
        @if (isset($userEdit->id))
            @method('PUT')
        @endif

        {{-- start tap pill --}}
        <div class="lg:col-start-1 lg:col-end-4  rounded-2xl relative table-content-tap flex flex-col justify-between h-[20rem] pb-10"
            style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
            <div class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                <h1 class="m-0 p-0 text-lg flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        <path stroke-linecap="round" stroke-linejoin="round"   d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    <span class="kantumruy-pro text-xl">Manage Account</span>
                </h1>

            </div>
            <ul class=" flex-wrap flex-col  -mb-px text-sm font-medium text-center items-center justify-center w-full"  role="tablist">
                <li class="me-2 w-full " role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full kantumruy-pro" data-tab="styled-profile" type="button" role="tab"><span  class="kantumruy-pro text-lg">Account Detail</span></button>
                </li>
                <li class="me-2 w-full" role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full kantumruy-pro " data-tab="styled-dashboard"   type="button" role="tab"><span   class="kantumruy-pro text-lg">Information</span></button>
                </li>
                <li class="me-2 w-full" role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full  " data-tab="styled-settings" type="button" role="tab"><span class="kantumruy-pro text-lg">Role and Permission</span></button>
                </li>
            </ul>
            <div class="flex items-center gap-5 mt-5 justify-center">
                    <button type="submit"  class="inter px-5 py-2 p-8  backdrop-blur-lg text-white bg-green-600  rounded-lg items-center gap-0.5 inline-flex border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out "><span class="kantumruy-pro font-[500]">{{ isset($userEdit->id) ? 'Update' : 'Save ' }}</span>
                        <span><svg  xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" class="fill-current">
                            <path  d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" />
                        </svg>
                    </span>
                </button>
                @if(isset($userEdit->id))
                   @if (!$userEdit->is_active)
                        {{-- Show unblock --}}
                        <a href="#" onclick="event.preventDefault(); document.getElementById('unblock-user-form').submit();" class="inter px-5 py-2 p-8 backdrop-blur-lg text-white bg-blue-600 rounded-lg inline-flex items-center gap-1 border border-white/15 hover:bg-blue-700 transition-all">
                            <span class="kantumruy-pro font-[500]">Unblock</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" class="fill-current">
                                    <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6-7V7a6 6 0 0 0-12 0v3H4v12h16V10h-2zm-8-3a4 4 0 0 1 8 0v3H6V7zm10 15H6V12h12v10z" />
                                </svg>
                            </span>
                        </a>
                    @else
                        {{-- Show block --}}
                        <a href="#" onclick="event.preventDefault(); document.getElementById('block-user-form').submit();" class="inter px-5 py-2 p-8 backdrop-blur-lg text-white bg-red-600 rounded-lg inline-flex items-center gap-1 border border-white/15 hover:bg-red-700 transition-all">
                            <span class="kantumruy-pro font-[500]">Block</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" class="fill-current">
                                    <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6-7V7a6 6 0 0 0-12 0v3H4v12h16V10h-2zm-8-3a4 4 0 0 1 8 0v3H6V7zm10 15H6V12h12v10z" />
                                </svg>
                            </span>
                        </a>
                    @endif
                 @endif
            </div>
        </div>
        {{-- end tap pill --}}

        {{-- Start Content create --}}
        <div class="lg:col-start-4 lg:col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                @include('dashboard::user.partials.formCreate.accountDetail')
                @include('dashboard::user.partials.formCreate.profileDetail')
                @include('dashboard::user.partials.formCreate.assignmentAccount')
            </div>
        </div>
        {{-- end Content create --}}
    </form>

    {{-- Block​ Unblock Form --}}
    <form id="block-user-form" action="{{ route('admin.user.block', isset($userEdit->id)? $userEdit->id : " ") }}" method="POST" style="display: none;">
        @csrf
    </form>
    <form id="unblock-user-form" action="{{ route('admin.user.unblock', isset($userEdit->id)? $userEdit->id : " ") }}" method="POST" style="display: none;">
        @csrf
    </form>

</div>


{{--  Noted : Script  --}}
<script>
    function isBlock(event) {
    event.preventDefault(); // Prevent link from reloading the page
    Swal.fire({
        title: "តើអ្នកប្រាកដថាចង់បិទអាខោននេះមែនទេ?",
        text: "ប្រសិនបើបិទ អ្នកប្រើប្រាស់នេះនឹងមិនអាចប្រើប្រាស់បានទេ។",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "បិទអាខោន",
        cancelButtonText: "បោះបង់",
        showClass: {
            popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
            `
        },
        hideClass: {
            popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
            `
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // TODO: Add your block/deactivate logic here
            Swal.fire(
                'បានបិទអាខោន!',
                'អាខោនត្រូវបានបិទដោយជោគជ័យ។',
                'success'
            );
        }
    });
}



    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-tab');

            // Remove active styles from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('text-green-600', 'bg-green-50');
            });

            // Hide all tab contents
            tabContents.forEach(content => content.classList.add('hidden'));

            // Show selected tab content
            document.getElementById(target).classList.remove('hidden');

            // Add active styles to clicked button
            button.classList.add('text-green-600', 'bg-green-50');
        });
    });

    // Optional: Activate the first tab on load
    tabButtons[0].click();


    const input = document.querySelector('input[type="file"]');
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('image-preview');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadText = document.getElementById('upload-text');

    input.addEventListener('change', function(e) {
        const file = this.files[0];
        const fileName = document.getElementById('file-name');

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                preview.src = reader.result;
                imagePreview.classList.remove('hidden');
                uploadIcon.classList.add('hidden');
                uploadText.classList.add('hidden');
                fileName.textContent = file.name;
            });

            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            imagePreview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            uploadText.classList.remove('hidden');
            fileName.textContent = '';
        }
    });
</script>
