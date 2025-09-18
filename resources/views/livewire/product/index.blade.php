<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Test Products</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add New Product
        </a>
    </div>

    <!-- Filters section... (keep your existing filters) -->

    <!-- Products Grid -->
    <div class="bg-white rounded-lg shadow">
        @if($products->count() > 0)
            <div class="divide-y">
                @foreach($products as $product)
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex items-start space-x-4">
                                <!-- Product Image -->
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">No image</span>
                                    </div>
                                @endif
                                
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-600">SKU: {{ $product->sku }}</p>
                                    <p class="text-blue-600 font-bold">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
                                    <span class="inline-block px-2 py-1 text-xs rounded {{ $product->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_available ? 'Available' : 'Not Available' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-sm hover:bg-blue-200">
                                    View
                                </a>
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="bg-green-100 text-green-600 px-3 py-1 rounded text-sm hover:bg-green-200">
                                    Edit
                                </a>
                                
                                <!-- Delete Button with Confirmation -->
                                @if($confirmingDeletion == $product->id)
                                    <div class="flex space-x-2 items-center">
                                        <span class="text-sm text-red-600">Are you sure?</span>
                                        <button wire:click="deleteProduct({{ $product->id }})" 
                                                class="bg-red-600 text-red px-3 py-1 rounded text-sm hover:bg-red-700">
                                            Yes, Delete
                                        </button>
                                        <button wire:click="cancelDelete()" 
                                                class="bg-gray-300 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-400">
                                            Cancel
                                        </button>
                                    </div>
                                @else
                                    <button wire:click="confirmDelete({{ $product->id }})" 
                                            class="bg-red-100 text-red-600 px-3 py-1 rounded text-sm hover:bg-red-200">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-6">
                {{ $products->links() }}
            </div>
        @else
            <div class="p-6 text-center">
                <p class="text-gray-500">No products found.</p>
                <a href="{{ route('products.create') }}" class="text-blue-600 hover:underline">Create your first product</a>
            </div>
        @endif
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
</div>