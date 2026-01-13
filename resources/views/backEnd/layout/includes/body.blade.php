<main>
    <section>
        <div class="grid grid-cols-12 gap-1 min-h-screen">
            <div class="dashboard-siderbar hidden xl:block xl:col-start-1 xl:col-end-3 bg-gray-50/15  sticky top-0 h-screen" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                @include('backEnd.layout.partials.siderbar')
            </div>
            <div class="dashboard-body col-start-1 col-end-13 xl:col-start-3 xl:col-end-13 p-5" >
                <div class="dashboard-body-content h-full">
                    <div class="dashboard-full-content bg-gray-50/15 h-full  ">
                        <div class="dashboard-navbar min-h-[5rem] px-10 flex w-full items-center rounded-2xl"  style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                            @include('backEnd.layout.partials.navbar')
                        </div>
                        <div class="dashboard-content"  >
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
