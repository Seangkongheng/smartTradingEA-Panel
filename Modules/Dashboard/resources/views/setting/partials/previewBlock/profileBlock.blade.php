 <div class="lg:col-span-4 flex flex-col items-center space-y-6">
                <div class="relative group">
                    <div  class="absolute inset-0 bg-green-200 rounded-full blur-lg opacity-30 group-hover:opacity-50 transition-all duration-300">
                    </div>
                  <img src="{{ $aboutUs?->logo ? asset('aboutImages/logo/'.$aboutUs->logo) : asset('images/no logo.png') }}" alt="Profile Image"  class="relative z-10 object-cover rounded-full border-4 border-white shadow-sm w-48 h-48 bg-gray-200 transition-transform duration-300 hover:scale-105">
                </div>
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-bold text-gray-800">
                       {{ $aboutUs->name ?? "" }}
                    </h2>
                </div>
            </div>
