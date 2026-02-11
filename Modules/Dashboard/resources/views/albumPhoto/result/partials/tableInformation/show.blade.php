  <div class="max-w-7xl mx-auto px-6 space-y-6">

      {{-- ================= HEADER SECTION ================= --}}
      <div class="relative overflow-hidden bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
          {{-- Decorative Background Element --}}
          <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>

          <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
              <div class="space-y-2">
                  <div class="flex items-center gap-3">
                      <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                          {{ $result->title ?? 'Untitled Subscription' }}
                      </h1>

                  </div>
                  <p class="text-lg text-slate-600 max-w-2xl leading-relaxed">
                      {{ $result->description ?? 'No detailed description provided for this record.' }}
                  </p>
              </div>
              <span
                  class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium
                {{ $result->is_public ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                  <span
                      class="w-2 h-2 rounded-full
                        {{ $result->is_public ? 'bg-green-400' : 'bg-red-400' }}">
                  </span>

                  {{ $result->is_public ? 'Public' : 'Private' }}
              </span>
          </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

          {{-- ================= MAIN CONTENT: IMAGES ================= --}}
          <div class="lg:col-span-2 space-y-6">
              <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                  <div class="flex items-center justify-between mb-6">
                      <h2 class="text-xl font-bold text-slate-900">Result Gallery</h2>
                      <span class="text-sm text-slate-500 font-medium">Total Files:
                          {{ count(json_decode($result->file ?? '[]', true)) }}</span>
                  </div>

                  @php $files = json_decode($result->file, true); @endphp

                  @if (!empty($files))
                      <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                          @foreach ($files as $file)
                              @if (!empty($file['path']))
                                  <div
                                      class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-100 border border-slate-100 transition-all hover:ring-4 hover:ring-indigo-50">
                                      <img src="{{ asset($file['path']) }}" alt="{{ $file['name'] ?? 'Image' }}"
                                          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                      {{-- Overlay on Hover --}}
                                      <div
                                          class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                          <p class="text-white text-xs font-medium truncate">
                                              {{ $file['name'] ?? 'View Image' }}</p>
                                      </div>
                                  </div>
                              @endif
                          @endforeach
                      </div>
                  @else
                      <div
                          class="flex flex-col items-center justify-center py-12 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50">
                          <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                              </path>
                          </svg>
                          <p class="text-slate-500 font-medium">No images available</p>
                      </div>
                  @endif
              </div>
          </div>

          {{-- ================= SIDEBAR: DETAILS ================= --}}
          <div class="lg:col-span-1">
              <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
                  <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                      <h2 class="text-lg font-bold text-slate-900">Infomation Detail</h2>
                  </div>

                  <div class="p-6 space-y-5">
                      <div class="flex flex-col gap-1">
                          <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Category</span>
                          <div class="flex items-center gap-2">
                              <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                              <span
                                  class="font-semibold text-slate-800">{{ $result->category->name ?? 'General' }}</span>
                          </div>
                      </div>

                      <hr class="border-slate-100">

                      <div class="flex flex-col gap-1">
                          <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Created Date</span>
                          <span class="font-semibold text-slate-800">{{ $result->created_at->format('M d, Y') }}</span>
                          <span class="text-xs text-slate-500">{{ $result->created_at->format('h:i A') }}</span>
                      </div>


                  </div>
              </div>
          </div>
      </div>

  </div>
