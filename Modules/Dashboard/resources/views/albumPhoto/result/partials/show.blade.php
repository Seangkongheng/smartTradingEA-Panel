<style>
    /* Custom animations for tooltip */
    .tooltip {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .group:hover .tooltip {
        opacity: 1;
        transform: translate(-50%, -0.20rem);
    }


</style>


<div class="title-table mt-5 flex flex-col md:flex-row  items-center justify-between gap-4">
    <!-- Title Section -->
    <div class="flex-1 flex justify-between w-full md:min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro m-0 p-0">
            <span class="text-green-600">Results</span></span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">Detail</span>
        </h1>
    </div>
</div>

{{-- start main --}}
<div class="main-content mt-5 w-full   rounded-3xl p-5 bg-[#131d41]">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-lg">
               @include('dashboard::albumPhoto.result.partials.tableInformation.show')
            </div>
        </div>
    </div>
</div>
