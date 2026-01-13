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
<div class="title-table mt-5 flex items-center justify-between">
    <div class="kantumruy-pro w-[60%]">
        <h1 class="m-0 p-0 font-[500] text-green-700 text-2xl"><span>អ្នកប្រើប្រាស់/តារាង</span></h1>
    </div>
    <div class="table-search-with-add w-[40%]  kantumruy-pro flex items-center gap-4 bg-re">
        <div class="w-full">
            <form action="" method="POST">
                <input type="text" name="search" placeholder="ស្វែងរក..." class="px-5 py-3 rounded-xl w-full outline-none border-[1px] ">
            </form>
        </div>
        <div class="relative">
            <select name="status" id="" class="outline-none px-6 py-3.5 rounded-xl pr-8 appearance-none bg-gray-100">
                <option value="1" selected>ស្ថានភាព</option>
                <option value="2">Active</option>
                <option value="3">Block</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="fill-current text-black absolute right-2 translate-y-[50%] top-0"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
        </div>
        <div>
            <a href="" class="bg-green-600 px-4 py-3 rounded-xl items-center gap-0.5  kantumruy-pro font-[500] inline-flex text-white"><span class="m-0 p-0"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" class="fill-current text-white"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg></span><span  class="m-0 p-0">បន្ថែម</span></a>
        </div>
    </div>
</div>
<div class="main-content mt-5 w-full rounded-3xl  border-black "
    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
    <div class="main-full-content w-full">
        <div class="table-content w-full">
            <div class="relative overflow-x-auto sm:rounded-3xl ">
                <table class="w-full text-left bg-white border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="text-sm inter text-gray-700 ">
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">ល.រ</th>
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">ឈ្មោះ</th>
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">អ៊ីមែល</th>
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">តួនាទី</th>
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">ស្ថានភាព</th>
                            <th class="px-6 py-4 border-b border-gray-200 kantumruy-pro">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @for ($i = 0; $i < 10; $i++)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-200 kantumruy-pro">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">John Doe</td>
                                <td class="px-6 py-4 border-b border-gray-200">john@example.com</td>
                                <td class="px-6 py-4 border-b border-gray-200">john@example.com</td>
                                <td class="px-6 py-4 border-b border-gray-200 ">
                                    
                                    <div
                                        class="bg-green-500 text-white  kantumruy-pro text-xs px-2 py-1 rounded-md">Active</div>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <div class="flex space-x-4">
                                        <!-- View -->
                                        <button class="text-gray-400 ">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <!-- Edit -->
                                        <button class="text-gray-400 ">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <!-- Delete -->
                                        <button class="text-gray-400 ">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="table-pagination flex items-center justify-center mt-5">
    <div class="flex space-x-1">
        <button
            class="rounded-full border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
            Prev
        </button>
        <button
            class="min-w-9 rounded-full bg-slate-800 py-2 px-3.5 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
            1
        </button>
        <button
            class="min-w-9 rounded-full border border-slate-300 py-2 px-3.5 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
            2
        </button>
        <button
            class="min-w-9 rounded-full border border-slate-300 py-2 px-3.5 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
            3
        </button>
        <button
            class="min-w-9 rounded-full border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
            Next
        </button>
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
