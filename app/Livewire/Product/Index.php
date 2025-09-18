<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $availabilityFilter = '';
    public $confirmingDeletion = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'availabilityFilter' => ['except' => ''],
    ];

    public function confirmDelete($productId)
    {
        $this->confirmingDeletion = $productId;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = null;
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        
        // Delete associated image if exists
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }
        
        $product->delete();
        
        $this->confirmingDeletion = null;
        session()->flash('success', 'Product deleted successfully!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::with('category')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('sku', 'like', '%'.$this->search.'%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->availabilityFilter !== '', function ($query) {
                $query->where('is_available', (bool)$this->availabilityFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.product.index', [
            'products' => $products,
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}