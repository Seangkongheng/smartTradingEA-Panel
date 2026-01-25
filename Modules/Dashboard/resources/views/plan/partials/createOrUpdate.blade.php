

<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class=" text-balance lg:text-lg xl:text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-white font-bold">Plan</span>
            <span class="text-gray-300 mx-1 lg:mx-2">/</span>
            <span class="text-gray-600">{{ isset($planEdit->id) ? 'Update Plan' : 'Create Plan ' }}</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.plan.index') }}"
            class="flex items-center gap-1 lg:gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span class="font-medium text-nowrap">Back</span>
        </a>
    </div>
</div>
    @include('dashboard::plan.partials.formCreate.createOrUpdate')
</div>

