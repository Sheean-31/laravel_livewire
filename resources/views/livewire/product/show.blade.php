<div>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Products
        </a>
    </div>

    <!-- Product Details -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:w-1/3">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="md:w-2/3 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">SKU</h3>
                        <p class="text-lg text-gray-800">{{ $product->sku }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Category</h3>
                        <p class="text-lg text-gray-800">{{ $product->category->name }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Price</h3>
                        <p class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Stock Quantity</h3>
                        <p class="text-lg text-gray-800">{{ $product->stock_quantity }} units</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Availability</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_available ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Created</h3>
                        <p class="text-lg text-gray-800">{{ $product->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-600 mb-2">Description</h3>
                    <p class="text-gray-800 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4">
                    <a href="{{ route('products.edit', $product) }}" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Edit Product
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products -->
    @if($similarProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Similar Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProducts as $similar)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-4">
                            @if($similar->image)
                                <img src="{{ asset('storage/products/' . $similar->image) }}" 
                                     alt="{{ $similar->name }}" 
                                     class="w-full h-32 object-cover rounded-lg mb-4">
                            @else
                                <div class="w-full h-32 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                    <span class="text-gray-400 text-sm">No image</span>
                                </div>
                            @endif
                            
                            <h3 class="font-semibold text-lg mb-2">{{ $similar->name }}</h3>
                            <p class="text-blue-600 font-bold">${{ number_format($similar->price, 2) }}</p>
                            <p class="text-sm text-gray-600">SKU: {{ $similar->sku }}</p>
                            
                            <a href="{{ route('products.show', $similar) }}" 
                               class="inline-block mt-3 text-blue-600 hover:text-blue-800 text-sm">
                                View Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>