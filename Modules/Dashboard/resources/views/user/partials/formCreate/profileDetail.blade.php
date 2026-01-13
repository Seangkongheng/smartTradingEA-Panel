<div class="tab-content hidden  rounded-lg bg-white" id="styled-dashboard" role="tabpanel"  style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
    <div class="card-title inter font-[500] py-3 border-b flex items-center  justify-center w-full text-center ">
        <h1 class="m-0 p-0 kantumruy-pro text-lg"><i class="fas fa-user text-yellow-500 mr-2"></i>  <span>  ពត៌មានផ្ទាល់ខ្លួន  </span></h1>
    </div>
    <div class=" inter flex flex-col   justify-center  gap-4 w-[100%] p-10  rounded-2xl">

        <!-- Start fist name -->
        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
            <div class="col-start-1 col-end-3 w-full">
                <label for="">គោត្តនាម</label>
            </div>
            <div class="col-start-3 col-end-13 w-full ">
                <input type="text"   value="{{ old('first_name', isset($userEdit->id) && isset($userEdit->userDetail) ? $userEdit->userDetail->first_name : '') }}" name="first_name" class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none" placeholder="គោត្តនាម*">
            </div>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start Last Name -->
        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
            <div class="col-start-1 col-end-3 w-full">
                <label for="">នាមខ្លួន</label>
            </div>
            <div class="col-start-3 col-end-13 w-full ">
                <input type="text" name="last_name"  value="{{ old('last_name',isset($userEdit->id)&& isset($userEdit->userDetail) ? $userEdit->userDetail->last_name : "") }}"  class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none " placeholder="នាមខ្លួន*">
            </div>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- start date of birth-->
        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
            <div class="col-start-1 col-end-3 w-full">
                <label for="">ជ្រើសរើសថ្ងៃកំណើត</label>
            </div>
            <div class="col-start-3 col-end-13 w-full ">
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth',isset($userEdit->id) && isset($userEdit->userDetail)? $userEdit->userDetail->date_of_birth : "") }}" class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none " placeholder="នាមខ្លួន*">
            </div>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- start phone number-->
        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
            <div class="col-start-1 col-end-3 w-full">
                <label for="">លេខទូរស័ព្ទ</label>
            </div>
            <div class="col-start-3 col-end-13 w-full ">
                <input type="number" name="phone_number" value="{{ old('phone_number',isset($userEdit->id)&&isset($userEdit->userDetail) ? $userEdit->userDetail->phone_number : "") }}"  class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none " placeholder="លេខទូរស័ព្ទ">
            </div>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start Photo -->
        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
            <div class="col-start-1 col-end-3 w-full">
                <label for="">រូបថត</label>
            </div>
            <div class="col-start-3 col-end-13 w-full">
                <label  class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                    <input type="file" name="image" class="sr-only" accept="image/*" />

                    <div id="image-preview" class="{{ isset($userEdit->id) && !empty($userEdit->userDetail->profile) ? '' : 'hidden' }} mb-4 w-full text-center">
                        <img id="preview" class="max-h-48 mx-auto rounded-lg border border-gray-200" alt="Image preview"
                            @if(isset($userEdit->id) && !empty($userEdit->userDetail->profile)) src="{{ asset('profiles/' . $userEdit->userDetail->profile) }}" @endif />
                    </div>

                    <div id="upload-icon" class="w-12 h-12 text-gray-400 mb-4 {{ isset($userEdit->id) && !empty($userEdit->userDetail->profile) ? 'hidden' : '' }}">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                    </div>

                    <div id="upload-text"
                        class="text-center {{ isset($userEdit->id) && !empty($userEdit->userDetail->profile) ? 'hidden' : '' }}">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-blue-600">Click to upload</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            PNG, JPG, JPEG up to 5MB
                        </p>
                    </div>
                    <span id="file-name" class="mt-4 text-sm text-gray-500"></span>
                </label>
            </div>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="image"]');
        const fileNameSpan = document.getElementById('file-name');
        const previewImage = document.getElementById('preview');
        const imagePreviewDiv = document.getElementById('image-preview');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');

          input.addEventListener('change', function() {
              const file = this.files[0];

              if (file) {
                  fileNameSpan.textContent = file.name;

                  const reader = new FileReader();
                  reader.onload = function(e) {
                      previewImage.src = e.target.result;
                      imagePreviewDiv.classList.remove('hidden'); // Show image preview
                      uploadIcon.classList.add('hidden'); // Hide upload icon
                      uploadText.classList.add('hidden'); // Hide upload text
                  };
                  reader.readAsDataURL(file);
              }
          });
      });
  </script>
