<aside class="w-full">
    <div class="siderbar-full-content w-full">
        <div class="sidebar-title flex items-center justify-between px-6 py-4 border-b border-red-900">

            {{-- Noted : Logo / Title --}}
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/SuperTradingEA_logo.png') }}" alt="2A Panel Logo"
                    class="w-10 h-10 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105">
                <h1 class="text-lg font-bold text-white tracking-wide group-hover:text-violet-700">
                    Smart TrandingEA
                </h1>
            </a>

            {{-- Noted :Close Button (Mobile) --}}
            <button id="btnCloseNavbar"
                class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-all duration-300"
                aria-label="Close sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="siderbar-componet flex flex-col gap-2 px-5">

            {{-- Noted : home page --}}
            <div
                class="componet-content w-full h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="M200-160v-366L88-440l-48-64 440-336 160 122v-82h120v174l160 122-48 64-112-86v366H520v-240h-80v240H200Zm80-80h80v-240h240v240h80v-347L480-739 280-587v347Zm120-319h160q0-32-24-52.5T480-632q-32 0-56 20.5T400-559Zm-40 319v-240h240v240-240H360v240Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Dashbaord
                        </div>
                    </div>
                </a>
            </div>

            <div class="px-5 mt-4 mb-1 text-gray-500 font-semibold text-sm uppercase">All Pages</div>

            {{-- Noted : Register --}}
            <div
                class="componet-content w-full h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.register.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-42 29-71t71-29v-160q-42 0-71-29t-29-71H360q0 42-29 71t-71 29v160q42 0 71 29t29 71Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Register
                        </div>
                    </div>
                </a>
            </div>

                        {{-- Noted : Membership --}}
            <div
                class="componet-content w-full h-full hover:hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.membership.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Membership
                        </div>
                    </div>
                </a>
            </div>

            {{-- Noted : Reward --}}
            <div
                class="componet-content w-full h-full hover:hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.reward.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="m233-120 65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Zm0 203 157 95-42-178 138-120-182-16-71-168-71 168-182 16 138 120-42 178 157-95Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Reward
                        </div>
                    </div>
                </a>
            </div>

            {{-- Noted : Attachment --}}
            <div class="componet-content w-full h-full hover:bg-green-600
           transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.attachment.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.19 9.19a2 2 0 01-2.83-2.83l8.48-8.48" />
                            </svg>
                        </div>
                        <div class="component-txt">Attachment</div>
                    </div>
                </a>
            </div>


            {{-- Noted : Product --}}
            {{--  <div class="componet-content w-full h-full hover:bg-green-600
           transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.product.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 00 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                <line x1="12" y1="22.08" x2="12" y2="12" />
                            </svg>
                        </div>
                        <div class="component-txt">Product</div>
                    </div>
                </a>
            </div>  --}}


            <div class="px-5 mt-4 mb-1 text-gray-500 font-semibold text-sm uppercase">Marketplace</div>

            {{-- Noted : Marketplace --}}
            <div
                class="componet-content w-full h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.marketplace.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Marketplace
                        </div>
                    </div>
                </a>
            </div>


            {{-- Noted : Product --}}
            <div class="componet-content w-full h-full hover:bg-green-600
     transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.plan.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">

                        <!-- ICON (REPLACED HERE) -->
                        <div class="component-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 1v22" />
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6" />
                            </svg>
                        </div>

                        <div class="component-txt">Marketplace Plan</div>
                    </div>
                </a>
            </div>


            {{-- Noted : Subscription --}}
            <div
                class="componet-content w-full h-full hover:hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.subscribes.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="m438-240 226-226-58-58-169 169-84-84-57 57 142 142ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Subscription
                        </div>
                    </div>
                </a>
            </div>


            {{-- Noted : Setting --}}
            <div class="px-5 mt-4 mb-1 text-gray-500 font-semibold text-sm uppercase">General Setting</div>
            <div
                class="componet-content w-full h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.user.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Users
                        </div>
                    </div>
                </a>
            </div>

            {{-- Noted : Settings --}}
            <div
                class="componet-content w-full h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('admin.setting.index') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current group-hover:text-white">
                                    <path
                                        d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Settings
                        </div>
                    </div>
                </a>
            </div>

            {{-- Noted : Logout --}}
            <div
                class="componet-content w-full text-red-500 h-full hover:bg-green-600 transition-all duration-300 ease-in-out hover:text-white cursor-pointer px-5 rounded-xl">
                <a href="{{ route('logout') }}">
                    <div class="flex items-center w-full min-h-12 gap-2 text-lg kantumruy-pro">
                        <div class="component-icon">
                            <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" class="fill-current rotate-180 group-hover:text-white">
                                    <path
                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                </svg></span>
                        </div>
                        <div class="component-txt">
                            Logout
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const components = document.querySelectorAll(".componet-content");

        // Restore from localStorage
        const selectedIndex = parseInt(localStorage.getItem("selectedMenuIndex"), 10);
        if (!isNaN(selectedIndex) && selectedIndex >= 0 && selectedIndex < components.length) {
            const selectedComponent = components[selectedIndex];
            selectedComponent.classList.add("bg-green-600", "text-white");
            const svg = selectedComponent.querySelector("svg");
            if (svg) svg.setAttribute("fill", "#ffffff");
        }

        // Handle click
        components.forEach((component, index) => {
            component.addEventListener("click", () => {
                // Remove highlight from all
                components.forEach(item => {
                    item.classList.remove("bg-green-600", "text-white");
                    const svg = item.querySelector("svg");
                    if (svg) svg.setAttribute("fill", "#000000");
                });

                // Add highlight to selected
                component.classList.add("bg-green-600", "text-white");
                const svg = component.querySelector("svg");
                if (svg) svg.setAttribute("fill", "#ffffff");

                // Save selection
                localStorage.setItem("selectedMenuIndex", index);
            });
        });
    });
</script>
