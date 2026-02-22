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
            <span class="text-white font-bold">Memberships</span></span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">List</span>
        </h1>
        <a href="{{ route('admin.membership.create') }}"
            class="flex md:hidden items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-green-600 hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="kantumruy-pro font-medium text-white">Add New</span>
        </a>
    </div>

    {{--  Noted : Controls Section  --}}
    <div class="flex items-center justify-start  gap-3 flex-1 w-full md:max-w-[800px]">
        <div class="flex-1 md:min-w-[160px]">
            <form action="" method="POST">
                <div class="relative">
                    <input type="text" id="search" name="search" placeholder="Search here..."
                        class="w-full kantumruy-pro pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50  focus:ring-1 focus:ring-green-400 focus:border-green-400 focus:outline-none placeholder-gray-400 text-gray-700 focus:border-none transition-all">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>

        {{--  Noted : Status Dropdown   --}}
        <div class="relative sm:w-[160px]">
            <select name="status" id="status"
                class="w-full px-2 md:px-4 kantumruy-pro  pr-8 py-2.5 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:ring-1 focus:ring-green-500 focus:outline-none focus:border-green-500 text-gray-700 appearance-none transition-all">
                <option value="" selected>Status</option>
                <option value="1">Pending</option>
                <option value="2">Confirmed</option>
                <option value="3">Rejected</option>
            </select>
            <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        {{--  Noted : Add Button   --}}
        <a href="{{ route('admin.membership.create') }}"
            class="hidden md:flex items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-green-600 hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="kantumruy-pro font-medium text-white">Add New</span>
        </a>
    </div>

</div>




{{-- start main --}}
{{-- <div class="main-content mt-5 w-full rounded-3xl p-5  bg-[#131d41]  ">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-lg">
                <div id="all" class="tab-content mt-6">
                    @include('dashboard::membership.partials.tableInformation.productTable')
                </div>

                <div id="pending" class="tab-content hidden mt-6">
                    @include('dashboard::membership.partials.tableInformation.pending')
                </div>
                 <div id="confirm" class="tab-content hidden mt-6">
                    @include('dashboard::membership.partials.tableInformation.confirmed')
                </div>
                 <div id="rejected" class="tab-content hidden mt-6">
                    @include('dashboard::membership.partials.tableInformation.rejected')
                </div>
            </div>
        </div>
    </div>
</div> --}}

@php
    $status = $status ?? 'all';
@endphp

<!-- Tabs -->
<div class="mt-6 w-full flex gap-3 bg-[#1c275c] p-1.5 rounded-xl">

    <a href="{{ route('admin.membership.index', ['status' => 'all']) }}"
        class="px-5 w-full py-2 text-sm font-semibold rounded-lg {{ $status == 'all' ? 'bg-green-500 text-black shadow-md' : 'text-gray-300 hover:bg-green-400 hover:text-black transition' }}">
        All
    </a>

    <a href="{{ route('admin.membership.index', ['status' => 'pending']) }}"
        class="px-5  w-full py-2 text-sm text-center font-semibold rounded-lg {{ $status == 'pending' ? 'bg-yellow-400 text-black shadow-md' : 'text-gray-300 hover:bg-yellow-400 hover:text-black transition' }}">
        Pending
    </a>

    <a href="{{ route('admin.membership.index', ['status' => 'confirmed']) }}"
        class="px-5  w-full py-2 text-center text-sm font-semibold rounded-lg {{ $status == 'confirmed' ? 'bg-green-400 text-black shadow-md' : 'text-gray-300 hover:bg-green-400 hover:text-black transition' }}">
        Confirmed
    </a>

    <a href="{{ route('admin.membership.index', ['status' => 'rejected']) }}"
        class="px-5  w-full  text-center py-2 text-sm font-semibold rounded-lg {{ $status == 'rejected' ? 'bg-red-400 text-white shadow-md' : 'text-gray-300 hover:bg-red-400 hover:text-white transition' }}">
        Rejected
    </a>

</div>

<!-- Table -->
<div class="main-content mt-5 w-full rounded-3xl p-5 bg-[#131d41]">
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table id="table-data" class="w-full text-left text-sm text-gray-300">
            <thead class="bg-gray-800/60 text-gray-200 uppercase">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Exness Email</th>
                    <th class="px-6 py-4">Submit Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($memberships as $index => $membership)
                    <tr class="hover:bg-gray-700/40 transition-colors duration-200">
                        <td class="px-6 py-4">{{ $index + $memberships->firstItem() }}</td>
                        <td class="px-6 py-4 font-medium">{{ $membership->user->email ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $membership->exness_email ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $membership->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full font-bold {{ $membership->status == 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : ($membership->status == 'confirmed'
                                        ? 'bg-blue-100 text-blue-800'
                                        : 'bg-red-400 text-red-800') }}">
                                {{ ucfirst($membership->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                {{-- View --}}
                                <a href="{{ route('admin.membership.show', $membership->id) }}"
                                    class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                {{-- Noted : Delete Button --}}
                                <form action="{{ route('admin.membership.destroy', $membership->id) }}"
                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-10">
                            <div class="flex flex-col items-center justify-center">
                                <img src="{{ asset('images/empty-data.png') }}" class="mb-3 max-w-[120px]"
                                    alt="No data">
                                <p class="text-gray-400 text-center">No memberships available yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $memberships->links() }}
        </div>
    </div>
</div>



{{ $memberships->onEachSide(5)->links() }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    $(document).ready(function() {
        $(document).on('keyup', '#search', function(e) {
            e.preventDefault();
            let search_string = $(this).val();
            let status = $('#status').val();
            $.ajax({
                url: "{{ route('admin.membership.search') }}",
                method: 'GET',
                data: {
                    search_string: search_string
                },
                success: function(res) {
                    $('#table-data').html(res);
                }
            });
        });

        // Status filter only
        $(document).on('change', '#status', function() {
            let status = $(this).val();

            $.ajax({
                url: "{{ route('admin.membership.search') }}",
                method: 'GET',
                data: {
                    status: status
                },
                success: function(res) {
                    $('#table-data').html(res);
                }
            });
        });
    });
</script>
<script>
    function showTab(event, id) {

        // Hide all content
        document.querySelectorAll('.tab-content')
            .forEach(el => el.classList.add('hidden'));

        // Remove active style from all buttons
        document.querySelectorAll('.tab-btn')
            .forEach(btn => {
                btn.classList.remove('bg-green-500', 'text-black', 'shadow-md');
                btn.classList.add('text-gray-300');
            });

        // Show selected content
        document.getElementById(id).classList.remove('hidden');

        // Add active style to clicked button
        event.currentTarget.classList.add('bg-green-500', 'text-black', 'shadow-md');
        event.currentTarget.classList.remove('text-gray-300');
    }
</script>
