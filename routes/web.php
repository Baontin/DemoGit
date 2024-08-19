<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('home.index');
// });
Route::get("/", [HomeController::class,"home"])->name("home.index");

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.index')->
    middleware(['auth', 'admin']);

/*=================================================================================================
                                     ADMIN
=================================================================================================*/

// CATEGORY
Route::get('view_category', [AdminController::class, 'view_category'])->
    name('admin.category')->middleware(['auth', 'admin']);

Route::post('add_category', [AdminController::class, 'add_category'])->
    name('admin.add_category')->middleware(['auth', 'admin']);

Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->
    name('admin.del_category')->middleware(['auth', 'admin']);

Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->
    name('admin.edit_category')->middleware(['auth', 'admin']);

Route::post('update_category/{id}', [AdminController::class, 'update_category'])->
    name('admin.update_category')->middleware(['auth', 'admin']);
//@ CATEGORY END

// PRODUCT
Route::get('add_product', [AdminController::class, 'add_product'])->
    name('admin.add_pro')->middleware(['auth', 'admin']);

Route::post('upload_product', [AdminController::class, 'upload_product'])->
    name('admin.upload_pro')->middleware(['auth', 'admin']);

Route::get('view_product', [AdminController::class, 'view_product'])->
    name('admin.view_pro')->middleware(['auth', 'admin']);

Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->
    name('admin.del_pro')->middleware(['auth', 'admin']);

Route::get('edit_product/{id}', [AdminController::class, 'edit_product'])->
    name('admin.edit_pro')->middleware(['auth', 'admin']);
    
Route::post('update_product/{id}', [AdminController::class, 'update_product'])->
    name('admin.update_pro')->middleware(['auth', 'admin']);
// @ PRODUCT END

// SEARCH
Route::get('product_search', [AdminController::class, 'product_search'])->
    name('admin.pro_search')->middleware(['auth', 'admin']);
// @ SEARCH END

// ORDER
Route::get('view_orders', [AdminController::class, 'view_orders'])->
    name('admin.view_order')->middleware(['auth', 'admin']);

Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->
    middleware(['auth', 'admin']);

Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']);
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']);

// @ ORDER END

// ORDER DETAIL
Route::get('view_ad_order_detail/{id}', [AdminController::class, 'view_ad_order_detail'])->
    name('admin.view_order_detail')->middleware(['auth', 'admin']);
// @ORDER DETAIL

/*=================================================================================================
                                     CLIENT
=================================================================================================*/
// PAGE
Route::get('shop', [HomeController::class, 'shop']);
Route::get('/shop/{cate_name}', [HomeController::class, 'filter'])->name('shop.filter');
Route::get('testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('why_us', [HomeController::class, 'why_us'])->name('why_us');
Route::get('contact_us', [homecontroller::class, 'contact_us'])->name('contact_us');

// @ END PAGE 

Route::get('product_details/{id}', [HomeController::class, 'product_details'])->
    name('home.pro_details');

// CART
Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->
    middleware(['auth', 'verified'])->name('home.add_cart');

Route::get('buy_now/{id}', [HomeController::class, 'buy_now'])->
    middleware(['auth', 'verified'])->name('home.buy');

Route::get('mycart', [HomeController::class, 'mycart'])->
    middleware(['auth', 'verified'])->name('home.cart');

Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->
    middleware(['auth', 'verified'])->name('home.del_cart');
// @END CART

// ORDER
Route::get('place_order', [HomeController::class, 'place_order'])->
    middleware(['auth', 'verified'])->name('home.place_order');

Route::post('confirm_order', [HomeController::class, 'confirm_order'])->
    middleware(['auth', 'verified'])->name('home.cf_order');

Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{totalOrder}', 'stripe');
    Route::post('stripe/{totalOrder}', 'stripePost')->name('stripe.post');
});

// Tăng giảm số lượng
Route::get('increase_quantity/{id}', [HomeController::class, 'increase_quantity'])->
    middleware(['auth', 'verified'])->name('home.inc_qty');
Route::get('decrease_quantity/{id}', [HomeController::class, 'decrease_quantity'])->
    middleware(['auth', 'verified'])->name('home.dec_qty');
// Tăng giảm số lượng @ end

// CUSTOMER INFO
Route::get('mypersonal', [HomeController::class, 'mypersonal'])->
    middleware(['auth', 'verified'])->name('home.mypersonal');

Route::get('view_order_detail/{id}', [HomeController::class, 'view_order_detail'])->
    middleware(['auth', 'verified'])->name('home.order_detail');
    
Route::post('update_customer_info', [HomeController::class, 'update_customer_info'])->
middleware(['auth', 'verified'])->name('home.update_cus_info');

// @ END CUSTOMER INFO



