<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Products</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_products'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Categories</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_categories'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Available Products</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['available_products'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Quick Actions</h2>
        <div class="flex space-x-4">
            <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                View Products
            </a>
            <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                Add New Product
            </a>
        </div>
    </div>
</div>