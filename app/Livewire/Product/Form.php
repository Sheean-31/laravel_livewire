<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;

class Form extends Component
{
    use WithFileUploads;

    public $productId = null;
    public $product = null;
    public $name;
    public $sku;
    public $description;
    public $price;
    public $stock_quantity;
    public $is_available = true;
    public $category_id;
    public $image;
    public $tempImage;

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => [
                'required',
                'alpha_dash',
                'max:50',
                $this->product ? Rule::unique('products')->ignore($this->product->id) : 'unique:products,sku'
            ],
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock_quantity' => 'required|integer|min:0',
            'is_available' => 'boolean',
            'tempImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function mount($product = null)
    {
        if ($product) {
            $this->product = Product::find($product);
            $this->productId = $this->product->id;
            
            $this->name = $this->product->name;
            $this->sku = $this->product->sku;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            $this->stock_quantity = $this->product->stock_quantity;
            $this->is_available = $this->product->is_available;
            $this->category_id = $this->product->category_id;
            $this->image = $this->product->image;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'is_available' => $this->is_available,
        ];

        // Handle image upload
        if ($this->tempImage) {
            // Delete old image if exists
            if ($this->product && $this->product->image) {
                Storage::delete('public/products/' . $this->product->image);
            }
            
            // Store new image
            $imagePath = $this->tempImage->store('products', 'public');
            $data['image'] = basename($imagePath);
        }

        if ($this->product) {
            $this->product->update($data);
            session()->flash('success', 'Product updated successfully!');
        } else {
            Product::create($data);
            session()->flash('success', 'Product created successfully!');
        }

        // Reset image field
        $this->tempImage = null;

        return redirect()->route('products.index');
    }

    public function removeImage()
    {
        if ($this->product && $this->product->image) {
            Storage::delete('public/products/' . $this->product->image);
            $this->product->update(['image' => null]);
            $this->image = null;
        }
        $this->tempImage = null;
    }

    public function render()
    {
        return view('livewire.product.form', [
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}