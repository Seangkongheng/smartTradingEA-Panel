<div class="main-full-content grid lg:grid-cols-2 px-6 lg:px-16 py-10 lg:py-14 bg-gradient-to-br from-white via-violet-100 to-violet-300 rounded-2xl w-full min-h-[25vh] relative overflow-hidden"
    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">

    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 Q50,30 100,0 L100,100 L0,100 Z" fill="url(#grad)" />
            <defs>
                <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#b3a0ff;stop-opacity:0.5" />
                </linearGradient>
            </defs>
        </svg>
    </div>

    <div class="flex flex-col gap-6 z-10">
        <div
            class="text-base sm:text-lg text-violet-700 flex items-center justify-center lg:justify-start gap-3 font-semibold group transition-all duration-300">
            <span class="text-3xl sm:text-4xl transform group-hover:scale-110 transition-transform">🌤️</span>
            <span class="font-semibold text-xl ">{{ $greeting ?? "Unknown" }},</span>
            <strong class="tracking-wide text-xl group-hover:underline">
                {{ $authName->first_name ?? "Unknown" }} {{ $authName->last_name ?? "Unknown"}}
            </strong>
        </div>

        <h1 class="m-0 p-0 text-violet-700 font-extrabold text-4xl leading-tight tracking-tight kantumruy-pro animate-fade-in"
            style="text-shadow: 1px 1px 3px rgba(0,0,0,0.1);">
            Welcom To 2A Admin Panel
        </h1>

        <p class="text-lg sm:text-xl text-gray-800 max-w-xl kantumruy-pro leading-relaxed border-l-4 border-violet-700 pl-4">
            សូមស្វាគមន៍មកកាន់គេហទំព័រនៃការអប់រំឌីជីថល និងការអប់រំពីចម្ងាយនៃក្រសួងអប់រំ យុវជន និងកីឡា
        </p>
    </div>

    <div class="flex items-center justify-center relative z-10">
        <img src="{{ asset('images/Operating system-cuate.png') }}" alt="Welcome Illustration"
            class="w-full max-w-md lg:w-[50%] object-contain drop-shadow-xl transform transition-all duration-300 hover:scale-105 hover:rotate-2"
            style="filter: brightness(1.1);" />
    </div>
</div>

@push('style')
<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
