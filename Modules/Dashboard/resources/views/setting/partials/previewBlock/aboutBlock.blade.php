 <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10l9-6 9 6M4 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold kantumruy-pro text-gray-800">អំពីគេហទំព័រ</h3>
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <p><span class="font-medium kantumruy-pro">{{ $aboutUs->description ?? "" }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="7" width="18" height="10" rx="2" stroke-width="2" />
                                    <circle cx="8" cy="12" r="1.5" stroke-width="2" />
                                    <circle cx="12" cy="12" r="1.5" stroke-width="2" />
                                    <circle cx="16" cy="12" r="1.5" stroke-width="2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold kantumruy-pro text-gray-800">រូបភាពស្លាយ</h3>
                        </div>
                        <div class="space-y-2 text-gray-600 ">
                            @if(isset($aboutUs->slider) && !empty(json_decode($aboutUs->slider)))
                                <div class="flex gap-4 overflow-x-auto pb-2">
                                    @foreach (json_decode($aboutUs->slider) as $image)
                                        <div class="min-w-[240px]">
                                            <img src="{{ asset('aboutImages/slider/' . $image) }}" alt="Slider Image"  class="w-full h-40 object-cover rounded-xl border border-gray-200 shadow-sm transition-transform duration-200 group-hover:scale-105" />
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-gray-400 text-center py-8">
                                    <svg class="mx-auto mb-2 w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="7" width="18" height="10" rx="2" stroke-width="2" />
                                        <circle cx="8" cy="12" r="1.5" stroke-width="2" />
                                        <circle cx="12" cy="12" r="1.5" stroke-width="2" />
                                        <circle cx="16" cy="12" r="1.5" stroke-width="2" />
                                    </svg>
                                    <span class="kantumruy-pro">មិនមានរូបភាពស្លាយ</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                    @if(isset($aboutUs->id))
                        {{--  Start button  --}}
                        <div class="button-action justify-end flex  py-4 w-full">
                             <a href="{{ route('admin.about.edit',$aboutUs->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit About us">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6"   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.about.destroy',$aboutUs->id) }}" method="POST" onsubmit="return confirm('Delete this contact?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            </form>
                        </div>
                    @else

                    @endif

            </div>
