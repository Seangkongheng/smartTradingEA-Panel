
            <div class="tab-content hidden" id="footer-settings">
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-gray-900 kantumruy-pro border-l-4 border-green-600 pl-4">
                        ការកំណត់ Footer
                    </h3>

                    <form action="{{ route("admin.footer.store") }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($userEdit->id))
                                @method('PUT')
                            @endif
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700 kantumruy-pro">រក្សាសិទ្ធិ</label>
                                <input type="text"  name="copyright" class="w-full px-4 py-3 rounded-lg border outline-none border-gray-200 focus:ring-2 focus:ring-green-500" required  placeholder="អត្ថបទរក្សាសិទ្ធិ">
                            </div>
                            @error('copyright')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="space-y-4">
                            <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 kantumruy-pro">ការពិពណ៌នា</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border outline-none border-gray-200 focus:ring-2 focus:ring-green-500" required placeholder="សូមបញ្ចូលការពិពណ៌នា..."></textarea>
                             @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>
                        <div class="flex justify-end pt-8 border-t border-gray-100">
                            <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                                {{ isset($userEdit->id) ? 'ធ្វើបច្ចុប្បន្នភាព' : 'រក្សាទុកការកំណត់' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
