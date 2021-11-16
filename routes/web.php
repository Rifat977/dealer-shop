<?php

use App\Http\Livewire\AddSale;
use App\Http\Livewire\Category;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Product;
use App\Http\Livewire\Product\AddProduct;
use App\Http\Livewire\Sale\ViewSale;
use App\Http\Livewire\SaleList;


use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');

Route::get('/product/products', Product::class)->name('product')->middleware('auth');
Route::get('/product/add', AddProduct::class)->name('add-product')->middleware('auth');
Route::get('/product/category', Category::class)->name('category')->middleware('auth');

Route::get('/sale/add', AddSale::class)->name('addsale')->middleware('auth');
Route::get('/sale/list', SaleList::class)->name('salelist')->middleware('auth');
Route::get('/sale/{id}', ViewSale::class)->name('viewsale')->middleware('auth');

require __DIR__.'/auth.php';
