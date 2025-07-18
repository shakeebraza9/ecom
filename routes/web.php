<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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





//Blogs
Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'category']);

Route::get('/products/{id}', [App\Http\Controllers\HomeController::class, 'product']);

Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop.index');;
Route::get('/shopdata', [App\Http\Controllers\HomeController::class, 'shopData'])->name('shop.data');;


// Route::post('/cart/add_to_cart', [App\Http\Controllers\HomeController::class, 'add_to_cart']);

Route::get('/combination_maker', [App\Http\Controllers\HomeController::class, 'combination_maker']);
Route::get('/blogs/categories/{id}', [App\Http\Controllers\HomeController::class, 'blog_categories']);
Route::get('/pages/{slug}', [App\Http\Controllers\HomeController::class, 'pageContent']);

//Carts
Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart']);
Route::get('/getCart', [App\Http\Controllers\CartController::class, 'getCart']);

Route::get('/cart/add_to_cart', [App\Http\Controllers\CartController::class, 'add_to_cart']);
Route::get('/cart/get_cart_details', [App\Http\Controllers\CartController::class, 'get_cart_details']);
Route::get('/cart/cart_clear', [App\Http\Controllers\CartController::class, 'cart_clear']);
Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'cart_remove']);



//Checkout
Route::get('/order-tracking', [App\Http\Controllers\CheckoutController::class, 'order_tracking']);

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::get('/order-confirmaton/{id}', [App\Http\Controllers\CheckoutController::class, 'order_confirmaton']);
Route::post('/checkout/submit', [App\Http\Controllers\CheckoutController::class, 'checkout_submit']);
Route::get('/get_invoice/{id}', [App\Http\Controllers\CheckoutController::class, 'get_invoice']);

// Newsletter
Route::post('theme/submit_newslettert', [App\Http\Controllers\HomeController::class, 'newslettertSubmit'])->name('newslettertSubmit');
// testing
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

// Website login
// Route::get('/login', [App\Http\Controllers\WebAuthController::class, 'login'])->name('weblogin');
// Route::get('/register', [App\Http\Controllers\WebAuthController::class, 'register'])->name('register');
// Route::get('/forgotpassword', [App\Http\Controllers\WebAuthController::class, 'forgotPassword'])->name('forgotpassword');
// Route::post('/createaccount', [App\Http\Controllers\WebAuthController::class, 'createAccount']);
// Route::post('/weblogin', [App\Http\Controllers\WebAuthController::class, 'webLogin']);
// Route::post('/password-reset-request', [App\Http\Controllers\WebAuthController::class, 'sendResetLink'])->name('resetpassword');

// dashboard login Group
// Route::middleware(['webLoginChk'])->group(function () {
//   Route::get('/dashboard', [App\Http\Controllers\WebAuthController::class, 'dashboard'])->name('dashboard');
//   Route::get('/logout', [App\Http\Controllers\WebAuthController::class, 'weblogout'])->name('weblogout');
// });


//Admin
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
Route::post('/admin/login_submit', [App\Http\Controllers\Admin\AuthController::class, 'login_submit']);

