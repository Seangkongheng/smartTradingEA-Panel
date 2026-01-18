  <div class="tab-content hidden  rounded-lg bg-[#131d41] " id="styled-profile" role="tabpanel"
      style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
      <div class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
          <h1 class="m-0 p-0 text-lg">  <i class="fas fa-user-circle text-yellow-500 mr-2"></i> <span class="kantumruy-pro text-lg"> Account Detail </span></h1>
      </div>
      <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-10  rounded-2xl">

          <div class="grid grid-cols-12 gap-3  kantumruy-pro ">

              <!-- Username-->
              <div class="col-start-1 col-end-3 w-full">
                  <label for="">Name</label>
              </div>
              <div class="col-start-3 col-end-13 w-full">
                  <input type="text" value="{{ old('username',isset($userEdit->id) ?$userEdit->username : "") }}" name="username" class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "   placeholder="Name*">
                  @error('username')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </div>
          </div>

          <div class="grid grid-cols-12 gap-3  kantumruy-pro ">

              <!-- email-->
              <div class="col-start-1 col-end-3 w-full">
                  <label for="">Email</label>
              </div>
              <div class="col-start-3 col-end-13 w-full">
                  <input type="email" name="email" value="{{ old('email',isset($userEdit->id) ?$userEdit->email : "") }}"
                      class="px-6 py-3.5 text-black bg-gray-100  w-full rounded-xl outline-none "
                      placeholder="Email*">
                  @error('email')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </div>
          </div>

          <!-- password -->
          <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
              <div class="col-start-1 col-end-3 w-full">
                  <label for="">Password</label>
              </div>
              <div class="col-start-3 col-end-13 w-full">
                  <div class="relative w-full">
                      <input type="password" id="txtPassword" name="password" value="{{ old('password',isset($userEdit->id) ? "" : "") }}"
                          class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                          placeholder="Password*" />
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
                  </div>
                  @error('password')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </div>

          </div>
          {{--  Noted : onfirm password  --}}
          <div class="grid grid-cols-12 gap-3 kantumruy-pro ">
              <div class="col-start-1 col-end-3 w-full">
                  <label for="">Confirm Password</label>
              </div>
              <div class="col-start-3 col-end-13 w-full">
                  <div class="relative w-full">
                      <input type="password" id="txtPasswordConfirm" name="password"  value="{{ old('password',isset($userEdit->id) ? "" : "") }}"
                          class="px-6 py-3.5 rounded-xl text-black outline-none bg-gray-100 block w-full "
                          placeholder="Confirm Password*" />
                      <span id="actioveViewoPassword" onclick="showPasswordConfirm()"
                          class="absolute top-0 end-0 p-3.5 h-full  text-white ">
                          <svg id="iconShowPasswordConfirm" xmlns="http://www.w3.org/2000/svg" height="20px"
                              viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 hidden">
                              <path
                                  d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                          </svg>
                          <svg id="iconHiddenPasswordConfirm" xmlns="http://www.w3.org/2000/svg" height="20px"
                              viewBox="0 -960 960 960" width="20px" class="fill-current text-gray-700 ">
                              <path
                                  d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z" />
                          </svg>
                      </span>
                  </div>
                  @error('password')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </div>

          </div>
      </div>
  </div>
