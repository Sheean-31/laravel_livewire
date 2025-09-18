<?php

use App\Livewire\Dashboard;
use App\Livewire\Product\Index as ProductIndex;
use App\Livewire\Product\Form as ProductForm;
use App\Livewire\Product\Show as ProductShow;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Add this home route
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductForm::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductForm::class)->name('products.edit');
    Route::get('/products/{product}', ProductShow::class)->name('products.show');
});

require __DIR__.'/auth.php';