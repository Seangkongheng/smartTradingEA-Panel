@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content w-full">
     {{--  action="{{ isset($attachmentLessonDetailEdit->id) ? route('', $attachmentLessonDetailEdit->id) : route('') }}"  --}}
    <form
        action=""
        method="POST" class="main-full-content w-full grid lg:grid-cols-12 gap-10" enctype="multipart/form-data">
        @csrf
        @if (isset($attachmentLessonDetailEdit->id))
        @method('PUT')
        @endif
        {{-- Start Content create --}}
        <div class="lg:col-start-1 lg:col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content   rounded-lg  bg-white" id="styled-profile" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                class="fill-current text-yellow-500 mr-2">
                                <path
                                    d="m380-340 280-180-280-180v360Zm-60 220v-80H160q-33 0-56.5-23.5T80-280v-480q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v480q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-480H160v480Zm0 0v-480 480Z" />
                            </svg> <span class="kantumruy-pro text-lg"> Attachment Detail </span>
                        </h1>
                    </div>


                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-5 lg:p-8  rounded-2xl">

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label for="">Title</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text"
                                    value="{{ old('title', isset($attachmentLessonDetailEdit->id) ? $attachmentLessonDetailEdit->AttachmentLesson->title : '') }}"
                                    name="title"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your title*" required>
                                @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        {{-- Thumbnail --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                            <div class="md:col-span-2 flex items-center h-full">
                                <label for="thumbnail_image" class="text-lg kantumruy-pro text-right pr-4">
                                    Thumbnail
                                    <span class="text-sm text-gray-500 align-baseline">(Optional)</span>
                                </label>
                            </div>
                            <div class="md:col-span-10">
                                <label for="thumbnail_image"
                                    class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-600 hover:bg-gray-50 transition duration-200">
                                    <input type="file" id="thumbnail_image" name="thumbnail" class="sr-only"
                                        accept="image/png,image/jpeg,image/jpg">

                                    @if (!empty($attachmentLessonDetailEdit->thumbnail))
                                    <div id="thumbnail-image-preview" class="mb-4 w-full text-center">
                                        <img id="thumbnail-preview"
                                            src="{{ asset($attachmentLessonDetailEdit->thumbnail) }}"
                                            alt="thumbnail preview"
                                            class="max-h-48 mx-auto rounded-lg border border-gray-200">
                                    </div>
                                    @else
                                    <div id="thumbnail-upload-icon" class="w-12 h-12 text-gray-400 mb-4">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div id="thumbnail-upload-text" class="text-center">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-semibold text-blue-600">Click to upload</span>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG up to 5MB</p>
                                    </div>
                                    @endif

                                    <span id="thumbnail-file-name" class="mt-4 text-sm text-gray-500"></span>
                                </label>
                                @error('thumbnail')
                                <span class="block mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        {{-- Attachment --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start mt-6">
                            <!-- Label Column -->
                            <div class="md:col-span-2 flex items-center h-full">
                                <label for="file_document" class="text-lg kantumruy-pro text-right pr-4">
                                    Attachment
                                    <span class="text-sm text-gray-500 align-baseline">(Optional)</span>
                                </label>
                            </div>

                            <!-- Content Column -->
                            <div class="md:col-span-10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Left: Drop Zone -->
                                    <div id="file-drop-zone"
                                        class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-500 hover:bg-green-50 transition-all duration-200 relative">
                                        <input type="file" name="file[]" id="fileInput" multiple
                                            accept="application/pdf,image/png,image/jpeg,image/jpg" class="hidden" />

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-500 mb-3"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>

                                        <p class="text-sm text-gray-600 mb-3">Drag or drop files to upload</p>

                                        <button type="button" id="chooseFileButton"
                                            class="bg-green-500 hover:bg-green-600 text-white text-sm px-5 py-2 rounded-lg shadow-sm transition">
                                            Choose File
                                        </button>
                                    </div>

                                    <!-- Right: Upload List -->
                                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                        <h3 class="text-gray-700 text-base font-medium mb-4">Uploading</h3>

                                        {{-- Old Files --}}
                                        @php
                                        $oldDocuments = !empty($attachmentLessonDetailEdit->file)
                                        ? json_decode($attachmentLessonDetailEdit->file, true)
                                        : [];
                                        @endphp

                                        <div id="file-list" class="space-y-4">
                                            @foreach ($oldDocuments as $index => $doc)
                                            <div
                                                class="flex items-center justify-between bg-white shadow-sm p-3 rounded-lg border border-gray-100 old-file-item">
                                                <span class="text-sm text-gray-700 truncate">
                                                    {{ pathinfo($doc['name'], PATHINFO_FILENAME) }}
                                                </span>
                                                <button type="button"
                                                    class="text-red-500 hover:text-red-700 remove-old-file">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                                <input type="hidden" name="old_documents[]"
                                                    value="{{ json_encode($doc) }}">
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="mt-4">
                                            <button type="button" id="addMoreFileButton"
                                                class="flex items-center gap-2 text-green-600 hover:text-green-700 text-sm font-medium">
                                                <i class="fa-solid fa-plus"></i> Add More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- status button --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                            <div class="md:col-span-3 flex items-center h-full">
                                <label class="text-lg kantumruy-pro text-right pr-4">
                                    Status
                                    <span class="text-sm text-red-500 align-baseline">*</span>
                                </label>
                            </div>

                            <div class="md:col-span-9 flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="1" {{ old('is_public',
                                        $attachmentLessonDetailEdit->is_public ?? 1)
                                    == 1 ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500">
                                    <span class="text-gray-700">Public</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="0" {{ old('is_public',
                                        $attachmentLessonDetailEdit->is_public ?? 1)
                                    == 0 ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500">
                                    <span class="text-red-600">Private</span>
                                </label>
                            </div>
                        </div>

                        {{--  Action Button  --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro mt-5">
                            <div class="lg:col-start-1 lg:col-end-13 flex items-center justify-end w-full space-x-3">

                                {{--  Cancel Button  --}}
                                <button type="button"
                                    onclick="window.history.back()"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-gray-500 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-gray-600 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">Cancel</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                            class="fill-current">
                                            <path
                                                d="M480-480 280-280l-56-56 144-144-144-144 56-56 200 200 200-200 56 56-144 144 144 144-56 56-200-200Z" />
                                        </svg>
                                    </span>
                                </button>

                                {{--  Save Button  --}}
                                <button type="submit"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-green-600 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-green-700 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">
                                        {{ isset($attachmentLessonDetailEdit->id) ? "Update" : "Save" }}
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                            class="fill-current">
                                            <path
                                                d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- end Content create --}}
    </form>
</div>



{{-- Attachment --}}
<script>
    const fileInput = document.getElementById("fileInput");
    const fileDropZone = document.getElementById("file-drop-zone");
    const chooseFileButton = document.getElementById("chooseFileButton");
    const fileList = document.getElementById("file-list");
    const addMoreFileButton = document.getElementById("addMoreFileButton");

    // ✅ Prevent double file picker trigger
    chooseFileButton.addEventListener("click", (e) => {
        e.stopPropagation();
        fileInput.click();
    });

    addMoreFileButton.addEventListener("click", (e) => {
        e.stopPropagation();
        fileInput.click();
    });

    fileDropZone.addEventListener("click", (e) => {
        if (e.target === fileDropZone) { // ✅ Only trigger if clicking the zone itself
            fileInput.click();
        }
    });

    // Drag and Drop
    fileDropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        fileDropZone.classList.add("border-green-500", "bg-green-50");
    });

    fileDropZone.addEventListener("dragleave", () => {
        fileDropZone.classList.remove("border-green-500", "bg-green-50");
    });

    fileDropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        fileDropZone.classList.remove("border-green-500", "bg-green-50");
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener("change", (e) => handleFiles(e.target.files));

    // ✅ Handle File Display
    function handleFiles(files) {
        Array.from(files).forEach((file) => {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(1);
            const fileItem = document.createElement("div");
            fileItem.className =
                "border border-gray-200 rounded-md p-3 flex items-center justify-between bg-gray-50";

            const fileIcon =
                file.type.includes("pdf")
                    ? '<i class="fa-solid fa-file-pdf text-red-500"></i>'
                    : '<i class="fa-solid fa-file-image text-blue-500"></i>';

            fileItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-md">
                        ${fileIcon}
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-medium truncate">${file.name}</p>
                        <p class="text-xs text-gray-400">${fileSizeMB} MB</p>
                        <div class="w-40 bg-gray-200 rounded-full h-2 mt-1 overflow-hidden">
                            <div class="bg-blue-500 h-2 w-0 transition-all duration-300 progress-bar"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 progress-text">0% done</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-red-500 remove-btn text-lg">&times;</button>
            `;

            const progressBar = fileItem.querySelector(".progress-bar");
            const progressText = fileItem.querySelector(".progress-text");

            fileList.appendChild(fileItem);

            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.floor(Math.random() * 10);
                if (progress > 100) progress = 100;
                progressBar.style.width = progress + "%";
                progressText.textContent = progress < 100 ? `${progress}% done` : "Completed";
                if (progress === 100) clearInterval(interval);
            }, 300);

            fileItem.querySelector(".remove-btn").addEventListener("click", () => fileItem.remove());
        });
    }

    document.querySelectorAll(".remove-old-file").forEach(btn => {
        btn.addEventListener("click", function() {
            this.closest(".old-file-item").remove();
        });
    });
</script>






@push('scripts')




<script>
    document.addEventListener("DOMContentLoaded", function () {
    // ===== VIDEO PREVIEW =====
    const videoInput = document.getElementById("video_file");
    const videoPreview = document.getElementById("video-preview");
    const uploadIcon = document.getElementById("video-upload-icon");
    const uploadText = document.getElementById("video-upload-text");
    const fileNameSpan = document.getElementById("video-file-name");

    if (videoInput) {
        videoInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const fileURL = URL.createObjectURL(file);
                videoPreview.src = fileURL;
                videoPreview.classList.remove("hidden");
                uploadIcon.classList.add("hidden");
                uploadText.classList.add("hidden");
                fileNameSpan.textContent = file.name;
            } else {
                videoPreview.src = "";
                videoPreview.classList.add("hidden");
                uploadIcon.classList.remove("hidden");
                uploadText.classList.remove("hidden");
                fileNameSpan.textContent = "";
            }
        });
    }

    // ===== DOCUMENT PREVIEW (PDF & IMAGES) =====
    const fileInput = document.getElementById("file_document");
    const oldFilesPreview = document.getElementById("old-files-preview");
    const fileNameText = document.getElementById("file-file-name");

    if (fileInput) {
        fileInput.addEventListener("change", function (event) {
            const files = Array.from(event.target.files);

            // Clear any existing preview (optional)
            if (oldFilesPreview) oldFilesPreview.innerHTML = "";

            files.forEach((file) => {
                const fileURL = URL.createObjectURL(file);
                const fileDiv = document.createElement("div");
                fileDiv.classList.add(
                    "bg-gray-50",
                    "p-3",
                    "rounded-xl",
                    "border",
                    "border-gray-200",
                    "text-center",
                    "hover:shadow-md",
                    "transition"
                );

                if (file.type.startsWith("image/")) {
                    fileDiv.innerHTML = `
                        <img src="${fileURL}" alt="${file.name}"
                            class="w-full h-[10rem] object-cover rounded-lg mb-2">
                        <p class="text-sm text-gray-700 break-words leading-snug">${file.name}</p>
                    `;
                } else if (file.type === "application/pdf") {
                    fileDiv.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-[8rem]">
                            <i class="fa-solid fa-file-pdf text-red-500 text-4xl mb-2"></i>
                            <p class="text-sm text-gray-700">${file.name}</p>
                        </div>
                    `;
                } else {
                    fileDiv.innerHTML = `<p class="text-sm text-gray-500">${file.name}</p>`;
                }

                oldFilesPreview?.appendChild(fileDiv);
            });

            // Show filenames below input
            fileNameText.textContent = files.map((f) => f.name).join(", ");
        });
    }
});
</script>

@endpush
