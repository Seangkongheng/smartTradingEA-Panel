<form action="{{ route('performLogin') }}" class="inter flex flex-col gap-6 w-[100%] md:w-[70%] lg:w-[45%] xl:w-[35%]  p-10 bg-white rounded-2xl shadow-lg mx-auto">
    {{--  Title  --}}
    <div class="text-center space-y-2">
        <h1 class="text-4xl md:text-5xl font-bold text-[#A8E900] kantumruy-pro">Welcome</h1>
        <h4 class="text-2xl md:text-3xl font-bold text-[#A8E900]">SmartTradingEA Panel</h4>
    </div>

    {{--  Email  --}}
    <div class="flex flex-col gap-2">
        <label class="kantumruy-pro font-medium text-violet-700">Email</label>
        <input type="email" name="email" class="px-5 py-3 bg-gray-100 rounded-xl kantumruy-pro outline-none border border-transparent focus:border-violet-700 focus:ring-2 focus:ring-violet-700 transition" placeholder="Enter Email..." />
        @error('email')
            <span class="text-red-500 kantumruy-pro text-xs">{{ $message }}</span>
        @enderror
    </div>

    {{--  Password  --}}
    <div class="flex flex-col gap-2">
        <label class="kantumruy-pro font-medium text-violet-700">Password</label>
        <div class="relative">
            <input type="password" id="txtPassword" name="password" class="px-5 py-3 w-full bg-gray-100 rounded-xl kantumruy-pro outline-none border border-transparent focus:border-violet-700 focus:ring-2 focus:ring-violet-700 transition" placeholder="Enter Password..." />
            <button type="button" onclick="showPassword()" class="absolute top-1/2 -translate-y-1/2 right-4 text-violet-700">
                <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 5c7.633 0 11 7 11 7s-3.367 7-11 7-11-7-11-7 3.367-7 11-7zM12 15a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
                <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 5c7.633 0 11 7 11 7s-3.367 7-11 7-11-7-11-7 3.367-7 11-7zm0 4a3 3 0 100 6 3 3 0 000-6z"/>
                </svg>
            </button>
        </div>
        @error('password')
            <span class="text-red-500 kantumruy-pro text-xs">{{ $message }}</span>
        @enderror
    </div>

    {{--  Remember Me and Forgot Password  --}}
    <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="accent-violet-700">
            <span class="kantumruy-pro">Remember</span>
        </label>
        <a href="#" onclick="alert('Please Contact to Admin')" class="text-[#A8E900] hover:underline kantumruy-pro">
            Forgot Password?
        </a>
    </div>

    {{--  Login Button  --}}
    <button type="submit" class="px-6 py-3 bg-[#A8E900]  text-white rounded-xl w-full kantumruy-pro font-bold shadow-md transition-all">
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
