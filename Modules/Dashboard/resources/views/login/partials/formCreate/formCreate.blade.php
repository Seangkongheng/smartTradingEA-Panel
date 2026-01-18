<form action="{{ route('performLogin') }}" class="inter relative flex flex-col gap-6 w-full md:w-[70%] lg:w-[45%] xl:w-[35%]
           p-12 rounded-2xl mx-auto
           bg-white/5 backdrop-blur-xl
           border border-[#BAFD00]/30">

    {{-- Glow --}}
    <div class="absolute inset-0 rounded-2xl pointer-events-none
                bg-gradient-to-br from-[#BAFD00]/10 via-transparent to-transparent"></div>

    {{-- Title --}}
    <div class="relative text-center space-y-2">
        <img src="{{ asset('images/SuperTradingEA_logo.png') }}" class="w-[90px] mx-auto mb-2 animate-float"
            alt="SmartTradingEA">

        <h1 class="text-4xl md:text-5xl font-extrabold
                   bg-gradient-to-r from-[#FFD700] via-[#BAFD00] to-[#9EFF00]
                   bg-clip-text text-transparent kantumruy-pro">
            Welcome Back
        </h1>

    
        <p class="text-[#A8E900] text-lg tracking-wide">
            SmartTradingEA Control Panel
        </p>
    </div>

    {{-- Email --}}
    <div class="relative flex flex-col gap-2">
        <label class="text-sm font-medium text-[#A8E900] kantumruy-pro">
            Email Address
        </label>
        <input type="email" name="email" class="px-5 py-3 rounded-xl bg-black/40 text-white
                   border border-white/10 outline-none
                   focus:border-[#BAFD00] focus:ring-2 focus:ring-[#BAFD00]/40
                   transition kantumruy-pro" placeholder="you@example.com">
        @error('email')
        <span class="text-red-500 text-xs kantumruy-pro">{{ $message }}</span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="relative flex flex-col gap-2">
        <label class="text-sm font-medium text-[#A8E900] kantumruy-pro">
            Password
        </label>

        <div class="relative">
            <input type="password" id="txtPassword" name="password" class="px-5 py-3 w-full rounded-xl bg-black/40 text-white
                       border border-white/10 outline-none
                       focus:border-[#BAFD00] focus:ring-2 focus:ring-[#BAFD00]/40
                       transition kantumruy-pro" placeholder="••••••••">

            <button type="button" onclick="showPassword()" class="absolute top-1/2 -translate-y-1/2 right-4
                       text-[#BAFD00] hover:scale-110 transition">
                <svg id="iconShowPassword" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 5c7.633 0 11 7 11 7s-3.367 7-11 7-11-7-11-7 3.367-7 11-7zM12 15a3 3 0 100-6 3 3 0 000 6z" />
                </svg>
                <svg id="iconHiddenPassword" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 5c7.633 0 11 7 11 7s-3.367 7-11 7-11-7-11-7 3.367-7 11-7zm0 4a3 3 0 100 6 3 3 0 000-6z" />
                </svg>
            </button>
        </div>

        @error('password')
        <span class="text-red-500 text-xs kantumruy-pro">{{ $message }}</span>
        @enderror
    </div>

    {{-- Remember + Forgot --}}
    <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="accent-[#BAFD00]">
            <span class="text-[#A8E900] kantumruy-pro">Remember me</span>
        </label>

        <a href="#" onclick="alert('Please contact Admin')" class="text-[#A8E900] hover:text-[#BAFD00] transition">
            Forgot password?
        </a>
    </div>

    {{-- Button --}}
    <button type="submit" class="relative mt-2 px-6 py-3 rounded-xl font-bold text-black
               bg-gradient-to-r from-[#BAFD00] to-[#9EFF00]
               hover:scale-[1.02] hover:shadow-[0_0_25px_rgba(186,253,0,0.6)]
               transition kantumruy-pro">
        Login
    </button>
</form>
<script>
    function showPassword() {
        const input = document.getElementById("txtPassword");
        const showIcon = document.getElementById("iconShowPassword");
        const hideIcon = document.getElementById("iconHiddenPassword");

        if (input.type === "password") {
            input.type = "text";
            showIcon.classList.remove("hidden");
            hideIcon.classList.add("hidden");
        } else {
            input.type = "password";
            hideIcon.classList.remove("hidden");
            showIcon.classList.add("hidden");
        }
    }
</script>
