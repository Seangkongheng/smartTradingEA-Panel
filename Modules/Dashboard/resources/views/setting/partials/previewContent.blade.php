{{-- start main --}}
    <div class="main-content mt-5 w-full p-8 rounded-[2rem] border-transparent  relative overflow-hidden" style="box-shadow: rgba(50, 50, 93, 0.08) 0px 13px 27px -5px, rgba(0, 0, 0, 0.08) 0px 8px 16px -8px;">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 kantumruy-pro flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            Preview All Settings
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative">
            {{-- Profile Section --}}
            @include('dashboard::setting.partials.previewBlock.profileBlock')

            {{-- Block About --}}
            @include('dashboard::setting.partials.previewBlock.aboutBlock')

            {{--  Start General Information  --}}
            <div class="col-span-full w-full">
                <div class="relative py-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300/30"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 py-1 bg-white rounded-3xl text-sm text-gray-500">ពត៏មានទូទៅ</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    {{--  block contact   --}}
                    @include('dashboard::setting.partials.previewBlock.contact')
                    {{--  Blog footer  --}}
                    @include('dashboard::setting.partials.previewBlock.footerBlock')
                    {{--  Block Platform  --}}
                    @include('dashboard::setting.partials.previewBlock.platFormBlock')
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end main --}}
