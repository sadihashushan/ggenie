<?php

use App\Livewire\HomePage;
use App\Livewire\SupermarketsPage;
use App\Livewire\SupermarketDetailPage;
use App\Livewire\OrdersPage;
use App\Livewire\OrderDetailPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\SuccessPage;
use App\Livewire\CancelPage;
use App\Livewire\ReviewPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Http\Controllers\Genie\Auth\LoginController;
use App\Http\Controllers\Genie\Auth\RegisterController;
use App\Http\Controllers\Genie\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/supermarkets', SupermarketsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/supermarkets/{slug}', SupermarketDetailPage::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/genie/login', [LoginController::class, 'showLoginForm'])->name('genie.login');
Route::post('/genie/login', [LoginController::class, 'login']);
Route::get('/genie/register', [RegisterController::class, 'showRegistrationForm'])->name('genie.register');
Route::post('/genie/register', [RegisterController::class, 'register']);
Route::post('/genie/logout', [LoginController::class, 'logout'])->name('genie.logout');

Route::get('/genie/home', [HomeController::class, 'index'])->name('genie.home');
Route::post('/genie/orders/{order}/accept', [HomeController::class, 'acceptOrder'])->name('genie.orders.accept');
Route::post('/genie/orders/{order}/decline', [HomeController::class, 'declineOrder'])->name('genie.orders.decline');
Route::post('/genie/orders/{order}/complete', [HomeController::class, 'completeOrder'])->name('genie.orders.complete');
Route::post('/genie/orders/{order}/fail', [HomeController::class, 'failOrder'])->name('genie.orders.fail');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot', ForgotPasswordPage::class);
    Route::get('/reset', ResetPasswordPage::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/checkout/{orderIndex?}', CheckoutPage::class)->name('checkout');
    Route::get('/orders/{order_id}', OrderDetailPage::class)->name('orders.show');   
    Route::get('/orders', OrdersPage::class);
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/invoice/download/{order}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
    Route::get('/reviews', ReviewPage::class)->name('reviews');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


//FireBase
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');