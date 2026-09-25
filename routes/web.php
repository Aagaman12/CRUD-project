<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

//Task 1

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // route to creating products data.

Route::post('/products', [ProductController::class, 'store'])->name('products.store');  // route to storing products data.

Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show'); // route to show individual product details.

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');    // route to edit product data.

Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');  // route to update product data.

Route::delete('/products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');  // route to delete product data.


//Task 2

Route::get('/products', [ProductController::class, 'search'])->name('products.index');  //route to search products.