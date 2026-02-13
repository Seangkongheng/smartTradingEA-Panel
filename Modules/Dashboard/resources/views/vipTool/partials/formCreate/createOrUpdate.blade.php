@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content bg-d w-full">
    <form action={{ isset($vipToolEdit->id) ? route('admin.vip-tools.update', $vipToolEdit->id) :
        route('admin.vip-tools.store') }} method="POST" class="main-full-content w-full grid lg:grid-cols-12 gap-10"
        enctype="multipart/form-data">
        @csrf
        @if (isset($vipToolEdit->id))
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
                            </svg> <span class="kantumruy-pro text-lg">Vip Tools</span>
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
                                    value="{{ old('title', isset($vipToolEdit->id) ? $vipToolEdit->title : '') }}"
                                    name="title"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your title*" required>
                                @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label for="">Description</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <textarea id="mytextarea" placeholder="Enter Description.."
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none"
                                    name="description"
                                    id="">{{ old('description', isset($vipToolEdit->id) ? $vipToolEdit->description : '') }}</textarea>
                                @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label for="">Video URL</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text"
                                    value="{{ old('link', isset($vipToolEdit->id) ? $vipToolEdit->link : '') }}"
                                    name="link"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your Video URL*" required>
                                @error('link')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
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
                                        $vipToolEdit->is_public ?? 1)
                                    == 1 ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500">
                                    <span class="text-gray-700">Public</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_public" value="0" {{ old('is_public',
                                        $vipToolEdit->is_public ?? 1)
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
                                        {{ isset($vipToolEdit->id) ? "Update" : "Save" }}
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
