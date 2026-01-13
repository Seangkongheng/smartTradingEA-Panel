<div class="main-content mt-10 w-full ">
    <form action="#" class="main-full-content w-full grid grid-cols-12 gap-10">
        <div class="col-start-1 col-end-4  rounded-2xl relative table-content-tap flex flex-col justify-between h-[20rem] pb-10"
            style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
            <div class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                <h1 class="m-0 p-0 text-lg"><span>
                        Manage Account
                    </span></h1>
            </div>
            <ul class=" flex-wrap flex-col  -mb-px text-sm font-medium text-center items-center justify-center w-full"
                role="tablist">
                <li class="me-2 w-full " role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full rounded-t-2xl" data-tab="styled-profile"
                        type="button" role="tab">Account Detail</button>
                </li>
                <li class="me-2 w-full" role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full " data-tab="styled-dashboard" type="button"
                        role="tab">Profile Detail</button>
                </li>
                <li class="me-2 w-full" role="presentation">
                    <button class="tab-button inline-block p-4 inter w-full " data-tab="styled-settings" type="button"
                        role="tab">Assigaments</button>
                </li>
            </ul>
            <div class="flex items-center justify-center">
                <button type="submit"
                    class="inter px-5 py-2  backdrop-blur-lg text-white bg-green-600  rounded-lg items-center gap-0.5 inline-flex border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out "><span
                        class="kantumruy-pro font-[500]">រក្សាទុក</span><span><svg xmlns="http://www.w3.org/2000/svg"
                            height="20px" viewBox="0 -960 960 960" width="20px" class="fill-current">
                            <path
                                d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" />
                        </svg></span></button>
            </div>
        </div>
        <div class="col-start-4 col-end-13  rounded-2xl table-content w-full flex flex-col p-2 ">

            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content hidden  rounded-lg  bg-white" id="styled-profile" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg"><span>
                                Acount Detail
                            </span></h1>
                    </div>
                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-10  rounded-2xl">
                        <div class="grid grid-cols-12 gap-3  kantumruy-pro ">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">អ៊ីមែល</label>
                            </div>
                            <div class="col-start-3 col-end-13 w-full">
                                <input type="email" name="email"
                                    class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                                    placeholder="អ៊ីមែល">
                            </div>
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">ពាក្យសម្ងាត់</label>
                            </div>
                            <div class="col-start-3 col-end-13 w-full">
                                <div class="relative w-full">
                                    <input type="password" id="txtPassword" name="password"
                                        class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                                        placeholder="ពាក្យសម្ងាត់" />
                                    <span id="actioveViewoPassword" onclick="showPassword()"
                                        class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                                        <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                            viewBox="0 -960 960 960" width="20px"
                                            class="fill-current text-gray-700 hidden">
                                            <path
                                                d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                        </svg>
                                        <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                            viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 ">
                                            <path
                                                d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">បញ្ញាក់ពាក្យសម្ងាត់</label>
                            </div>
                            <div class="col-start-3 col-end-13 w-full">
                                <div class="relative w-full">
                                    <input type="password" id="txtPassword" name="password"
                                        class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                                        placeholder="បញ្ញាក់ពាក្យសម្ងាត់" />
                                    <span id="actioveViewoPassword" onclick="showPassword()"
                                        class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                                        <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                            viewBox="0 -960 960 960" width="20px"
                                            class="fill-current text-gray-700 hidden">
                                            <path
                                                d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                        </svg>
                                        <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg"
                                            height="20px" viewBox="0 -960 960 960" width="20px"
                                            class="fill-current text-gray-700 ">
                                            <path
                                                d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-content hidden  rounded-lg bg-white" id="styled-dashboard" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center  justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg"><span>
                                Profile Account
                            </span></h1>
                    </div>
                    <div class=" inter flex flex-col   justify-center  gap-4 w-[100%] p-10  rounded-2xl">
                        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">ឈ្មោះពេញ</label>
                            </div>
                            <div class="col-start-3 col-end-13 w-full ">
                                <input type="text" name="name"
                                    class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none "
                                    placeholder="ឈ្មោះពេញ">
                            </div>
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">រូបថត</label>

                            </div>
                            <div class="col-start-3 col-end-13 w-full">
                                <label
                                    class="flex flex-col items-center px-6 py-8 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                                    <input type="file" name="image" class="sr-only" accept="image/*" />

                                    <!-- Image preview container -->
                                    <div id="image-preview" class="hidden mb-4 w-full text-center">
                                        <img id="preview" class="max-h-48 mx-auto rounded-lg border border-gray-200"
                                            alt="Image preview" />
                                    </div>

                                    <!-- Upload icon (visible when no image) -->
                                    <div id="upload-icon" class="w-12 h-12 text-gray-400 mb-4">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                    </div>

                                    <!-- Text content (visible when no image) -->
                                    <div id="upload-text" class="text-center">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-semibold text-blue-600">Click to upload</span>
                                            or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            PNG, JPG, JPEG up to 5MB
                                        </p>
                                    </div>

                                    <!-- Selected file name -->
                                    <span id="file-name" class="mt-4 text-sm text-gray-500"></span>
                                </label>
                            </div>
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-content hidden rounded-lg bg-white " id="styled-settings" role="tabpanel"
                    style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div
                        class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg"><span>
                                Assigaments Account
                            </span></h1>
                    </div>
                    <div class=" inter flex flex-col   justify-center  gap-4 w-[100%] p-10  h-fit rounded-2xl">
                        <div class=" border-l-4 border-green-600 kantumruy-pro bg-yellow-50 p-4" role="alert">
                            <p class="font-bold text-gray-600">ចំណំា</p>
                            <p>សូមជ្រើសរេីតួនាទីដើម្បីមានសិទ្ធចូលប្រើប្រាស់ប្រព័ន្ធ៕</p>
                        </div>
                        <div class="grid grid-cols-12 gap-3 kantumruy-pro">
                            <div class="col-start-1 col-end-3 w-full">
                                <label for="">តួរនាទី</label>
                            </div>
                            <div class="col-start-3 col-end-13 w-full">
                                <select name="role"
                                    class="px-6 py-3.5 text-black bg-gray-100  appearance-none w-full rounded-xl outline-none ">
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- <form action="{{ route('admin.index') }}"
                class=" inter flex flex-col   justify-center  gap-4 w-[100%] p-10 h-fit  rounded-2xl">
                <div class="grid grid-cols-12 gap-3 ">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">ឈ្មោះពេញ្</label>
                    </div>
                    <div class="col-start-3 col-end-13 w-full ">
                        <input type="text" name="name"
                            class="px-6 py-3.5 text-black bg-gray-100 rounded-xl w-full outline-none "
                            placeholder="ឈ្មោះពេញ្">
                    </div>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">អ៊ីមែល</label>
                    </div>
                    <div class="col-start-3 col-end-13 w-full">
                        <input type="email" name="email"
                            class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                            placeholder="អ៊ីមែល">
                    </div>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">ពាក្យសម្ងាត់</label>
                    </div>
                    <div class="col-start-3 col-end-13 w-full">
                        <div class="relative w-full">
                            <input type="password" id="txtPassword" name="password"
                                class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                                placeholder="Password" />
                            <span id="actioveViewoPassword" onclick="showPassword()"
                                class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                                <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px"
                                    class="fill-current text-gray-700 hidden">
                                    <path
                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                </svg>
                                <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 ">
                                    <path
                                        d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">បញ្ញាក់ពាក្យសម្ងាត់</label>
                    </div>
                    <div class="col-start-3 col-end-13 w-full">
                        <div class="relative w-full">
                            <input type="password" id="txtPassword" name="password"
                                class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                                placeholder="Password" />
                            <span id="actioveViewoPassword" onclick="showPassword()"
                                class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                                <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px"
                                    class="fill-current text-gray-700 hidden">
                                    <path
                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                </svg>
                                <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 ">
                                    <path
                                        d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">រូបថត់</label>

                    </div>
                    <div class="col-start-3 col-end-13 w-full">
                        <input type="file" name="image"
                            class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none ">
                    </div>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-start-1 col-end-3 w-full">
                        <label for="">តួរនាទី</label>
                    </div>
                    <div class="col-start-3 col-end-13 w-full">
                        <select name="role"
                            class="px-6 py-3.5 text-black bg-gray-100   w-full rounded-xl outline-none ">
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-4 w-full flex items-center justify-end">
                    <button type="submit"
                        class="inter px-6 py-3  backdrop-blur-lg bg-gray-500  text-white rounded-xl inline-flex border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out ">Login</button>
                </div>
            </form> --}}
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-tab');

            // Remove active styles from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('text-green-600', 'bg-green-50');
            });

            // Hide all tab contents
            tabContents.forEach(content => content.classList.add('hidden'));

            // Show selected tab content
            document.getElementById(target).classList.remove('hidden');

            // Add active styles to clicked button
            button.classList.add('text-green-600', 'bg-green-50');
        });
    });

    // Optional: Activate the first tab on load
    tabButtons[0].click();


    const input = document.querySelector('input[type="file"]');
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('image-preview');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadText = document.getElementById('upload-text');

    input.addEventListener('change', function(e) {
        const file = this.files[0];
        const fileName = document.getElementById('file-name');

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                preview.src = reader.result;
                imagePreview.classList.remove('hidden');
                uploadIcon.classList.add('hidden');
                uploadText.classList.add('hidden');
                fileName.textContent = file.name;
            });

            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            imagePreview.classList.add('hidden');
            uploadIcon.classList.remove('hidden');
            uploadText.classList.remove('hidden');
            fileName.textContent = '';
        }
    });
</script>
