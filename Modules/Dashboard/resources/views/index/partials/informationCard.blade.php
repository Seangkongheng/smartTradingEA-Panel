<div class="main-full-card mt-5">

    <!-- Title -->
    <div class="main-card-title kantumruy-pro flex items-center justify-between mb-6 border-b pb-2">
        <h1 class="text-2xl text-white font-bold tracking-wide flex items-center gap-2">
            <i class="fas fa-info-circle"></i>
            General Information
        </h1>
    </div>

    @php
    $cards = [
    [
    'title' => 'Membership Account',
    'count' => 0,
    'icon' => 'fa-id-card',
    'bg' => 'bg-blue-100',
    'text' => 'text-blue-600',
    'route'=> route('admin.membership.index')
    ],
    [
    'title' => 'Register Account',
    'count' => 0,
    'icon' => 'fa-user-plus',
    'bg' => 'bg-green-100',
    'text' => 'text-green-600',
    'route'=> route('admin.register.index')
    ],
    [
    'title' => 'All Subscription',
    'count' => 0,
    'icon' => 'fa-list-alt',
    'bg' => 'bg-purple-100',
    'text' => 'text-purple-600',
    'route'=> route('admin.subscribes.index')
    ],
    [
    'title' => 'Total Sale',
    'count' => 0,
    'icon' => 'fa-coins',
    'bg' => 'bg-yellow-100',
    'text' => 'text-yellow-600',
    'route'=> route('admin.index')
    ],

    ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($cards as $card)
        <a href="{{ $card['route'] }}" class="group bg-[#131d41] rounded-2xl p-6
          border border-white/10
          shadow-lg hover:shadow-2xl
          hover:-translate-y-1 transition-all duration-300">

            <!-- Icon -->
            <div class="flex items-center justify-between">
                <div class="{{ $card['bg'] }} {{ $card['text'] }} p-4 rounded-xl shadow">
                    <i class="fas {{ $card['icon'] }} text-2xl"></i>
                </div>

                <span class="text-sm text-white/50 group-hover:text-violet-400 transition">
                    View →
                </span>
            </div>

            <!-- Content -->
            <div class="mt-6 text-left">
                <h3 class="text-white/70 text-sm font-semibold uppercase tracking-wide">
                    {{ $card['title'] }}
                </h3>

                <p class="text-3xl font-extrabold text-white mt-2">
                    {{ $card['count'] }}
                </p>
            </div>
        </a>
        @endforeach
    </div>


</div>
