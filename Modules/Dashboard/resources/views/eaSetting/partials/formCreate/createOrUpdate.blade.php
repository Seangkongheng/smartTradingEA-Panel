@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content bg-d w-full">

    <form
        action="{{ isset($eaSettingEdit->id) ? route('admin.eaSettings.update', $eaSettingEdit->id) : route('admin.eaSettings.store') }}"
        method="POST" class="main-full-content  w-full grid lg:grid-cols-12 gap-10" enctype="multipart/form-data">
        @csrf
        @if (isset($eaSettingEdit->id))
        @method('PUT')
        @endif
        {{-- Start Content create --}}
        <div class="lg:col-start-1 lg:col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content   rounded-3xl bg-[#131d41]  p-5" id="styled-profile" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                class="fill-current text-yellow-500 mr-2">
                                <path
                                    d="m380-340 280-180-280-180v360Zm-60 220v-80H160q-33 0-56.5-23.5T80-280v-480q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v480q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-480H160v480Zm0 0v-480 480Z" />
                            </svg> <span class="kantumruy-pro text-lg"> EA Setting Detail </span>
                        </h1>
                    </div>


                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-5 lg:p-8  rounded-2xl">

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 font-bold lg:col-end-3 w-full">
                                <label for="">Title</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text"
                                    value="{{ old('title', isset($eaSettingEdit->id) ? $eaSettingEdit->title : '') }}"
                                    name="title"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your title*" required>
                                @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  Noted : Profit  --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 font-bold lg:col-end-3 w-full">
                                <label for="">Profit</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="number"
                                    value="{{ old('profit', isset($eaSettingEdit->id) ? $eaSettingEdit->profit : '') }}"
                                    name="profit"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your profit*" required>
                                @error('profit')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        {{--  Noted Balance  --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 font-bold lg:col-end-3 w-full">
                                <label for="">Balance</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="number"
                                    value="{{ old('balance', isset($eaSettingEdit->id) ? $eaSettingEdit->balance : '') }}"
                                    name="balance"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your banlance*" required>
                                @error('balance')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  Noted Drawdown  --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 font-bold lg:col-end-3 w-full">
                                <label for="">Drawdown</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="number"
                                    value="{{ old('drawdown', isset($eaSettingEdit->id) ? $eaSettingEdit->drawdown : '') }}"
                                    name="drawdown"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your drawdown*" required>
                                @error('drawdown')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{--  Noted : Tradding Hours  --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Tradding Hours</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <textarea name="tradding_hours" id="mytextarea"
                                    class="w-full text-black h-40 p-3 rounded-lg" placeholder="" rows="3"
                                    style="height: 150px;">{{ old('tradding_hours', isset($eaSettingEdit->id) ? $eaSettingEdit->tradding_hours : '')}}</textarea>
                                @error('tradding_hours')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        {{-- Description --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label>Description</label>
                                <span class="text-sm text-red-500">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <textarea name="description" id="mytextarea"
                                    class="w-full text-black h-40 p-3 rounded-lg" placeholder="" rows="3"
                                    style="height: 150px;">{{ old('description', isset($eaSettingEdit->id) ? $eaSettingEdit->description : '')}}</textarea>
                            </div>
                        </div>



                        {{-- Attachment --}}
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start mt-6">

                            <div class="md:col-span-2 flex items-center h-full">
                                <label for="file_document" class="text-lg font-bold kantumruy-pro text-right pr-4">
                                    Attachment
                                    <span class="text-sm text-red-600 align-baseline">*</span>
                                </label>
                            </div>

                            {{-- Noted : Content Column --}}
                            <div class="md:col-span-10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Left: Drop Zone -->
                                    <div id="file-drop-zone"
                                        class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-green-500 hover:bg-green-50 transition-all duration-200 relative">
                                        <input type="file" name="file[]" id="fileInput" multiple
                                            accept=".zip,application/zip,application/x-zip-compressed" class="hidden" />

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
                                        $oldDocuments = !empty($eaSettingEdit->file)
                                        ? json_decode($eaSettingEdit->file, true)
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
                                <label class="text-lg kantumruy-pro font-bold text-right pr-4">
                                    Status
                                    <span class="text-sm text-red-500 align-baseline">*</span>
                                </label>
                            </div>

                            <div class="md:col-span-9 flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="1" {{ old('is_public',
                                        $eaSettingEdit->is_public ?? 1)
                                    == 1 ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500">
                                    <span class="text-gray-700">Public</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="0" {{ old('is_public',
                                        $eaSettingEdit->is_public ?? 1)
                                    == 0 ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500">
                                    <span class="text-red-600">Private</span>
                                </label>
                            </div>
                        </div>


                        {{-- Action Button --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro mt-5">
                            <div class="lg:col-start-1 lg:col-end-13 flex items-center justify-end w-full space-x-3">

                                {{-- Cancel Button --}}
                                <button type="button" onclick="window.history.back()"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-gray-500 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-gray-600 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">Cancel</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" class="fill-current">
                                            <path
                                                d="M480-480 280-280l-56-56 144-144-144-144 56-56 200 200 200-200 56 56-144 144 144 144-56 56-200-200Z" />
                                        </svg>
                                    </span>
                                </button>

                                {{-- Save Button --}}
                                <button type="submit"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-green-600 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-green-700 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">
                                        {{ isset($eaSettingEdit->id) ? "Update" : "Save" }}
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" class="fill-current">
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
