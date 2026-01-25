@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content bg-d w-full">

    <form action="{{ isset($planEdit->id) ? route('admin.plan.update', $planEdit->id) : route('admin.plan.store') }}"
     method="POST" class="main-full-content  w-full grid lg:grid-cols-12 gap-10"
        enctype="multipart/form-data">
        @csrf
        @if (isset($planEdit->id))
        @method('PUT')
        @endif
        {{-- Start Content Create --}}
        <div class="lg:col-start-1 lg:col-end-13 rounded-2xl table-content w-full flex flex-col">
            <div id="default-styled-tab-content" class="w-full">
                <div class="tab-content rounded-3xl bg-[#131d41] p-5" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">

                    {{-- Header --}}
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center">
                        <h1 class="m-0 p-0 text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                class="fill-current text-yellow-500 mr-2">
                                <path
                                    d="m380-340 280-180-280-180v360Zm-60 220v-80H160q-33 0-56.5-23.5T80-280v-480q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v480q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-480H160v480Zm0 0v-480 480Z" />
                            </svg>
                            <span class="kantumruy-pro text-lg">Plan Details</span>
                        </h1>
                    </div>

                    {{-- Form Content --}}
                    <div class="inter flex flex-col justify-center gap-4 w-[100%] p-5 lg:p-8 rounded-2xl">

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Name</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text" name="name"  value="{{ old('name', isset($planEdit->id) ? $planEdit->name : '') }}" placeholder="Enter name*"
                                    class="px-6 py-3.5 text-black bg-gray-100 w-full rounded-xl outline-none">
                            </div>
                        </div>

                         {{-- price --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Price</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="number" name="price"  value="{{ old('price', isset($planEdit->id) ? $planEdit->price : '') }}" placeholder="Enter price*"
                                    class="px-6 py-3.5 text-black bg-gray-100 w-full rounded-xl outline-none">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro mt-5">
                            <div class="lg:col-start-1 lg:col-end-13 flex items-center justify-end w-full space-x-3">
                                <button type="button" onclick="window.history.back()"
                                    class="inter px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="inter px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all">
                                    Save
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- End Content Create --}}


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
