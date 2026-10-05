<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

// Authentication

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Permission route
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Roles route
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Users route

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

    // Products route)

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // route to creating products data.

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');  // route to storing products data.

    Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show'); // route to show individual product details.

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');    // route to edit product data.

    Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');  // route to update product data.

    Route::delete('/products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');  // route to delete product data.

    // Search Route

    Route::get('/products', [ProductController::class, 'search'])->name('products.index');  // route to search products.

    // Categories route

    Route::resource('categories', CategoryController::class);

});
