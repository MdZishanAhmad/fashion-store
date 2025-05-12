
<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Http\Controllers\CartController;
use App\Models\Cart;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:ADMIN'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');



    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');


    // for test route
    Route::get('/babu', [CategoryController::class, 'index'])->name('products.store');
    Route::post('/category', [CategoryController::class, 'store'])->name('addCategory');



    //product
    Route::get('/add-product', [ProductController::class, 'create'])->name('products.create');

    Route::post('/product', [ProductController::class, 'store'])->name('products.add');
    Route::get('/view-product', [ProductController::class, 'index'])->name('products.view');
    // Route::get('/edit-product',[ProductController::class,'edit'])->name('products.edit');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
})->middleware('role:ADMIN');


//login
Route::get('/register', [UserController::class, 'index'])->name('auth.register');
Route::post('/signup', [UserController::class, 'store'])->name('signup');
Route::get('/login', [UserController::class, 'create'])->name('login');
// Route::post('/login',[UserController::class,'create'])->name('auth.login');
Route::post('/loginMatch', [UserController::class, 'login'])->name('loginMatch');
Route::get('/dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');







//test
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/tester', [TestController::class, 'store'])->name('tester');




Route::middleware(['role:user'])->group(function () {

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
    Route::get('/', [HomeController::class, 'index'])->name('user.index');
    // Route::get('/cart', [HomeController::class, 'cart'])->name('shopping-cart');
    Route::get('/shop', [HomeController::class, 'card'])->name('shop');
    Route::get('/contact', [HomeController::class, 'contacts'])->name('contact');

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/shop-details/{id}', [CartController::class, 'carts'])->name('shop-details');
    Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [CartController::class, 'fetchUserCart'])->name('shopping-cart');


    // Cart routes
  
        // Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        // Route::get('/cart', [CartController::class, 'viewCart'])->name('shopping-cart');
        // Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
        // Route::delete('/cart/remove/{cart}', [CartController::class, 'removeItem'])->name('cart.remove');
})->middleware('role:user');
