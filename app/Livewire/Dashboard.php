<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::where('is_active', true)->count(),
            'available_products' => Product::where('is_available', true)->count(),
        ];

        return view('livewire.dashboard', compact('stats'));
    }
}