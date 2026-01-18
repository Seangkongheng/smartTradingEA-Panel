<nav class="w-full">
    <div class="dashboard-nav-content">
        <div class="grid grid-cols-12 items-center">
            <div class="col-start-1 col-end-7 lg:col-end-8 xl:col-end-10 2xl:col-end-11 hidden lg:flex items-center w-full">
                <div class="navbar-search w-full">
                   <h1 class="text-2xl font-bold">Dashboard</h1>
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
                        <img src="{{ asset('profiles/' . $userName->profile) }}" alt=""
                            class="w-10 h-10 rounded-full object-cover">
                    </div>
                    <div class="account-txt text-center">
                        <span class="text-xs text-gray-600">Welcome Back</span>
                        <h1 class="m-0 p-0 text-sm kantumruy-pro font-[500] ">
                            <span>{{ $userName->first_name ?? '' }} &nbsp;
                                {{ $userName->last_name ?? '' }}</span>
                        </h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
<script src="{{asset('js/scriptwebsite.js')}}"></script>
