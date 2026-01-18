<!-- Blade + Tailwind -->
<div x-data="{ open: false }">
    <a href="#" @click.prevent="open = true" class="kantumruy-pro">
        <i class="mdi mdi-trash-can-outline me-1"></i> Delete
    </a>

    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black/50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-lg font-bold mb-4">Are you sure?</h4>
            <p class="mb-4">Are you sure you want to delete this item?</p>
            <div class="flex justify-end gap-2">
                <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <form method="POST" action="{{ route('admin.user.destroy', $attachment->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
