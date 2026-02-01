   <div class="tab-content hidden rounded-lg bg-white " id="styled-settings" role="tabpanel"
       style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
       <div class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
           <h1 class="m-0 p-0 text-lg"> <i class="fas fa-user-shield mr-2 text-yellow-500"></i><span
                   class="kantumruy-pro text-lg"> កំណត់តួនាទី </span></h1>
       </div>
       <div class=" inter flex flex-col   justify-center  gap-4 w-[100%] p-10  h-fit rounded-2xl">
           <div class=" border-l-4 border-green-600 kantumruy-pro bg-yellow-50 p-4" role="alert">
               <p class="font-bold text-gray-600">ចំណំា*</p>
               <p>សូមជ្រើសរើសតួនាទីដើម្បីមានសិទ្ធចូលប្រើប្រាស់ប្រព័ន្ធ៕</p>
           </div>
           <!-- Start Roles -->
           <div class="grid grid-cols-12 gap-3 kantumruy-pro">
               <div class="col-start-1 col-end-3 w-full">
                   <label for="">តួរនាទី</label>
               </div>
               <div class="col-start-3 col-end-13 w-full relative group">
                   <select name="roles"
                       class="px-6 py-3.5 text-black bg-gray-100  appearance-none w-full rounded-xl outline-none ">
                       <option selected value="1">ជ្រើសរើសតួនាទី</option>
                       @if (isset($userEdit->id)){
                           @foreach ($roles as $item)
                               <option value="{{ $item }}" {{ in_array($item, $userRoles) ? 'selected' : '' }}>
                                   {{ $item }} </option>
                           @endforeach
                           }
                       @else
                           @foreach ($roles as $item)
                               <option value="{{ $item }}">{{ $item }}</option>
                           @endforeach
                       @endif
                    </select>
                    <div
                        class="select-icon absolute right-[1.4rem] top-1/2 -translate-y-1/2 pointer-events-none  group-focus-within:rotate-180 transition-transform duration-200 ease-in-out">
                        <span><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" class="fill-current  ">
                                <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                            </svg></span>
                    </div>
               </div>

               @error('email')
                   <span class="text-red-500">{{ $message }}</span>
               @enderror
           </div>
       </div>
   </div>
