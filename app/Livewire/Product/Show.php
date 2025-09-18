<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $product;
    public $similarProducts;

    public function mount($product)
    {
        // Get the product with its category relationship
        $this->product = Product::with('category')->findOrFail($product);
        
        // Get similar products (same category)
        $this->similarProducts = Product::with('category')
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('is_available', true)
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.product.show');
    }
}