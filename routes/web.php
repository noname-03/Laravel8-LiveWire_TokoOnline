<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\Products\Index;
use App\Http\Livewire\Counter;
use Illuminate\Routing\RouteGroup;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::livewire('/admin/product', 'product.index');
Route::middleware(['auth'])->group(function () {
    route::get('/admin/products', Index::class)->name('products');
    route::get('/admin/counter', Counter::class)->name('counter');
});
