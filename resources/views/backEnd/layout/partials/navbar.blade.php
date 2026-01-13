<nav class="w-full">
    <div class="dashboard-nav-content">
        <div class="grid grid-cols-12 items-center">
            <div class="col-start-1 col-end-7 lg:col-end-8 xl:col-end-10 2xl:col-end-11 flex items-center w-full">
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
                                class="block w-full px-6 py-3 outline-none rounded-md ps-10 outline-green-600/5 focus:outline-green-600 text-sm text-gray-900 "
                                placeholder="ស្វែងរក..." required />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-start-7 lg:col-start-8 xl:col-start-10 2xl:col-start-11 col-end-13 flex items-center justify-center gap-10">
                <div class="dashboard-account flex items-center justify-center gap-2">
                    <div class="account-image">
                        <img src="{{ asset('images/LogoWebsite.jpg') }}" alt="" class="rounded-full object-cover max-w-[3.5vh]">
                    </div>
                    <div class="account-txt">
                        <span class="text-xs">Welcome Back</span>
                        <h1 class="m-0 p-0 text-sm font-bold ">
                            <span>MengHong</span>
                        </h1>
                    </div>
                </div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#fffff">
                        <path
                            d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z" />
                    </svg>
                </span>
            </div>
        </div>
    </div>
</nav>
