<div>
    <h1 class="text-3xl font-bold mb-6">{{ $product ? 'Edit' : 'Create' }} Product</h1>

    <form wire:submit="save" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <!-- Image Upload Section -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
            
            @if($image || $tempImage)
                <div class="mb-4">
                    <img src="{{ $tempImage ? $tempImage->temporaryUrl() : asset('storage/products/' . $image) }}" 
                         alt="Product Image" 
                         class="w-32 h-32 object-cover rounded-lg border">
                    <button type="button" wire:click="removeImage" 
                            class="mt-2 bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                        Remove Image
                    </button>
                </div>
            @endif

            <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="mt-4 flex text-sm text-gray-600">
                        <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                            <span>Upload an image</span>
                            <input type="file" wire:model="tempImage" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 2MB</p>
                </div>
            </div>
            @error('tempImage') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Existing form fields (category, name, sku, etc.) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select wire:model="category_id" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                <input type="text" wire:model="name" class="w-full border-gray-300 rounded-md shadow-sm">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- SKU -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                <input type="text" wire:model="sku" class="w-full border-gray-300 rounded-md shadow-sm">
                @error('sku') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                <input type="number" step="0.01" wire:model="price" class="w-full border-gray-300 rounded-md shadow-sm">
                @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Stock Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity</label>
                <input type="number" wire:model="stock_quantity" class="w-full border-gray-300 rounded-md shadow-sm">
                @error('stock_quantity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Availability -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                <div class="flex items-center">
                    <input type="checkbox" wire:model="is_available" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-600">Available for sale</span>
                </div>
                @error('is_available') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea wire:model="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex space-x-4">
    <button type="submit" 
            style="background-color: #2563eb; color: white; padding: 0.5rem 1.5rem; border-radius: 0.375rem; border: 2px solid #1d4ed8; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        ✅ {{ $product ? 'Update' : 'Create' }} Product
    </button>
    
    <a href="{{ route('products.index') }}" 
       style="background-color: #d1d5db; color: #374151; padding: 0.5rem 1.5rem; border-radius: 0.375rem; border: 2px solid #9ca3af; text-decoration: none;">
        ❌ Cancel
    </a>
</div>
 <!-- END BUTTONS SECTION -->

    </form>
</div>