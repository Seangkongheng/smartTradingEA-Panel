<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<div class="title-table mt-5 flex items-center justify-between  border-gray-200 pb-4">
    <div class="flex-1 min-w-[160px]">
        <h1 class="text-xl font-semibold text-gray-800 kantumruy-pro">
            <span class="text-green-600">កំណត់</span>
            <span class="text-gray-300 mx-2">/</span>
            <span class="text-gray-600">Footer</span>
        </h1>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.setting.index') }}"
            class="flex items-center gap-2 kantumruy-pro text-gray-600 hover:text-green-600 transition-colors group">
            <span class="p-2 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span class="font-medium">ត្រឡបក្រោយ</span>
        </a>
    </div>
</div>
<div class="main-content w-full ">

        {{-- Start Content create --}}
        <div class="col-start-1 col-end-13  rounded-2xl table-content w-full flex flex-col ">
            <div id="default-styled-tab-content" class=" w-full">
                <div class="tab-content   rounded-lg  bg-white" id="styled-profile" role="tabpanel"   style="box-shadow: rgba(17, 17, 26, 0.05) 0px 2px 8px, rgba(17, 17, 26, 0.05) 0px 0px 32px;">
                    <div  class="card-title inter font-[500] py-3 border-b flex items-center justify-center w-full text-center ">
                        <h1 class="m-0 p-0 text-lg"> <i class="fas fa-user-circle text-yellow-500 mr-2"></i>
                            <span class="kantumruy-pro text-lg"> កែប្រែ Footer </span>
                        </h1>
                    </div>
                    <div class=" inter flex flex-col justify-center gap-4 w-[100%] p-10  rounded-2xl">
                        <form   action="{{ route("admin.footer.update",$footerEdit->id) }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 kantumruy-pro">រក្សាសិទ្ធិ</label>
                                    <input type="text" value="{{ old('copyright',$footerEdit->copyright ?? "") }}" name="copyright" class="w-full px-4 py-3 outline-none rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500" required  placeholder="អត្ថបទរក្សាសិទ្ធិ">
                                </div>
                            </div>

                            <div class="space-y-4">
                            <div class="space-y-2">
                                
                            <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ការពិពណ៌នា</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-200 outline-none focus:ring-2 focus:ring-green-500" required placeholder="សូមបញ្ចូលការពិពណ៌នា...">{{ old('copyright',$footerEdit->description ?? "") }}</textarea>
                            </div>
                           {{-- Start Button --}}
                                <div class="grid grid-cols-12 gap-3 kantumruy-pro mt-5">
                                    <div class="col-start-1 col-end-13 flex items-center justify-end  w-full">
                                        <button type="submit" class="inter px-5 py-2 p-8  backdrop-blur-lg text-white bg-green-600  rounded-lg items-center gap-0.5 inline-flex border border-white/15 hover:bg-green-600 transition-all duration-300 ease-in-out ">
                                            <span class="kantumruy-pro font-[500]">កែប្រែ</span><span><svg  xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                                    width="20px" class="fill-current"> <path  d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z" /> </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Content create --}}

</div>




