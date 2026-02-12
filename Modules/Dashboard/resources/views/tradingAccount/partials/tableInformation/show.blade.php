  <div class="max-w-7xl mx-auto px-4 space-y-8 py-8">

      {{-- Reward Header --}}
      <div
          class="bg-[#1e293b] rounded-2xl shadow p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
          <div>
              <p class="text-sm text-gray-400">
                  Created on:
                  <span class="font-medium text-white">
                      {{ $reward->created_at->format('F d, Y \a\t H:i') }}
                  </span>
              </p>

              <p class="text-sm text-gray-400 mt-1">
                  Title:
                  <span class="font-medium text-white">{{ $reward->title }}</span>
              </p>
          </div>

          <span
              class="px-5 py-2 rounded-full text-sm font-semibold
                {{ $reward->is_public ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
              {{ $reward->is_public ? 'Public' : 'Private' }}
          </span>
      </div>

      {{-- ================= MAIN GRID ================= --}}
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

          {{-- Reward Info --}}
          <div class="bg-[#1e293b] rounded-2xl shadow p-6 space-y-4">
              <h2 class="text-lg font-semibold text-white">Reward Info</h2>

              <div class="flex justify-between text-sm">
                  <span class="text-gray-400">Description</span>
                  <span class="text-white">{{ $reward->description ?? 'N/A' }}</span>
              </div>

              <div class="flex justify-between text-sm">
                  <span class="text-gray-400">Visibility</span>
                  <span class="{{ $reward->is_public ? 'text-green-400' : 'text-yellow-400' }}">
                      {{ $reward->is_public ? 'Public' : 'Private' }}
                  </span>
              </div>

              <div class="flex justify-between text-sm">
                  <span class="text-gray-400">Total Users</span>
                  <span class="text-white">{{ $reward->users->count() }}</span>
              </div>
          </div>

          {{-- Assigned Users --}}
          <div class="lg:col-span-2 bg-[#1e293b] rounded-2xl shadow p-6 space-y-4">
              <h2 class="text-lg font-semibold text-white mb-2">Assigned Users</h2>

              @if ($reward->users->isEmpty())
                  <p class="text-gray-400">No users assigned.</p>
              @else
                  <div class="flex flex-wrap gap-3 max-h-96 overflow-y-auto p-1">
                      @foreach ($reward->users as $user)
                          <div
                              class="flex items-center gap-2 bg-gray-800 px-3 py-2 rounded-xl hover:bg-gray-700 transition cursor-pointer">
                              {{-- Avatar (initials) --}}
                              <div
                                  class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-sm font-semibold text-white">
                                  {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                              </div>

                              <div class="flex flex-col">
                                  <span class="text-white font-medium truncate max-w-[120px]"
                                      title="{{ $user->first_name }} {{ $user->last_name }}">
                                      {{ $user->first_name }} {{ $user->last_name }}
                                  </span>
                                  <span class="text-gray-400 text-xs truncate max-w-[120px]"
                                      title="{{ $user->email }}">
                                      {{ $user->email }}
                                  </span>
                              </div>
                          </div>
                      @endforeach
                  </div>
              @endif
          </div>

      </div>
  </div>
