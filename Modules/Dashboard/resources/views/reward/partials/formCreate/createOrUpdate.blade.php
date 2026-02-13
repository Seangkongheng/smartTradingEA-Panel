<div class="main-content w-full">
    <form
        action="{{ isset($rewardEdit) ? route('admin.rewards.update', $rewardEdit->id) : route('admin.rewards.store') }}"
        method="POST" class="w-full grid lg:grid-cols-12 gap-10">

        @csrf
        @if (isset($rewardEdit))
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
                        value="{{ old('title', $rewardEdit->title ?? '') }}"
                        class="w-full px-4 py-3 rounded-lg text-black" required>
                </div>
            </div>

            {{-- Description --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Description</label>
                </div>
                <div class="md:col-span-9">
                    <textarea name="description" placeholder="Enter description.."
                        class="w-full px-4 py-3 rounded-lg text-black"
                        rows="4">{{ old('description', $rewardEdit->description ?? '') }}</textarea>
                </div>
            </div>




            {{-- Select Users (Private only) --}}
            <div id="user-select-section" class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Select Users</label>
                </div>

                <div class="md:col-span-9 bg-gray-800 p-4 rounded-lg max-h-96 overflow-y-auto">

                    {{-- 🔍 Search Input --}}
                    <div class="mb-4">
                        <input type="text" id="user-search" placeholder="Search user by name..."
                            class="w-full px-3 py-2 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    {{-- Check All --}}
                    <div class="mb-3 border-b border-gray-600 pb-2">
                        <label class="flex items-center space-x-2 text-white cursor-pointer">
                            <input type="checkbox" id="check-all-users" class="w-4 h-4">
                            <span>Select All Users</span>
                        </label>
                    </div>

                    @php
                    $chunks = $users->chunk(10);
                    @endphp

                    <div id="user-list">
                        @foreach ($chunks->chunk(3) as $rowChunks)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4 user-row">
                            @foreach ($rowChunks as $chunk)
                            <div>
                                @foreach ($chunk as $user)
                                <label class="flex items-center space-x-2 text-white mb-2 cursor-pointer user-item"
                                    data-name="{{ strtolower($user->first_name . ' ' . $user->last_name) }}">
                                    <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                        class="user-checkbox w-4 h-4" {{ in_array($user->id, old('users', $selectedUsers
                                    ?? [])) ? 'checked' : '' }}>
                                    <span>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- Status --}}
            <div class="grid md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-3">
                    <label class="text-white">Status</label>
                </div>
                <div class="md:col-span-9 flex gap-6">

                    <label class="flex items-center gap-2">
                        <input type="radio" name="is_public" value="1" {{ old('is_public', $rewardEdit->is_public ?? 1)
                        == 1 ? 'checked' : '' }}>
                        <span class="text-white">Public</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="is_public" value="0" {{ old('is_public', $rewardEdit->is_public ?? 1)
                        == 0 ? 'checked' : '' }}>
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
                    {{ isset($rewardEdit) ? 'Update' : 'Save' }}
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
<script>
    document.addEventListener("DOMContentLoaded", function () {

    // 🔍 Search functionality
    const searchInput = document.getElementById("user-search");
    const userItems = document.querySelectorAll(".user-item");

    searchInput.addEventListener("keyup", function () {
        const value = this.value.toLowerCase();

        userItems.forEach(item => {
            const name = item.getAttribute("data-name");

            if (name.includes(value)) {
                item.style.display = "flex";
            } else {
                item.style.display = "none";
            }
        });
    });

    // ✅ Select All
    const checkAll = document.getElementById("check-all-users");
    const checkboxes = document.querySelectorAll(".user-checkbox");

    checkAll.addEventListener("change", function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

});
</script>
