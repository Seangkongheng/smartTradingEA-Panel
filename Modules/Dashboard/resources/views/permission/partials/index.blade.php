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

<div class="title-table mt-5 flex items-center justify-between gap-4">
    <!-- Title Section -->
    <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">សិទ្ធ (permission)</span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">តារាង</span>
        </h1>
    </div>

    <!-- Controls Section -->
    <div class="flex items-center gap-3 flex-1 max-w-[800px]">
        <div class="flex-1 min-w-[160px]">
            <form action="" method="POST">
                <div class="relative">
                    <input type="text" name="search" placeholder="ស្វែងរក..."
                        class="w-full kantumruy-pro pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50  focus:ring-1 focus:ring-green-400 focus:border-green-400 focus:outline-none placeholder-gray-400 text-gray-700 focus:border-none transition-all">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Status Dropdown -->
        <div class="relative w-[160px]">
            <select name="status" class="w-full px-4 kantumruy-pro pr-8 py-2.5 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:ring-1 focus:ring-green-500 focus:outline-none focus:border-green-500 text-gray-700 appearance-none transition-all">
                <option value="1" selected>ស្ថានភាព</option>
                <option value="2">Active</option>
                <option value="3">Block</option>
            </select>
            <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <!-- Add Button -->
        <a href="{{ route('admin.permission.create') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg border border-green-600 bg-white hover:bg-green-50 transition-colors">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="kantumruy-pro font-medium text-green-600">បន្ថែម</span>
        </a>
    </div>
</div>


{{-- start main --}}
    @include('dashboard::permission.partials.tableInformation.permissionTable')
{{-- end main --}}

