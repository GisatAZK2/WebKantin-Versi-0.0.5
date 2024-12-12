<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PanelSession;
use App\Http\Controllers\AdminController;
use App\Livewire\HomePage;
use App\Livewire\CategoriesPage ;
use App\Livewire\ProductPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\About;

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductPage::class);
Route::get('/about', About::class);
Route::get('/products/{name}',ProductDetailPage::class);
