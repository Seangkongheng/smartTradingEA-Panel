@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content bg-d w-full">

    <form
        action="{{ isset($marketplaceEdit->id) ? route('admin.marketplace.update', $marketplaceEdit->id) : route('admin.marketplace.store') }}"
        method="POST" class="main-full-content  w-full grid lg:grid-cols-12 gap-10" enctype="multipart/form-data">
        @csrf
        @if (isset($marketplaceEdit->id))
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
                            <span class="kantumruy-pro text-lg">Marketplace Details</span>
                        </h1>
                    </div>

                    {{-- Form Content --}}
                    <div class="inter flex flex-col justify-center gap-4 w-[100%] p-5 lg:p-8 rounded-2xl">

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Title</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text"
                                    value="{{ old('title', isset($marketplaceEdit->id) ? $marketplaceEdit->title : '') }}"
                                    name="title" placeholder="Enter Title*"
                                    class="px-6 py-3.5 text-black bg-gray-100 w-full rounded-xl outline-none">
                            </div>
                        </div>



                        {{-- Feature --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Description</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <textarea class="w-full text-black h-36 p-3 rounded-lg" name="description"
                                    placeholder="Enter Description">{{ old('description', isset($marketplaceEdit->id) ? $marketplaceEdit->description : '')}}</textarea>
                            </div>
                        </div>

                        {{-- Feature --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Feature</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">


                                 <textarea name="feature" id="mytextarea" class="w-full text-black h-36 p-3 rounded-lg" placeholder=""
                                        rows="3" style="height: 150px;">{{ old('feature', isset($marketplaceEdit->id) ? $marketplaceEdit->feature : '')}}</textarea>
                            </div>
                        </div>

                        {{-- Note --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Note</label>
                                <span class="text-sm text-gray-500">(optional)</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <textarea class="w-full text-black h-36 p-3 rounded-lg" name="note"
                                    placeholder="Enter Note">{{ old('description', isset($marketplaceEdit->id) ? $marketplaceEdit->note : '')}}</textarea>
                            </div>
                        </div>

                        {{-- Subscription Plans --}}
                        {{-- Subscription Plans --}}
                        <div class="grid lg:grid-cols-12 gap-6 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full flex flex-col">
                                <label class="text-lg font-semibold text-gray-100">
                                    Subscription Plans <span class="text-red-500">*</span>
                                </label>
                                <p class="text-sm text-gray-400 mt-1">Select one or more plans</p>
                            </div>

                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

                                    @foreach ($plans as $index => $plan)
                                    @php
                                    // Default values
                                    $isChecked = false;
                                    $planPrice = $plan['price'] ?? '';

                                    // Only run this when editing
                                    if (isset($marketplaceEdit) && isset($marketplaceEdit->subscriptionPlans)) {
                                    $selectedPlan = $marketplaceEdit->subscriptionPlans
                                    ->firstWhere('plan_id', $plan['id']);

                                    if (isset($selectedPlan)) {
                                    $isChecked = true;
                                    $planPrice = $selectedPlan->price ?? $planPrice;
                                    }
                                    }
                                    @endphp

                                    <div class="relative group">
                                        {{-- Checkbox --}}
                                        <input type="checkbox" name="plans[{{ $index }}][plan_id]"
                                            id="plan_{{ $plan['id'] }}" value="{{ $plan['id'] }}" class="peer sr-only"
                                            {{ $isChecked ? 'checked' : '' }}>

                                        <label for="plan_{{ $plan['id'] }}" class="flex flex-col p-5 bg-gray-800 text-gray-100 border-2 border-gray-700 rounded-2xl cursor-pointer
                               transition-all duration-200 hover:border-green-400 hover:shadow-lg
                               peer-checked:border-green-500 peer-checked:bg-green-900/20 peer-checked:shadow-xl">

                                            {{-- Plan Info --}}
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <h3 class="text-xl font-bold transition-colors
                                           group-hover:text-green-500 peer-checked:text-green-500">
                                                        {{ $plan['name'] }}
                                                    </h3>
                                                    <p class="text-sm text-gray-400 mt-1">
                                                        {{ $plan['desc'] ?? '' }}
                                                    </p>
                                                </div>

                                                {{-- Checkbox Icon --}}
                                                <div class="flex-shrink-0 w-6 h-6 border-2 border-gray-500 rounded-md
                                       flex items-center justify-center
                                       peer-checked:bg-green-500 peer-checked:border-green-500 transition">
                                                    <svg class="w-4 h-4 text-white hidden peer-checked:block"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            </div>

                                            {{-- Price Input --}}
                                            <input type="number" name="plans[{{ $index }}][price]"
                                                value="{{ old('plans.'.$index.'.price', $planPrice) }}"
                                                class="mt-2 px-3 py-2 rounded-xl outline-none bg-gray-100 text-black w-full"
                                                placeholder="Enter price">
                                        </label>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>


                        {{-- status button --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                            <div class="md:col-span-3 flex items-center h-full">
                                <label class="text-lg kantumruy-pro font-bold text-right pr-4">
                                    Status
                                    <span class="text-sm text-red-500 align-baseline">*</span>
                                </label>
                            </div>

                            <div class="md:col-span-9 flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="1" {{ old('is_public',
                                        $marketplaceEdit->is_public ?? 1)
                                    == 1 ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500">
                                    <span class="text-green-600">Public</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="0" {{ old('is_public',
                                        $marketplaceEdit->is_public ?? 1)
                                    == 0 ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500">
                                    <span class="text-red-600">Private</span>
                                </label>
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


<script src="https://cdn.jsdelivr.net/npm/tinymce@6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker image imagetools codesample template textcolor colorpicker fullscreen',
        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image media link code fullscreen preview | forecolor backcolor | formatselect fontselect fontsizeselect',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        height: 300,
        menubar: 'file edit view insert format tools table help',
        branding: false,
        content_css: '//www.tiny.cloud/css/codepen.min.css',
        content_style: 'body { font-family:Helvetica, Arial, sans-serif; }',
        link_title: false,
        automatic_uploads: true,
        images_upload_url: '/upload-images', // URL for image uploads
        file_picker_types: 'image media',
        file_picker_callback: function(callback, value, meta) {
            if (meta.filetype === 'image') {
                // Provide file and text URL via callback function
                callback('path/to/image.jpg', {
                    alt: 'My alt text'
                });
            }
            if (meta.filetype === 'media') {
                callback('path/to/media.mp4', {
                    poster: 'path/to/poster.jpg'
                });
            }
        },
        image_advtab: true,
        image_caption: true,
        image_title: true,
        image_list: [{
                title: 'My image',
                value: 'path/to/image.jpg'
            },
            {
                title: 'My other image',
                value: 'path/to/other.jpg'
            }
        ],
        importcss_append: true,
        importcss_selector: 'h1, h2, h3, h4, h5, h6, p, a, li, img',
        table_advtab: true,
        table_default_attributes: {
            border: '1',
            cellpadding: '4',
            cellspacing: '0',
            width: '100%'
        },
        style_formats: [{
                title: 'Bold text',
                inline: 'b'
            },
            {
                title: 'Red text',
                inline: 'span',
                styles: {
                    color: '#ff0000'
                }
            },
            {
                title: 'Red header',
                block: 'h1',
                styles: {
                    color: '#ff0000'
                }
            },
            {
                title: 'Example 1',
                inline: 'span',
                classes: 'example1'
            },
            {
                title: 'Example 2',
                inline: 'span',
                classes: 'example2'
            }
        ],
        formats: {
            bold: {
                inline: 'b'
            },
            italic: {
                inline: 'i'
            },
            underline: {
                inline: 'u'
            },
            strikethrough: {
                inline: 's'
            }
        },
        paste_as_text: true,
        contextmenu: 'link image inserttable | cell row column deletetable',
        list: {
            styles: 'disc circle square',
            list_styles: {
                disc: 'Disc',
                circle: 'Circle',
                square: 'Square'
            }
        },
        language: 'km', // Set the language to Khmer
        language_url: 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.5/langs/km.js', // URL for Khmer language file
        directionality: 'ltr', // Khmer is typically written left-to-right
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_retention: '30m',
        end_container_on_empty_block: true,
        paste_preprocess: function(plugin, args) {
            console.log('Pasting:', args.node);
        },
        paste_postprocess: function(plugin, args) {
            console.log('Pasted:', args.node);
        },
        image_dimensions: true,
        image_title: true,
        media_poster: true,
        templates: [{
                title: 'Template 1',
                description: 'Description 1',
                content: '<p>Template 1 content</p>'
            },
            {
                title: 'Template 2',
                description: 'Description 2',
                content: '<p>Template 2 content</p>'
            }
        ],
        font_formats: 'Andale Mono=andale mono, monospace; Arial=arial, helvetica, sans-serif; Courier New=courier new, courier; Georgia=georgia, serif; Times New Roman=times new roman, times; Trebuchet MS=trebuchet ms, helvetica; Verdana=verdana, geneva; Khmer OS=Khmer OS, khmer; Hanuman=Hanuman, khmer',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        textcolor_map: [
            "000000", "Black",
            "FF0000", "Red",
            "00FF00", "Green",
            "0000FF", "Blue",
            "FFFF00", "Yellow",
            "FF00FF", "Magenta",
            "00FFFF", "Cyan",
            "C0C0C0", "Silver",
            "808080", "Gray",
            "800000", "Maroon",
            "808000", "Olive",
            "008000", "Dark Green",
            "800080", "Purple",
            "008080", "Teal",
            "F0F8FF", "AliceBlue",
            "FAEBD7", "AntiqueWhite",
            "00FFFF", "Aqua",
            "F0FFFF", "Azure",
            "F5F5DC", "Beige",
            "FFE4C4", "Bisque",
            "FFE4E1", "MistyRose",
            "FFB6C1", "LightPink",
            "FFA07A", "LightSalmon",
            "FFD700", "Gold",
            "DAA520", "GoldenRod",
            "808080", "Gray",
            "F0F8FF", "AliceBlue",
            "FAEBD7", "AntiqueWhite",
            "00FFFF", "Aqua"
        ]
    });
</script>
