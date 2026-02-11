@php
$userRole = auth()->user()->roles->pluck('name')->first();
@endphp

<div class="main-content bg-d w-full">

    <form action="{{ isset($categoryEdit->id) ? route('admin.result-categories.update', $categoryEdit->id) : route('admin.result-categories.store') }}" method="POST" class="main-full-content  w-full grid lg:grid-cols-12 gap-10"
        enctype="multipart/form-data">
        @csrf
        @if (isset($categoryEdit->id))
        @method('PUT')
        @endif
        {{-- Start Content create --}}
        <div class="lg:col-start-1 lg:col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content   rounded-3xl bg-[#131d41]  p-5" id="styled-profile" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                class="fill-current text-yellow-500 mr-2">
                                <path
                                    d="m380-340 280-180-280-180v360Zm-60 220v-80H160q-33 0-56.5-23.5T80-280v-480q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v480q0 33-23.5 56.5T800-200H640v80H320ZM160-280h640v-480H160v480Zm0 0v-480 480Z" />
                            </svg> <span class="kantumruy-pro text-lg">Performance</span>
                        </h1>
                    </div>


                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-5 lg:p-8  rounded-2xl">

                        {{-- Title --}}
                        <div class="grid lg:grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="lg:col-start-1 lg:col-end-3 w-full">
                                <label for="">Name</label>
                                <span class="text-sm text-red-500 align-baseline">*</span>
                            </div>
                            <div class="lg:col-start-3 lg:col-end-13 w-full">
                                <input type="text"
                                    value="{{ old('name', isset($categoryEdit->id) ? $categoryEdit->name : '') }}"
                                    name="name"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="Enter your name*" required>
                                @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="grid lg:grid-cols-12 gap-3 kantumruy-pro mt-5">
                            <div class="lg:col-start-1 lg:col-end-13 flex items-center justify-end w-full space-x-3">

                                {{-- Cancel Button --}}
                                <button type="button" onclick="window.history.back()"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-gray-500 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-gray-600 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">Cancel</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" class="fill-current">
                                            <path
                                                d="M480-480 280-280l-56-56 144-144-144-144 56-56 200 200 200-200 56 56-144 144 144 144-56 56-200-200Z" />
                                        </svg>
                                    </span>
                                </button>

                                {{-- Save Button --}}
                                <button type="submit"
                                    class="inter px-5 py-2 backdrop-blur-lg text-white bg-green-600 rounded-lg items-center gap-1 inline-flex border border-white/15 hover:bg-green-700 transition-all duration-300 ease-in-out">
                                    <span class="kantumruy-pro font-[500]">
                                        {{ isset($categoryEdit->id) ? "Update" : "Save" }}
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" class="fill-current">
                                            <path
                                                d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- end Content create --}}
    </form>
</div>