Route::middleware(['web', 'auth'])->group(function () {

  Route::get('/admin/update_file_url', [App\Http\Controllers\Admin\DashboardController::class, 'update_file_url']);
  Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
  Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard']);
  Route::get('/admin/changepassword', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword']);
  Route::post('/admin/changepassword_submit', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword_submit']);
  Route::get('/admin/status', [App\Http\Controllers\Admin\DashboardController::class, 'status']);


  //Users
    Route::get('/admin/users/index', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post('/admin/users/store', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('/admin/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::post('/admin/users/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::get('/admin/users/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);


    // profile edit
    Route::get('admin/editprofile', [App\Http\Controllers\Admin\profileController::class, 'index'])->name('profile');

    Route::post('admin/update', [App\Http\Controllers\Admin\profileController::class, 'update'])->name('update');


    //Roles
    Route::get('/admin/roles/index', [App\Http\Controllers\Admin\RoleController::class, 'index']);
    Route::get('/admin/roles/create', [App\Http\Controllers\Admin\RoleController::class, 'create']);
    Route::post('/admin/roles/store', [App\Http\Controllers\Admin\RoleController::class, 'store']);
    Route::get('/admin/roles/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit']);
    Route::post('/admin/roles/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update']);
    Route::get('/admin/roles/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'delete']);

    //Menus
    Route::get('/admin/menus/index', [App\Http\Controllers\Admin\MenuController::class, 'index']);
    Route::get('/admin/menus/create', [App\Http\Controllers\Admin\MenuController::class, 'create']);
    Route::post('/admin/menus/store', [App\Http\Controllers\Admin\MenuController::class, 'store']);
    Route::get('/admin/menus/edit/{id}', [App\Http\Controllers\Admin\MenuController::class, 'edit']);
    Route::post('/admin/menus/update/{id}', [App\Http\Controllers\Admin\MenuController::class, 'update']);
    Route::get('/admin/menus/delete/{id}', [App\Http\Controllers\Admin\MenuController::class, 'delete']);


    //Variations
    Route::get('/admin/variations/index', [App\Http\Controllers\Admin\VariationController::class, 'index']);
    Route::get('/admin/variations/create', [App\Http\Controllers\Admin\VariationController::class, 'create']);
    Route::post('/admin/variations/store', [App\Http\Controllers\Admin\VariationController::class, 'store']);
    Route::get('/admin/variations/edit/{id}', [App\Http\Controllers\Admin\VariationController::class, 'edit']);
    Route::post('/admin/variations/update/{id}', [App\Http\Controllers\Admin\VariationController::class, 'update']);
    Route::get('/admin/variations_items/{variations}/index', [App\Http\Controllers\Admin\VariationItemController::class,'index']);
    Route::post('/admin/variations_items/store', [App\Http\Controllers\Admin\VariationItemController::class,'store']);
    Route::get('/admin/variations_items/edit/{id}', [App\Http\Controllers\Admin\VariationItemController::class, 'edit']);
    Route::post('/admin/variations_items/update/{id}', [App\Http\Controllers\Admin\VariationItemController::class, 'update']);
    Route::get('/admin/variations_items/delete/{id}', [App\Http\Controllers\Admin\VariationItemController::class, 'delete']);


    //Menus Items
    Route::get('/admin/menus_items/{menu}/index', [App\Http\Controllers\Admin\MenuItemController::class,'index']);
    Route::post('/admin/menus_items/store', [App\Http\Controllers\Admin\MenuItemController::class,'store']);
    Route::get('/admin/menus_items/sort/{id}', [App\Http\Controllers\Admin\MenuItemController::class, 'sort']);
    Route::get('/admin/menus_items/edit/{id}', [App\Http\Controllers\Admin\MenuItemController::class, 'edit']);
    Route::post('/admin/menus_items/update/{id}', [App\Http\Controllers\Admin\MenuItemController::class, 'update']);
    Route::get('/admin/menus_items/delete/{id}', [App\Http\Controllers\Admin\MenuItemController::class, 'delete']);
     //page
     Route::get('/admin/page/index', [App\Http\Controllers\Admin\PageController::class, 'index']);
     Route::get('/admin/page/edit/{id}', [App\Http\Controllers\Admin\PageController::class, 'edit']);
     Route::get('/admin/page/create', [App\Http\Controllers\Admin\PageController::class, 'create']);
     Route::post('/admin/page/store', [App\Http\Controllers\Admin\PageController::class, 'store']);
     Route::post('/admin/page/update/{id}', [App\Http\Controllers\Admin\PageController::class, 'update']);
     Route::get('/admin/page/delete/{id}', [App\Http\Controllers\Admin\PageController::class, 'delete']);


    //newsletters
    Route::get('/admin/newsletter/index', [App\Http\Controllers\Admin\NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/delete/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'delete'])->name('admin.newsletter.delete');


    //products
  Route::get('/admin/products/index', [App\Http\Controllers\Admin\ProductController::class, 'index']);
  Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create']);
  Route::post('/admin/products/store', [App\Http\Controllers\Admin\ProductController::class, 'store']);
  Route::get('/admin/products/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
  Route::post('/admin/products/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update-Products');
  Route::get('/admin/products/remove-image/{id}', [App\Http\Controllers\Admin\ProductController::class, 'remove_image']);
  Route::get('/admin/products/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);
  Route::post('/admin/products/variations/{id}', [App\Http\Controllers\Admin\ProductController::class, 'variations']);
  Route::get('/admin/products/getvariations/{id}', [App\Http\Controllers\Admin\ProductController::class, 'getvariations'])->name('products.getvariations');
  Route::DELETE('/admin/products/removevariation/{id}', [App\Http\Controllers\Admin\ProductController::class, 'remove_variation'])->name('products.removevariation');
  Route::post('/admin/products/variationsupdate/{id}', [App\Http\Controllers\Admin\ProductController::class, 'variationsUpdate'])->name('products.variationsupdate');


  //orders
  Route::get('/admin/orders/index', [App\Http\Controllers\Admin\OrderController::class, 'index']);
  Route::get('/admin/orders/edit/{id}', [App\Http\Controllers\Admin\OrderController::class, 'edit']);
  Route::post('/admin/orders/update/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update']);

  // client Report
  Route::get('/admin/reports/clients/index', [App\Http\Controllers\Admin\ReportsController::class, 'clientIndex']);
  Route::get('admin/reports/clients/export-pdf', [App\Http\Controllers\Admin\ReportsController::class, 'exportPdf'])->name('admin.reports.clients.exportPdf');
Route::get('admin/reports/clients/export-excel', [App\Http\Controllers\Admin\ReportsController::class, 'exportExcel'])->name('admin.reports.clients.exportExcel');

  // Route::get('/admin/reports/clients/edit/{id}', [App\Http\Controllers\Admin\ReportsController::class, 'clientEdit']);

  // Product Report
  Route::get('/admin/reports/product/index', [App\Http\Controllers\Admin\ReportsController::class, 'productIndex']);

  // inventory Report
  Route::get('/admin/reports/inventory/index', [App\Http\Controllers\Admin\ReportsController::class, 'inventoryIndex']);

  // payment
  Route::get('/admin/payment/index', [App\Http\Controllers\Admin\PaymentController::class, 'index']);
  Route::get('/admin/payment/create', [App\Http\Controllers\Admin\PaymentController::class, 'create']);
  Route::get('/admin/payment/edit/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'edit']);
  Route::get('/admin/payment/delete/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'delete']);
  Route::post('/admin/payment/store', [App\Http\Controllers\Admin\PaymentController::class, 'store']);
  Route::post('/admin/payment/update/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'update']);

  //Sliders
  Route::get('/admin/sliders/index', [App\Http\Controllers\Admin\SliderController::class, 'index']);
  Route::get('/admin/sliders/create', [App\Http\Controllers\Admin\SliderController::class, 'create']);
  Route::post('/admin/sliders/store', [App\Http\Controllers\Admin\SliderController::class, 'store']);
  Route::get('/admin/sliders/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'edit']);
  Route::post('/admin/sliders/update/{id}', [App\Http\Controllers\Admin\SliderController::class, 'update']);
  Route::get('/admin/sliders/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'delete']);


  //Collections
  Route::get('/admin/collections/index', [App\Http\Controllers\Admin\CollectionController::class, 'index']);
  Route::get('/admin/collections/create', [App\Http\Controllers\Admin\CollectionController::class, 'create']);
  Route::post('/admin/collections/store', [App\Http\Controllers\Admin\CollectionController::class, 'store']);
  Route::get('/admin/collections/edit/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'edit']);
  Route::post('/admin/collections/update/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'update']);
  Route::get('/admin/collections/delete/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'delete']);


  //Brand
  Route::get('/admin/brand/index', [App\Http\Controllers\Admin\BrandController::class, 'index']);
  Route::get('/admin/brand/create', [App\Http\Controllers\Admin\BrandController::class, 'create']);
  Route::post('/admin/brand/store', [App\Http\Controllers\Admin\BrandController::class, 'store']);
  Route::get('/admin/brand/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit']);
  Route::post('/admin/brand/update/{id}', [App\Http\Controllers\Admin\BrandController::class, 'update']);
  Route::get('/admin/brand/delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'delete']);




    //products category
    Route::get('/admin/categories/index', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('/admin/categories/store', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('/admin/categories/sort', [App\Http\Controllers\Admin\CategoryController::class, 'sort']);
    Route::get('/admin/categories/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::post('/admin/categories/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('/admin/categories/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);

  //filemanager
    Route::get('/admin/filemanager/search', [App\Http\Controllers\Admin\FilemanagerController::class, 'search']);
    Route::get('/admin/filemanager', [App\Http\Controllers\Admin\FilemanagerController::class, 'index']);
    Route::get('admin/filemanager/create',[App\Http\Controllers\Admin\FilemanagerController::class,'create']);
    Route::post('admin/filemanager/store',[App\Http\Controllers\Admin\FilemanagerController::class,'store']);
    Route::get('admin/filemanager/edit/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'edit']);
    Route::post('admin/filemanager/update/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'update']);
    Route::get('admin/filemanager/delete/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'delete']);

  //Settings
    Route::get('admin/settings/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit']);
    Route::post('admin/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update']);


  //backup
    Route::get('admin/backup', [App\Http\Controllers\Admin\BackupController::class, 'index']);
    Route::post('admin/backup/download', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('admin.backup.download');
    Route::get('admin/backup/delete/{id}', [App\Http\Controllers\Admin\BackupController::class, 'delete']);

});

// Auth::routes();

Route::fallback(function () {
    return redirect('/');
});
