<div class="min-h-screen bg-gradient-to-br from-[#0f172a] via-[#111827] to-[#0b1120] p-6">

    {{-- ===================== TOP KPI SECTION ===================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        {{-- Total Revenue --}}
        <div class="bg-gradient-to-r from-emerald-500 to-green-600 p-8 rounded-2xl shadow-2xl text-white">
            <h3 class="text-sm uppercase opacity-80 tracking-wide">Total Revenue</h3>
            <p class="text-4xl font-extrabold mt-2">
                ${{ number_format($totalRevenue ?? 0) }}
            </p>
            <p class="text-sm mt-2 opacity-80">Overall system revenue</p>
        </div>

        {{-- Total Sales --}}
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-8 rounded-2xl shadow-2xl text-white">
            <h3 class="text-sm uppercase opacity-80 tracking-wide">Total Sales</h3>
            <p class="text-4xl font-extrabold mt-2">
                {{ $totalSaless ?? 0 }}
            </p>
            <p class="text-sm mt-2 opacity-80">Completed transactions</p>
        </div>

        {{-- Active Users --}}
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-8 rounded-2xl shadow-2xl text-white">
            <h3 class="text-sm uppercase opacity-80 tracking-wide">Active Users</h3>
            <p class="text-4xl font-extrabold mt-2">
                {{ $totalRegisters ?? 0 }}
            </p>
            <p class="text-sm mt-2 opacity-80">Currently active accounts</p>
        </div>

    </div>


    @php
        $cards = [
            [
                'title' => 'Membership Pending',
                'count' => $totalMembershipPendings ?? 0,
                'icon' => 'fa-hourglass-half',
                'color' => 'red',
                'route'=> route('admin.membership.index')
            ],
            [
                'title' => 'Membership Confirmed',
                'count' => $totalMembershipConfirms ?? 0,
                'icon' => 'fa-check-circle',
                'color' => 'green',
                'route'=> route('admin.membership.index')
            ],
            [
                'title' => 'Register Account',
                'count' => $totalRegisters ?? 0,
                'icon' => 'fa-user-plus',
                'color' => 'blue',
                'route'=> route('admin.register.index')
            ],
            [
                'title' => 'Subscription Pending',
                'count' => $totalSubscriptionPendings ?? 0,
                'icon' => 'fa-clock',
                'color' => 'yellow',
                'route'=> route('admin.subscribes.index')
            ],
            [
                'title' => 'Subscription Confirmed',
                'count' => $totalSubscriptionConfirmeds ?? 0,
                'icon' => 'fa-list-check',
               'color' => 'green',
                'route'=> route('admin.subscribes.index')
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

        @foreach ($cards as $card)
        <a href="{{ $card['route'] }}"
           class="group relative backdrop-blur-lg bg-white/5 border border-white/10 rounded-2xl p-6
                  hover:-translate-y-1 hover:shadow-xl hover:ring-1 hover:ring-{{$card['color']}}-500/50
                  transition-all duration-300">

            {{-- Icon --}}
            <div class="flex items-center justify-between">
                <div class="bg-{{$card['color']}}-500/20 text-{{$card['color']}}-400
                            p-4 rounded-xl group-hover:scale-110 transition-all duration-300">
                    <i class="fas {{ $card['icon'] }} text-2xl"></i>
                </div>

                <span class="text-xs text-white/40 group-hover:text-white">
                    View →
                </span>
            </div>

            {{-- Content --}}
            <div class="mt-6">
                <h3 class="text-white/60 text-sm uppercase tracking-wide">
                    {{ $card['title'] }}
                </h3>

                <p class="text-3xl font-bold text-white mt-2">
                    {{ $card['count'] }}
                </p>
            </div>

            {{-- Progress Line --}}
            <div class="mt-4 h-1 bg-white/10 rounded-full overflow-hidden">
                <div class="h-full bg-{{$card['color']}}-500 w-3/4 group-hover:w-full transition-all duration-500"></div>
            </div>

        </a>
        @endforeach

    </div>
</div>
