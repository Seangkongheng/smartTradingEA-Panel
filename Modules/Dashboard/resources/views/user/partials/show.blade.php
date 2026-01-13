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
<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
     <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">User</span>
            <span class="text-gray-300 mx-2">/</span>
             <span class="text-gray-600">Detail</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.user.index') }}"
           class="flex items-center gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
            <span class="font-medium">Back</span>
        </a>
    </div>
</div>


{{-- start main --}}
<div class="main-content mt-5 w-full p-8 rounded-[2rem] border-transparent bg-gradient-to-br from-green-50 to-blue-50 relative overflow-hidden"
    style="box-shadow: rgba(50, 50, 93, 0.08) 0px 13px 27px -5px, rgba(0, 0, 0, 0.08) 0px 8px 16px -8px;">

    <div class="absolute -top-20 -right-20 w-48 h-48 bg-green-200/30 rounded-full blur-xl"></div>
    <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-blue-200/30 rounded-full blur-xl"></div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative">
        {{-- Profile Section --}}
        <div class="lg:col-span-4 flex flex-col items-center space-y-6">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-blue-500 rounded-full blur-lg opacity-30 group-hover:opacity-50 transition-all duration-300"></div>
                <img src="{{ $shows->userDetail->profile ? asset('profiles/'.$shows->userDetail->profile) : asset('profiles/default_profile.jpg') }}"
                    alt="Profile Image"
                    class="relative z-10 object-cover rounded-full border-4 border-white shadow-2xl w-48 h-48 bg-gray-200 transition-transform duration-300 hover:scale-105">
            </div>

            <div class="text-center space-y-2">
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $shows->userDetail->first_name ?? "" }} {{ $shows->userDetail->last_name?? "" }}
                </h2>
                <p class="text-gray-600">{{ $shows->email?? "" }}</p>
            </div>

            <div class="flex space-x-4">
                <div class="px-4 py-2 bg-green-100 rounded-full flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">{{ $shows->userDetail->date_of_birth?? "" }}</span>
                </div>
            </div>
        </div>

        {{-- Information  --}}
        <div class="lg:col-span-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold kantumruy-pro text-gray-800">Information</h3>
                    </div>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="font-medium kantumruy-pro">Phone Number:</span> {{ $shows->userDetail->phone_number }}</p>
                        <p><span class="font-medium kantumruy-pro">Date Of Birth:</span> {{ $shows->userDetail->date_of_birth }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold kantumruy-pro text-gray-800">Account Detail</h3>
                    </div>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="font-medium kantumruy-pro">Email:</span> {{ $shows->email }}</p>
                        <p><span class="font-medium kantumruy-pro">Password:</span> ••••••••••</p>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="relative py-6">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300/30"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-4 py-1 bg-white rounded-3xl text-sm text-gray-500">Complete Profile</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 sm:col-span-1">
                            <div class="bg-gradient-to-br from-green-100 to-blue-50 p-4 rounded-xl">
                                <div class="text-sm text-gray-600 mb-1">Account Status</div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $shows->userDetail->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                        <span class="font-medium {{ $shows->userDetail->is_active ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $shows->userDetail->is_active ? 'Active' : 'Blocked' }}
                                        </span>
                                    </div>

                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <div class="bg-gradient-to-br from-blue-100 to-green-50 p-4 rounded-xl">
                                <div class="text-sm text-gray-600 mb-1">Member Since</div>
                                <div class="font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($shows->created_at)->format('M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end main --}}

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
