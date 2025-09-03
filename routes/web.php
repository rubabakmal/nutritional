<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', function () {
    return view('index');
});
Route::get('cart', [CartController::class, 'cart'])->name('cart');
// Stripe Payment Routes
Route::get('/checkout', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::post('/create-payment-intent', [StripePaymentController::class, 'createPaymentIntent'])->name('payment.intent');
Route::get('/payment-success', [StripePaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-cancel', [StripePaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::post('/cod-order', [StripePaymentController::class, 'processCOD'])->name('cod.process');
Route::get('/cod-success/{order}', [StripePaymentController::class, 'codSuccess'])->name('cod.success');

// Route::get('/checkout', function () {
//     return view('checkout');
// });
Route::get('/products/featured', [ProductController::class, 'featured'])->name('product.featured');
Route::get('/product-detail/{product}', [ProductController::class, 'detail_show'])->name('product.detail');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');


// API routes for cart (if you want to separate API and web routes)
Route::prefix('api/cart')->name('api.cart.')->group(function () {
    Route::get('/count', function () {
        return response()->json(['count' => \App\Models\Cart::getCartCount()]);
    });
    Route::get('/total', function () {
        return response()->json(['total' => \App\Models\Cart::getCartTotal()]);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Auth::routes();

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'show')->name('dashboard');
    });

    // Users Management
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/create', 'store')->name('user.store');
        Route::get('/{user}', 'edit')->name('user.edit');
        Route::patch('/{user}', 'update')->name('user.update');
        Route::delete('/{user}', 'destroy')->name('user.destroy');
    });

    // Categories Management
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/create', 'store')->name('category.store');
        Route::get('/{category}', 'show')->name('category.show');
        Route::get('/{category}/edit', 'edit')->name('category.edit');
        Route::patch('/{category}', 'update')->name('category.update');
        Route::delete('/{category}', 'destroy')->name('category.destroy');
    });

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('product.index');
        Route::get('/create', 'create')->name('product.create');
        Route::post('/create', 'store')->name('product.store');
        Route::get('/{product}', 'show')->name('product.show');
        Route::get('/{product}/edit', 'edit')->name('product.edit');
        Route::patch('/{product}', 'update')->name('product.update');
        Route::delete('/{product}', 'destroy')->name('product.destroy');
    });

    // Profile Management
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::post('/profile', 'update')->name('profile.update');
    });


  Route::controller(App\Http\Controllers\OrderController::class)->group(function () {
    Route::get('orders', 'index')->name('order.index');
    Route::get('orders/{order}', 'show')->name('order.show');
    Route::patch('orders/{order}/status', 'updateStatus')->name('order.update-status');
});
});
