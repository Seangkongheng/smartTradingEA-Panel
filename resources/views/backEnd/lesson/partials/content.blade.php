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
<div class="main-content mt-10 w-full rounded-3xl  border-black "
    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-3xl ">
                <table class="w-full text-left bg-white border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="text-sm inter text-gray-700">
                            <th class="px-6 py-4 border-b border-gray-200">No</th>
                            <th class="px-6 py-4 border-b border-gray-200">Name</th>
                            <th class="px-6 py-4 border-b border-gray-200">Email</th>
                            <th class="px-6 py-4 border-b border-gray-200">Password</th>
                            <th class="px-6 py-4 border-b border-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b border-gray-200">1</td>
                            <td class="px-6 py-4 border-b border-gray-200">John Doe</td>
                            <td class="px-6 py-4 border-b border-gray-200">john@example.com</td>
                            <td class="px-6 py-4 border-b border-gray-200">••••••••</td>
                            <td class="px-6 py-4 border-b border-gray-200">
                                <div class="flex space-x-4">
                                    <!-- View -->
                                    <button class="text-gray-400 ">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <!-- Edit -->
                                    <button class="text-gray-400 ">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    <!-- Delete -->
                                    <button class="text-gray-400 ">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
</script>
