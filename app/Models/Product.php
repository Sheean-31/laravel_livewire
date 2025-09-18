<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'category_id', 'name', 'sku', 'description', 'price', 
    'stock_quantity', 'is_available', 'specifications', 
    'image', 'published_at'  // Added image field
];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'specifications' => 'array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}