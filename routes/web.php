<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Models\Cart;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmailController;

Route::middleware(['role:ADMIN'])->group(function () {
;
//  Route::get('/admin', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');



    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');


    // for test route
    Route::get('/babu', [CategoryController::class, 'index'])->name('products.store');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// Route::get('admin/hehe', [DashboardController])
    // ->middleware('auth:admin');
    //product
    Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');

    Route::post('/product', [ProductController::class, 'store'])->name('products.add');
    Route::get('/view-product', [ProductController::class, 'index'])->name('products.view');
    // Route::get('/edit-product',[ProductController::class,'edit'])->name('products.edit');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
  Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

Route::get('/admin/orders/pending', [AdminOrderController::class, 'pending'])->name('admin.orders.pending');

Route::get('/admin/orders/accepted', [AdminOrderController::class, 'accepted'])->name('admin.orders.accepted');

Route::get('/admin/orders/rejected', [AdminOrderController::class, 'rejected'])->name('admin.orders.rejected');

Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');

Route::post('/admin/orders/{order}/accept', [AdminOrderController::class, 'accept'])->name('admin.orders.accept');

Route::post('/admin/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('admin.orders.reject');

Route::delete('/admin/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

Route::get('/admin/orders/delivered', [AdminOrderController::class, 'delivered'])->name('admin.orders.delivered');
Route::post('/admin/orders/{order}/mark-as-delivered', [AdminOrderController::class, 'markAsDelivered'])->name('admin.orders.mark-as-delivered');

// manage user route
Route::get('/admin/users', [UserController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'deleteUser'])->name('admin.users.delete');



})->middleware('role:ADMIN');


//login
Route::get('/register', [UserController::class, 'index'])->name('auth.register');
Route::post('/signup', [UserController::class, 'store'])->name('signup');
Route::get('/login', [UserController::class, 'create'])->name('login');
// Route::post('/login',[UserController::class,'create'])->name('auth.login');
Route::post('/loginMatch', [UserController::class, 'login'])->name('loginMatch');


Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Route::get('/home', [HomeController::class, 'showHome'])->name('home');
// Route::get('/', [HomeController::class, 'showHome'])->name('home');

Route::get('forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [UserController::class, 'reset'])->name('password.update');


Route::get('/send-email',[EmailController::class,'sendEmail'])->name('email');


//test
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/tester', [TestController::class, 'store'])->name('tester');



Route::middleware(['role:user'])->group(function () {
    Route::get('/pay', [PaymentController::class, 'payfom'])->name('esewa.pay');
    Route::post('/pay', [PaymentController::class, 'pay'])->name('esewa.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
    Route::get('/', [ProductController::class, 'home']);
    
    Route::get('/home', [HomeController::class, 'index'])->name('user.index');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
    // Route::get('/cart', [HomeController::class, 'cart'])->name('shopping-cart');
    Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
    Route::get('/contact', [HomeController::class, 'contacts'])->name('contact');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/shop-details/{id}', [CartController::class, 'carts'])->name('shop-details');
    Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [CartController::class, 'fetchUserCart'])->name('shopping-cart');
    Route::get('/delete/{id}', [CartController::class, 'delete'])->name('delete');

    // Cart routes

    // Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    // Route::get('/cart', [CartController::class, 'viewCart'])->name('shopping-cart');
    // Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    // Route::delete('/cart/remove/{cart}', [CartController::class, 'removeItem'])->name('cart.remove');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');


    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');


    // Profile routes
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
})->middleware('role:user');
