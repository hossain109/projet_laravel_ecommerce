<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategroyController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategroyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin',[AuthController::class,'loginAdmin']);
Route::post('admin',[AuthController::class,'authLoginAdmin'])->name('auth.login.admin');
Route::delete('admin/logout',[AuthController::class,'logoutAdmin'])->name('admin.logout');

Route::middleware('adminmiddle')->group(function(){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    //gestion of admin
    Route::get('admin/admin/list',[AdminController::class,'list']);
    Route::get('admin/admin/add',[AdminController::class,'add']);
    Route::post('admin/admin/add',[AdminController::class,'store'])->name('admin.store');
    Route::get('admin/admin/{user}/modify',[AdminController::class,'modify'])->name('admin.modify')->where(['user'=>'[0-9]+']);
    Route::post('admin/admin/{user}/update',[AdminController::class,'update'])->name('admin.update')->where(['user'=>'[0-9]+']);
    Route::delete('admin/admin/{user}/delete',[AdminController::class,'destroy'])->name('admin.delete')->where(['user'=>'[0-9]+']);

    //gestion of category
    Route::get('admin/category/list',[CategroyController::class,'list']);

    Route::get('admin/category/{slug}-{cateogry}',[CategroyController::class,'list'])->where(['slug'=>'[0-9a-z\-]+','category'=>'[0-9]+']);

    Route::get('admin/category/add',[CategroyController::class,'add']);
    Route::post('admin/category/add',[CategroyController::class,'store'])->name('category.store');
    Route::get('admin/category/{category}/modify',[CategroyController::class,'modify'])->name('category.modify')->where(['category'=>'[0-9]+']);
    Route::post('admin/category/{category}/update',[CategroyController::class,'update'])->name('category.update')->where(['category'=>'[0-9]+']);
    Route::delete('admin/category/{category}/delete',[CategroyController::class,'destroy'])->name('category.delete')->where(['category'=>'[0-9]+']);
    
    //subcategorie controller
    Route::get('admin/subcategory/list',[SubCategroyController::class,'list']);

    Route::get('admin/subcategory/{slug}-{subcateogry}',[SubCategroyController::class,'list'])->where(['slug'=>'[0-9a-z\-]+','subcategory'=>'[0-9]+']);

    Route::get('admin/subcategory/add',[SubCategroyController::class,'add']);
    Route::post('admin/subcategory/add',[SubCategroyController::class,'store'])->name('subcategory.store');
    Route::get('admin/subcategory/{subcategory}/modify',[SubCategroyController::class,'modify'])->name('subcategory.modify')->where(['subcategory'=>'[0-9]+']);
    Route::post('admin/subcategory/{subcategory}/update',[SubCategroyController::class,'update'])->name('subcategory.update')->where(['subcategory'=>'[0-9]+']);
    Route::delete('admin/subcategory/{subcategory}/delete',[SubCategroyController::class,'destroy'])->name('subcategory.delete')->where(['subcategory'=>'[0-9]+']);
    //controller for findout subcategories
    Route::post('admin/getSubcateory',[SubCategroyController::class,'getSubcateories']);
    //brand controller
    Route::get('admin/brand/list',[BrandController::class,'list']);
    Route::get('admin/brand/add',[BrandController::class,'add']);
    Route::post('admin/brand/add',[BrandController::class,'store'])->name('brand.store');
    Route::get('admin/brand/{brand}/modify',[BrandController::class,'modify'])->name('brand.modify')->where(['brand'=>'[0-9]+']);
    Route::post('admin/brand/{brand}/update',[BrandController::class,'update'])->name('brand.update')->where(['brand'=>'[0-9]+']);
    Route::delete('admin/brand/{brand}/delete',[BrandController::class,'destroy'])->name('brand.delete')->where(['brand'=>'[0-9]+']);
        //Color controller
    Route::get('admin/color/list',[ColorController::class,'list']);
    Route::get('admin/color/add',[ColorController::class,'add']);
    Route::post('admin/color/add',[ColorController::class,'store'])->name('color.store');
    Route::get('admin/color/{color}/modify',[ColorController::class,'modify'])->name('color.modify')->where(['color'=>'[0-9]+']);
    Route::post('admin/color/{color}/update',[ColorController::class,'update'])->name('color.update')->where(['color'=>'[0-9]+']);
    Route::delete('admin/color/{color}/delete',[ColorController::class,'destroy'])->name('color.delete')->where(['color'=>'[0-9]+']);
      
    //product controller
    Route::get('admin/product/list',[ProductController::class,'list']);
    Route::get('admin/product/add',[ProductController::class,'add']);
    Route::post('admin/product/add',[ProductController::class,'store'])->name('product.store');
    Route::get('admin/product/{product}/modify',[ProductController::class,'modify'])->name('product.modify')->where(['product'=>'[0-9]+']);
    Route::post('admin/product/{product}/update',[ProductController::class,'update'])->name('product.update')->where(['product'=>'[0-9]+']);
    Route::delete('admin/product/{product}/delete',[ProductController::class,'destroy'])->name('product.delete')->where(['product'=>'[0-9]+']);
    //delete image by product
    Route::get('admin/product/product_image/{image}',[ProductController::class,'delete_product_image'])->name('product.product_image')->where(['image'=>'[0-9]+']);
    //drag and drop sortable image insert
    Route::post('admin/product_image_shortable',[ProductController::class,'productImageShortable']);
});

//*****Front office controller */
//home route
Route::get('/',[HomeController::class,'home']);
Route::get('/{slug?}/{subSlug?}',[ProductListController::class, 'displayProduct']);

//Route::get('/product/product/test',[ProductListController::class, 'displayProduct']);
