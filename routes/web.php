<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Auth\Events\Verified;

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorProductDetailController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Models\ColorProductDetail;


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


// Auth
// Route::prefix('admin')->group(function () {
Auth::routes(['verify' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// });

//

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'brand', 'as' => 'brand.', 'namespace' => 'Brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('add', [BrandController::class, 'add'])->name('add');
        Route::post('store', [BrandController::class, 'store'])->name('store');
        Route::get('{id}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [BrandController::class, 'update'])->name('update');
        Route::delete('{id}', [BrandController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update', [ProductController::class, 'update'])->name('update');
        Route::get('{id}/create-detail', [ProductDetailController::class, 'create'])->name('create_detail');
        Route::post('/store-detail', [ProductDetailController::class, 'store'])->name('store_detail');
        Route::post('/create-product-color', [ColorProductDetailController::class, 'create'])->name('create_product_color');
        Route::get('/{product_detail}/list-color-product', [ColorProductDetailController::class, 'listColorProduct'])->name('list_color_product');
        Route::delete('/delete-color-product', [ColorProductDetailController::class, 'delete'])->name('delete_color_product');
        Route::put('/update-color-product', [ColorProductDetailController::class, 'update'])->name('update_color_product');
        Route::get('/{id}/product-detail', [ProductDetailController::class, 'productDetail'])->name('product_detail');
        Route::delete('/delete-img-product-detail', [ProductDetailController::class, 'deleteImg'])->name('detele_img_product_detai');
        Route::post('/update-product-detail', [ProductDetailController::class, 'update'])->name('update_product_detail');
        Route::delete('/detele-product-detail', [ProductDetailController::class, 'delete'])->name('detele_product_detail');
        Route::get('{id}/list-product-detail', [ProductDetailController::class, 'listProductDetail'])->name('list_product_detail');
        Route::delete('delete-product', [ProductController::class, 'deleteProduct'])->name('delete_product');
        Route::post('change-status', [ProductController::class, 'changeStatus'])->name('change_status');
        Route::post('change-outstanding', [ProductController::class, 'changeOutstanding'])->name('change_outstanding');
    });
    Route::group(['prefix' => 'category', 'as' => 'category.', 'namespace' => 'Category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('add', [CategoryController::class, 'add'])->name('add');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'banner', 'as' => 'banner.', 'namespace' => 'Banner'], function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('add', [BannerController::class, 'add'])->name('add');
        Route::post('store', [BannerController::class, 'store'])->name('store');
        Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
        Route::delete('{id}', [BannerController::class, 'destroy'])->name('destroy');
    });
});
Route::group(['as' => 'user.', 'namespace' => 'User'], function () {
    Route::get('/', [UserProductController::class, 'index']);
    Route::group(['prefix' => 'product', 'as' => 'product.', 'namespace' => 'Product'], function () {
        Route::get('/', [UserProductController::class, 'index'])->name('index');
        Route::get('/list-product', [UserProductController::class, 'listProduct'])->name('list_product');
        Route::get('{id}/product-detail-{capcityId}', [UserProductController::class, 'productDetail'])->name('product_detail');
    });
});
Route::fallback(function () {
    return view('errors.404');
});
