<nav class="w-full">
    <div class="dashboard-nav-content">
        <div class="grid grid-cols-12 items-center">
            <div class="col-start-1 col-end-7 lg:col-end-8 xl:col-end-10 2xl:col-end-11 hidden lg:flex items-center w-full">
                <div class="navbar-search w-full">
                    <form action="" method="POST" class="w-full lg:w-[40%] kantumruy-pro">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search"
                                class="block w-full px-6 py-2 outline-none rounded-md ps-10 outline-green-600/5 focus:outline-green-600 text-sm text-gray-900 "
                                placeholder="ស្វែងរក..." required />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-start-1 col-end-3 lg:col-end-8 xl:col-end-10 2xl:col-end-11 flex lg:hidden items-center w-full">
                <div class="navbar-search w-full">
                    <button id="btnActiveNavbar">
                        <span><svg xmlns="http://www.w3.org/2000/svg" height="25px" viewBox="0 -960 960 960" width="25px"  class="fill-current text-black"><path d="M120-240v-80h240v80H120Zm0-200v-80h480v80H120Zm0-200v-80h720v80H120Z"/></svg></span>
                    </button>
                </div>
            </div>
            @php
                $userName = Auth()->user();
            @endphp
            <div   class="col-start-3 lg:col-start-8 xl:col-start-10 2xl:col-start-11 col-end-13 flex items-center justify-end lg:justify-center gap-5">

                <div class="dashboard-account flex items-center justify-center gap-2">
                    <div class="account-image bg-gray-200 rounded-full">
                        <img src="{{ asset('profiles/' . $userName->userDetail->profile) }}" alt=""
                            class="w-10 h-10 rounded-full object-cover">
                    </div>
                    <div class="account-txt text-center">
                        <span class="text-xs text-gray-600">Welcome Back</span>
                        <h1 class="m-0 p-0 text-sm kantumruy-pro font-[500] ">
                            <span>{{ $userName->userDetail->first_name ?? '' }} &nbsp;
                                {{ $userName->userDetail->last_name ?? '' }}</span>
                        </h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
<script src="{{asset('js/scriptwebsite.js')}}"></script>
