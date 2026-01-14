<main>
    <section>
        <div class="grid grid-cols-12 text-white gap-1 min-h-screen">
            <div id="dashboard-siderbar"
                class="dashboard-siderbar bg-[#080F25] xl:col-start-1 xl:col-end-3 fixed xl:sticky xl:block  overflow-auto top-0 left-0 z-50 h-screen transform -translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out"
                style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                @include('dashboard::layout.partials.siderbar')
            </div>


            <div class="dashboard-body col-start-1 col-end-13 bg-[#080F25] xl:col-start-3 xl:col-end-13 p-5">
                <div class="dashboard-body-content h-full">
                    <div class="dashboard-full-content text-white h-full  ">
                        <div class="dashboard-navbar bg-[#131d41]  min-h-[5rem] px-5 lg:px-10 flex w-full items-center rounded-2xl"
                            style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                            @include('dashboard::layout.partials.navbar')
                        </div>

                        <div class="dashboard-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
