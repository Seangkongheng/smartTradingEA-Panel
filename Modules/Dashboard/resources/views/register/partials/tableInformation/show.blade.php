{{-- User Show Page --}}
<div class="lg:col-start-1 lg:col-end-13 rounded-2xl table-content w-full flex flex-col">
    <div id="user-show" class="w-full">
        <div class="tab-content rounded-3xl bg-[#131d41] p-5"
             style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">

            {{-- Header --}}
            <div class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center">
                <h1 class="m-0 p-0 text-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                         class="fill-current text-yellow-500 mr-2">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                    {{--  <span class="kantumruy-pro text-lg">{{ $userRegister->first_name }} {{ $userRegister->last_name }}</span>  --}}
                </h1>
            </div>

            {{-- User Info --}}
            <div class="inter flex flex-col gap-6 p-5 lg:p-8">

                {{-- Basic Info --}}
                <div class="bg-gray-800 text-gray-100 p-5 rounded-xl shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Basic Information</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">First Name</p>
                            <p class="text-white font-medium">{{ $userRegister->first_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Last Name</p>
                            <p class="text-white font-medium">{{ $userRegister->last_name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Email</p>
                            <p class="text-white font-medium">{{ $userRegister->email ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Registered At</p>
                            <p class="text-white font-medium">{{ $userRegister->created_at?->format('d M Y') ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Optional Details --}}
                @if($userRegister->phone || $userRegister->address || $userRegister->note)
                    <div class="bg-gray-800 text-gray-100 p-5 rounded-xl shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Additional Details</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            @if($userRegister->phone)
                                <div>
                                    <p class="text-gray-400 text-sm">Phone</p>
                                    <p class="text-white font-medium">{{ $userRegister->phone }}</p>
                                </div>
                            @endif
                            @if($userRegister->address)
                                <div>
                                    <p class="text-gray-400 text-sm">Address</p>
                                    <p class="text-white font-medium">{{ $userRegister->address }}</p>
                                </div>
                            @endif
                            @if($userRegister->note)
                                <div class="md:col-span-2">
                                    <p class="text-gray-400 text-sm">Note</p>
                                    <p class="text-white font-medium">{{ $userRegister->note }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
