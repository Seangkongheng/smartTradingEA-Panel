<div class="main-full-card mt-5">
    <div class="main-card-title kantumruy-pro flex items-center justify-between mb-6 border-b pb-2">
        <h1 class="text-2xl text-green-700 font-bold tracking-wide flex items-center gap-2">
            <i class="fas fa-info-circle text-green-600"></i>
            ព័ត៌មានទូទៅ
        </h1>
    </div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 xl:gap-8 mt-6">
    {{-- Card Component --}}
    @php
    $cards = [
        [
            'title' => 'មេរៀនកំពុងផ្សាយផ្ទាល់',
            'count' => $streammingLessionsCounts,

            'icon' => 'fa-video' // live streaming
        ],
        [
            'title' => 'មេរៀនកំពុងផ្សាយផ្ទាល់ពិសេស',
            'count' => $streamingVideoPartners,

            'icon' => 'fa-video'
        ],
        [
            'title' => 'សាលារៀនសរុប',
            'count' => $schoolCounts,

            'icon' => 'fa-school'
        ],
        [
            'title' => 'សាលារៀនដៃគូ',
            'count' => $schoolPartnerCounts,

            'icon' => 'fa-handshake'
        ],

        [
            'title' => 'គម្រោង',
            'count' => $schoolProjectCounts,

            'icon' => 'fa-briefcase'
        ],
        [
            'title' => 'ព័ត៌មានថ្មីៗ',
            'count' => '',

            'icon' => 'fa-newspaper'
        ],
        [
            'title' => 'ទីន្នន័យ',
            'count' => '',

            'icon' => 'fa-database'
        ],
         [
            'title' => 'គណនីសរុប',
            'count' => $userCounts,
        
            'icon' => 'fa-users'
        ],
    ];
    @endphp

    @foreach ($cards as $card)
    <a href="{{ $card['route'] }}"
       class="block bg-white rounded-xl p-6 text-center shadow-sm border hover:shadow-lg transition-all duration-200">
        <div class="flex flex-col items-center gap-3 text-green-700">

            <div class="relative bg-green-100 text-green-600 p-4 rounded-full">
                <i class="fas {{ $card['icon'] }} fa-2x"></i>

                {{-- Show LIVE badge only for live lessons --}}
                @if(
                    ($card['title'] === 'មេរៀនកំពុងផ្សាយផ្ទាល់' ||
                     $card['title'] === 'មេរៀនកំពុងផ្សាយផ្ទាល់ពិសេស')
                    && $card['count'] > 0
                )
                    <span class="live-badge">LIVE</span>
                @endif
            </div>

            <div class="text-xl font-semibold kantumruy-pro">{{ $card['title'] }}</div>
            <div class="text-2xl font-bold">{{ $card['count'] ?? "_" }}</div>
        </div>
    </a>
    @endforeach

</div>

</div>
<style>
    .live-badge {
        position: absolute;
        top: -6px;
        right: -10px;
        background: red;
        color: white;
        font-size: 10px;
        font-weight: bold;
        padding: 2px 4px;
        border-radius: 4px;
        animation: pulse 1.2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }

        100% {
            opacity: 1;
        }
    }
</style>
