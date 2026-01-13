<main >
    <section>
        <div class="container min-h-screen flex mx-auto">
            <div class="form-login w-full flex  items-center justify-center px-2 md:px-0">
                <form action="{{ route('admin.index') }}"
                    class=" inter flex flex-col   justify-center  gap-4 w-[100%] md:w-[75%] lg:w-[50%] xl:w-[35%]  p-10 h-fit  rounded-2xl" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 0px 0px, rgba(17, 17, 26, 0.1) 0px 0px 6px;">
                    <div class="form-title text-center flex flex-col gap-5">
                        <h1 class="m-0 p-0 text-5xl kantumruy-pro font-bold text-green-600"><span>សូមស្វាគម៍កាន់</span></h1>
                        <h4 class="m-0 p-0 font-['Roboto_Slab'] font-bold text-3xl text-green-600"><span> Live Teaching</span></h4>
                    </div>
                    <div class="flex flex-col gap-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="px-6 py-3.5 text-black bg-gray-100 rounded-xl outline-none "
                            placeholder="Email">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-3">
                        <label for="">Password</label>
                        <div class="relative w-full">
                            <input type="password" id="txtPassword" name="password"
                                class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                                placeholder="Password" />
                            <span id="actioveViewoPassword" onclick="showPassword()"
                                class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                                <svg id="iconShowPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 hidden">
                                    <path
                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                </svg>
                                <svg id="iconHiddenPassword" xmlns="http://www.w3.org/2000/svg" height="20px"
                                    viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 ">
                                    <path
                                        d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                                </svg>
                            </span>
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="remember-me mt-3 flex justify-between items-center">
                        <div class="flex items-center gap-1">
                            <input type="checkbox"
                                class="transition-all duration-300 ease-in-out outline-none border-none">
                            <span>Remember me</span>
                        </div>
                        <div>
                            <a href="" class="underline-offset-0"><span>Forgot password ?</span></a>
                        </div>
                    </div>
                    <div class="py-4">
                        <button type="submit"
                            class="inter px-6 py-3  backdrop-blur-lg bg-gray-500  text-white rounded-xl w-full border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out ">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script>
    function showPassword() {
        const textPassword = document.getElementById('txtPassword');
        const iconShowPasswordjs = document.getElementById('iconShowPassword');
        const iconHiddenPasswordjs = document.getElementById('iconHiddenPassword');
        iconHiddenPasswordjs.toggle.classList.remove
        if (textPassword.type === "password") {
            textPassword.type = "text";
        } else {
            textPassword.type = "password";
        }
    }
</script>
