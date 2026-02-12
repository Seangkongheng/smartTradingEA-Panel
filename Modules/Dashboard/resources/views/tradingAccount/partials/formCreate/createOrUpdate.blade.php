<div class="main-content w-full">
    <form
        action="{{ isset($tradingAccountEdit) ? route('admin.trading-accounts.update', $tradingAccountEdit->id) : route('admin.trading-accounts.store') }}"
        method="POST" class="w-full grid lg:grid-cols-12 gap-10">

        @csrf
        @if (isset($tradingAccountEdit))
            @method('PUT')
        @endif

        <div class="lg:col-start-1 lg:col-end-13 rounded-2xl bg-[#131d41] p-8">


            {{-- Title --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Title <span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" required placeholder="Enter title.." name="title"
                        value="{{ old('title', $tradingAccountEdit->title ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>
            {{-- Title --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Setting Title <span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" required placeholder="Enter setting title.." name="setting_title"
                        value="{{ old('setting_title', $tradingAccountEdit->setting_title ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>

            {{-- Title --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Server Name <span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" required placeholder="Enter server name.." name="server_name"
                        value="{{ old('server_name', $tradingAccountEdit->server_name ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>

            {{-- Account ID --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Account ID <span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="number" required placeholder="Enter server name.." name="account_id"
                        value="{{ old('account_id', $tradingAccountEdit->account_id ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>

            {{-- Pssword --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Password<span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" required placeholder="Enter password.." name="password"
                        value="{{ old('password', $tradingAccountEdit->password ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>

            {{-- NOTE: Total Profit --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Total Profit<span class="text-red-500">*</span></label>
                </div>
                <div class="md:col-span-9">
                    <input type="text" required placeholder="Enter total profit.." name="total_profit"
                        value="{{ old('total_profit', $tradingAccountEdit->total_profit ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>


            {{-- Status --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Status</label>
                </div>
                <div class="md:col-span-9 flex gap-6">

                    <label class="flex items-center gap-2">
                        <input type="radio" name="is_public" value="1"
                            {{ old('is_public', $tradingAccountEdit->is_public ?? 1) == 1 ? 'checked' : '' }}>
                        <span class="text-white">Public</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="is_public" value="0"
                            {{ old('is_public', $tradingAccountEdit->is_public ?? 1) == 0 ? 'checked' : '' }}>
                        <span class="text-red-400">Private</span>
                    </label>

                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 mt-8">

                <button type="button" onclick="window.history.back()"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg">
                    Cancel
                </button>

                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg">
                    {{ isset($tradingAccountEdit) ? 'Update' : 'Save' }}
                </button>

            </div>

        </div>
    </form>
</div>

<script>
    document.getElementById('check-all-users').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
