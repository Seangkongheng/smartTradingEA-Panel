{{-- Subscription Details Page --}}
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 space-y-8">

        {{-- ================= HEADER ================= --}}
        @php
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'confirmed' => 'bg-blue-100 text-blue-800',
                'paid' => 'bg-green-100 text-green-800',
                'canceled' => 'bg-red-100 text-red-800',
            ];
        @endphp

        <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <p class="text-sm text-slate-500">
                    Submitted on:
                    <span class="font-medium text-slate-700">
                        {{ $membership->created_at->format('F d, Y \a\t H:i') }}
                    </span>
                </p>

                <p class="text-sm text-slate-500 mt-1">
                    Member:
                    <span class="font-medium text-slate-800">
                        {{ $membership->user->first_name ?? 'Unknown' }}
                        {{ $membership->user->last_name ?? '' }}
                    </span>
                    <span class="text-slate-400">
                        ({{ $membership->user->email ?? 'No Email' }})
                    </span>
                </p>
            </div>

            <span
                class="px-5 py-2 rounded-full text-sm font-semibold
                {{ $statusColors[$membership->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($membership->status) }}
            </span>
        </div>

        {{-- ================= MAIN GRID ================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ================= PAYMENT & STATUS ================= --}}
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Payment & Verification</h2>

                @php
                    $badge = 'px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-medium';
                @endphp

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Membership Status</span>
                    <span class="{{ $badge }}">{{ ucfirst($membership->status ?? 'Pending') }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Exness Email</span>
                    <span class="{{ $badge }}">{{ $membership->exness_email ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Exness Email Status</span>
                    <span
                        class="{{ $badge }}">{{ ucfirst($membership->exness_email_status ?? 'Pending') }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">TradingView Username</span>
                    <span class="{{ $badge }}">{{ $membership->tradingview_username ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">License Key</span>
                    <div class="flex items-center gap-2">
                        <span class="{{ $badge }}" id="licenseKey">
                            {{ $membership->license_key ?? 'N/A' }}
                        </span>

                        @if ($membership->license_key)
                            <button type="button" onclick="copyLicenseKey()"
                                class="text-slate-500 hover:text-orange-600 transition" title="Copy license key">
                                📋
                            </button>
                        @endif
                    </div>

                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Submitted At</span>
                    <span class="{{ $badge }}">{{ $membership->submitted_at ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Approved By</span>
                    <span class="{{ $badge }}">{{ $membership->approved_by ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Approved At</span>
                    <span class="{{ $badge }}">{{ $membership->approved_at ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Rejected By</span>
                    <span class="{{ $badge }}">{{ $membership->rejected_by ?? 'N/A' }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Rejected At</span>
                    <span class="{{ $badge }}">{{ $membership->rejected_at ?? 'N/A' }}</span>
                </div>
            </div>


            <div class="lg:col-span-2 space-y-6">

                {{-- ===== MEMBERSHIP ACCOUNTS ===== --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Membership Accounts</h2>

                    <div class="space-y-4">

                        @forelse ($membership->accounts as $index => $account)
                            <form action="{{ route('admin.membership.update-account-status', $account->id) }}" method="POST"
                                class="flex items-center justify-between gap-4 p-4 rounded-xl bg-slate-50 border">
                                @csrf
                                @method('PUT')


                                <div>
                                    <p class="text-sm text-gray-500">Account Number</p>
                                    <p class="font-medium text-gray-800">
                                        #{{ $index + 1 }} <span
                                            class="font-bold text-orange-400">{{ $account->account_number ?? 'N/A' }}</span>
                                    </p>
                                </div>

                                <div>
                                    {{-- MIDDLE: STATUS SELECT --}}
                                    <select name="status"
                                        class="px-3 py-2 text-black rounded-lg border border-slate-300 text-sm    focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none">
                                        <option value="pending" {{ $account->status === 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="active" {{ $account->status === 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="suspended"
                                            {{ $account->status === 'suspended' ? 'selected' : '' }}>
                                            Suspended
                                        </option>
                                    </select>

                                    {{-- RIGHT: SUBMIT BUTTON --}}
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-semibold rounded-lg    bg-green-600 text-white   hover:scale-105 transition">
                                        Update
                                    </button>
                                </div>

                            </form>
                        @empty
                            <p class="text-sm text-gray-500">No accounts found.</p>
                        @endforelse

                    </div>
                </div>


                {{-- ===== MEMBER INFORMATION ===== --}}
                <div class="bg-white rounded-2xl shadow">
                    <div class="border-b p-6">
                        <h2 class="text-lg font-semibold text-slate-900">Member Information</h2>
                    </div>

                    <div class="p-6 space-y-3 text-gray-700">
                        <p>
                            <span class="font-semibold">Full Name:</span>
                            {{ $membership->user->first_name ?? 'N/A' }}
                            {{ $membership->user->last_name ?? '' }}
                        </p>

                        <p>
                            <span class="font-semibold">Email:</span>
                            {{ $membership->user->email ?? 'N/A' }}
                        </p>

                        <p>
                            <span class="font-semibold">Exness Email:</span>
                            {{ $membership->exness_email ?? 'N/A' }}
                        </p>

                        <p>
                            <span class="font-semibold">TradingView Username:</span>
                            {{ $membership->tradingview_username ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                {{-- ===== MEMBERSHIP NOTES ===== --}}
                <div class="bg-white rounded-2xl shadow">
                    <div class="border-b p-6">
                        <h2 class="text-lg font-semibold text-slate-900">Membership Notes</h2>
                    </div>

                    <div class="p-6 text-gray-700">
                        {{ $membership->note ?? 'No additional notes provided.' }}
                    </div>
                </div>

                {{-- ===== UPDATE STATUS ===== --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Update Membership</h2>

                    <form action="{{ route('admin.membership.update', $membership->id) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- STATUS --}}
                        <select name="status" id="membershipStatus"
                            class="w-full px-4 py-3 text-black rounded-xl border-2 border-slate-200
            focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none">
                            <option value="pending" {{ $membership->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="confirmed" {{ $membership->status == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                            <option value="canceled" {{ $membership->status == 'canceled' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>

                        {{-- LICENSE KEY (HIDDEN BY DEFAULT) --}}
                        <div id="licenseKeyWrapper" class="hidden text-black">
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                License Key
                            </label>
                            <input type="text" name="license_key"
                                value="{{ old('license_key', $membership->license_key) }}"
                                placeholder="Enter license key"
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200
                focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none">
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600
            text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">
                            Update Membership
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    const statusSelect = document.getElementById('membershipStatus');
    const licenseKeyWrapper = document.getElementById('licenseKeyWrapper');

    function toggleLicenseKey() {
        if (statusSelect.value === 'confirmed') {
            licenseKeyWrapper.classList.remove('hidden');
        } else {
            licenseKeyWrapper.classList.add('hidden');
        }
    }

    // Run on page load
    toggleLicenseKey();

    // Run when status changes
    statusSelect.addEventListener('change', toggleLicenseKey);
</script>

<script>
    function copyLicenseKey() {
        const text = document.getElementById('licenseKey').innerText;

        navigator.clipboard.writeText(text).then(() => {
            alert('License key copied!');
        }).catch(() => {
            alert('Failed to copy license key');
        });
    }
</script>
