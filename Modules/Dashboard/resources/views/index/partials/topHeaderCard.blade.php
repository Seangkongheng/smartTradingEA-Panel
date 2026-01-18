<div class="main-full-content relative w-full min-h-[30vh] lg:min-h-[40vh] px-6 lg:px-16 py-10 lg:py-14 bg-gradient-to-br from-white via-violet-100 to-violet-300 rounded-3xl shadow-xl overflow-hidden grid lg:grid-cols-2 gap-8">

    <!-- Background Decorative Wave -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 Q50,30 100,0 L100,100 L0,100 Z" fill="url(#grad)" />
            <defs>
                <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#b3a0ff;stop-opacity:0.4" />
                </linearGradient>
            </defs>
        </svg>
    </div>

    <!-- Text Content -->
    <div class="flex flex-col justify-center gap-6 z-10">

        <!-- Greeting -->
        <div class="flex items-center gap-3 text-violet-700 text-base sm:text-lg font-semibold animate-fade-slide">
            <span class="text-4xl sm:text-5xl transform transition-transform duration-300 hover:scale-110">🌤️</span>
            <span class="text-xl">Hello,</span>
            <strong class="text-2xl sm:text-3xl tracking-wide group-hover:underline">
                {{ $authName ?? "Unknown" }}
            </strong>
        </div>

        <!-- Welcome Heading -->
        <h1 class="text-4xl sm:text-5xl font-extrabold text-violet-700 leading-tight animate-fade-in-up"
            style="text-shadow: 1px 1px 4px rgba(0,0,0,0.1);">
            Welcome to 2A Admin Panel
        </h1>

        <!-- Description -->
        <p class="text-gray-800 sm:text-lg max-w-xl border-l-4 border-violet-700 pl-4 leading-relaxed kantumruy-pro animate-fade-in">
            SmartTradingEA is a professional Expert Advisor built for Gold (XAUUSD), designed to handle volatility with intelligent risk control, adaptive trade spacing, and real-time execution.
        </p>

        <div class="flex flex-wrap gap-4 mt-4">
            <a href="{{ route('admin.index') }}"
               class="px-6 py-2 bg-violet-700 text-white font-semibold rounded-lg shadow-lg hover:bg-violet-800 transition-all duration-300">
               Dashboard
            </a>
            <a href="{{ route('admin.meeting.index') }}"
               class="px-6 py-2 bg-white border border-violet-700 text-violet-700 font-semibold rounded-lg shadow hover:bg-violet-50 transition-all duration-300">
               EA Meeting
            </a>
        </div>
    </div>

    <div class="flex items-center justify-center relative z-10">
        <img src="{{ asset('images/heng-con.png') }}" alt="Welcome Illustration"
             class="w-full max-w-md lg:w-[50%] object-contain drop-shadow-2xl transform transition-all duration-500 hover:scale-105 hover:rotate-2"
             style="filter: brightness(1.1);" />
    </div>

</div>

@push('style')
<style>
    /* Fade In Animation */
    .animate-fade-in-up {
        animation: fadeInUp 1s ease forwards;
    }

    .animate-fade-slide {
        animation: fadeSlide 1s ease forwards;
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeSlide {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }
</style>
@endpush
