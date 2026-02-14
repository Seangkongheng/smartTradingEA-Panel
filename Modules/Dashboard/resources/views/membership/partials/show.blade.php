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
            <span class="text-white font-bold"> Detail Memberships</span></span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">Show </span>
        </h1>
    </div>

</div>

{{-- start main --}}
<div class="main-content mt-5 w-full rounded-3xl p-5  bg-[#131d41]  ">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-lg">
               @include('dashboard::membership.partials.tableInformation.show')
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

