{{-- Subscription Details Page --}}
<div class="min-h-screen ">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <p class="text-sm text-slate-500">
                    Placed on
                    <span class="font-medium text-slate-700">
                        {{ $subscription->created_at->format('F d, Y \a\t H:i') }}
                    </span>
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    Customer:
                    <span class="font-medium text-slate-800">
                        {{ $subscription->user->first_name ?? 'Unknown' }}
                        {{ $subscription->user->last_name ?? '' }}
                    </span>
                    ({{ $subscription->user->email ?? 'No Email' }})
                </p>
            </div>

            @php
            $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'paid' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            ];
            @endphp

            <span
                class="px-5 py-2 rounded-full text-sm font-semibold {{ $statusColors[$subscription->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($subscription->status) }}
            </span>
        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PAYMENT INFO --}}
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Payment Information</h2>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Payment Status</span>
                    <span
                        class="px-3 py-1 font-medium rounded-full {{ $statusColors[$subscription->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Method</span>
                    <span class="font-medium text-slate-800">
                        ABA Payway
                    </span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Bank Name</span>
                    <span class="font-medium text-slate-800">
                        {{ $subscription->order->bank_account_name ?? 'N/A' }}
                    </span>
                </div>

                <div class="pt-4 border-t flex justify-between items-center">
                    <span class="font-semibold text-slate-900">Total</span>
                    <span class="text-2xl font-bold text-blue-600">
                        ${{ number_format($subscription->total_price ?? 0, 2) }}
                    </span>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- SUBSCRIPTION ITEM --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Subscription Details</h2>

                    <div class="flex items-center gap-5 p-5 rounded-xl bg-slate-50 border">
                        <div
                            class="w-14 h-14 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-lg">
                            1
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-slate-900">
                                {{ $subscription->marketplace->title ?? 'Marketplace N/A' }}
                            </h3>
                            <p class="text-sm text-slate-600">
                                Plan:
                                <span class="font-medium text-slate-900">
                                    {{ $subscription->subscriptionPlan->name ?? 'No plan' }}
                                </span>
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-lg font-bold text-purple-600">
                                ${{ number_format($subscription->total_price ?? 0, 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- UPDATE STATUS --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Update Order Status</h2>

                    <form action="{{ route('admin.update', $subscription->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <select id="status" name="status"
                            class="w-full px-4 py-3  text-black rounded-xl border-2 border-slate-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none">
                            <option value="rejected" {{ $subscription->status == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                            <option value="confirmed" {{ $subscription->status == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>

                        </select>


                        <div id="noteInput" class="hidden text-black">
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Note
                            </label>

                            <textarea id="mytextarea" name="note" rows="6" placeholder="Enter note here..."
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none">{{ old('note', $subscription->note) }}</textarea>
                        </div>


                        <button type="submit"
                            class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">
                            Update Status
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    const statusSelect = document.getElementById('status');
    const noteInput = document.getElementById('noteInput');

    function toggleLicenseKey() {
        if (statusSelect.value === 'confirmed') {
            noteInput.classList.remove('hidden');
        } else {
            noteInput.classList.add('hidden');
        }
    }

    // Run on page load
    toggleLicenseKey();

    // Run when status changes
    statusSelect.addEventListener('change', toggleLicenseKey);
</script>
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
