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
            <span class="text-white font-bold">Reward</span></span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">List</span>
        </h1>
         <button disabled  class="flex md:hidden items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-green-600  hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="kantumruy-pro font-medium text-white">Add New</span>
        </button>
    </div>

    {{--  Noted : Controls Section  --}}
    <div class="flex items-center justify-start  gap-3 flex-1 w-full md:max-w-[800px]">
        <div class="flex-1 md:min-w-[160px]">
            <form action="" method="POST">
                <div class="relative">
                    <input type="text" id="search" name="search" placeholder="Search here..." class="w-full kantumruy-pro pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50  focus:ring-1 focus:ring-green-400 focus:border-green-400 focus:outline-none placeholder-gray-400 text-gray-700 focus:border-none transition-all">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>

        {{--  Noted : Status Dropdown   --}}
        <div class="relative sm:w-[160px]">
            <select name="status" id="status" class="w-full px-2 md:px-4 kantumruy-pro  pr-8 py-2.5 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:ring-1 focus:ring-green-500 focus:outline-none focus:border-green-500 text-gray-700 appearance-none transition-all">
                <option value="1" selected>Status</option>
                <option value="2">Active</option>
                <option value="3">Block</option>
            </select>
            <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        {{--  Noted : Add Button   --}}
        <button disabled href=""  class="hidden md:flex items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-green-600 hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="kantumruy-pro font-medium text-white">Add New</span>
        </button>
    </div>
</div>

{{-- start main --}}
<div class="main-content mt-5 w-full rounded-3xl p-5 bg-[#131d41]">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-lg">
               @include('dashboard::reward.partials.tableInformation.productTable')
            </div>
        </div>
    </div>
</div>
{{--  {{ $users->onEachSide(5)->links() }}  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Add keyboard support for accessibility
    document.querySelectorAll('[role="button"]').forEach(wrapper => {
        wrapper.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                wrapper.click();
            }
        });
    });

   $(document).ready(function () {
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search_string = $(this).val();
        let status = $('#status').val();
        $.ajax({
            url: "{{ route('admin.user.search') }}",
            method: 'GET',
            data: { search_string: search_string },
            success: function (res) {
                $('#table-data').html(res);
            }
        });
    });

    // Status filter only
    $(document).on('change', '#status', function () {
        let status = $(this).val();

        $.ajax({
            url: "{{ route('admin.user.search') }}",
            method: 'GET',
            data: { status: status },
            success: function (res) {
                $('#table-data').html(res);
            }
        });
    });
});


</script>

