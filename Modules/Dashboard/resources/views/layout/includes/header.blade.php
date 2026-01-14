<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart TrandingEA Panel</title>
    @vite('resources/css/app.css')
    {{-- this is Link Style Css --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{asset('images/SuperTradingEA_logo.png')}}" type="image/x-icon">
    
    {{-- this is link google icon --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


    {{--  Noted : Select2 CSS   --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=language" />
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.1/tinymce.min.js" referrerpolicy="origin"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Freehand&family=Hanuman:wght@100;300;400;700;900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Khmer:wght@100..900&family=Noto+Serif+Khmer:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Siemreap&family=Sofia&family=Space+Grotesk:wght@300..700&family=Spline+Sans+Mono:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Khmer OS';
            src: local('Khmer OS'), local('KhmerOS');
        }

        body {
            font-family: 'Khmer OS', "Freehand", cursive;
        }

        @font-face {
            font-family: 'Siemreap';
            src: local('Siemreap'), local('KhmerSimreap');
        }

        body {
            font-family: 'Siemreap', "Siemreap", sans-serif;
        }

        @font-face {
            font-family: 'Hanuman';
            src: local('Hanuman'), local('Hanuman');
        }

        body {
            font-family: 'Hanuman', 'Khmer Simreap', Arial, sans-serif;
        }

        @font-face {
            font-family: 'Noto Font Safari';
            src: local('Noto Font Safari'), local('Noto Font Safari');
        }

        body {
            font-family: 'Noto Sans Khmer', "Noto Sans Khmer", sans-serif;
        }

        .nsk {
            font-family: "Noto Sans Khmer", sans-serif;

        }

        .siemreap {
            font-family: "Siemreap", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-medium {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker image imagetools codesample template textcolor colorpicker fullscreen',
            toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image media link code fullscreen preview | formatselect fontselect fontsizeselect',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            height: 600,
            menubar: 'file edit view insert format tools table help',
            branding: false,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            content_style: 'body { font-family:Helvetica, Arial, sans-serif; }',
            link_title: false,
            automatic_uploads: true,
            images_upload_url: '/upload-images',
            file_picker_types: 'image media',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
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
                    title: 'Noto Font Safari',
                    inline: 'span',
                    styles: {
                        'font-family': 'Noto Sans Khmer',
                    },
                },
                {
                    title: 'Hanuman',
                    inline: 'span',
                    styles: {
                        'font-family': 'Hanuman',
                    },
                },
                {
                    title: 'Siemreap',
                    inline: 'span',
                    styles: {
                        'font-family': 'Siemreap',
                    },
                },
                {
                    title: 'Khmer OS',
                    inline: 'span',
                    styles: {
                        'font-family': 'Khmer OS'
                    },
                },
                {
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
            language: 'km',
            language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.7.0/langs6/km.min.js',
            directionality: 'ltr',
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
            font_formats: 'Khmer Os = Khmer OS, Andale Mono=andale mono, monospace; Arial=arial, helvetica, sans-serif; Courier New=courier new, courier; Georgia=georgia, serif; Times New Roman=times new roman, times; Trebuchet MS=trebuchet ms, helvetica; Verdana=verdana, geneva; Khmer OS=Khmer OS, khmer; Hanuman=Hanuman, khmer',
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
</head>

<body>
