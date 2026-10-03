<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserChatController;
use App\Http\Controllers\CustomerPortalController;
use App\Http\Controllers\SeoController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminSearchAnalyticsController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminSettingController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/empresa', [PageController::class, 'empresa'])->name('empresa');
Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/producto/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/destacados', [ProductController::class, 'destacados'])->name('products.destacados');
Route::get('/novedades', [PageController::class, 'novedades'])->name('novedades.index');
Route::get('/novedades/{slug}', [PageController::class, 'novedadShow'])->name('novedades.show');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [PageController::class, 'submitContacto'])->name('contacto.submit');

Route::get('/en-construccion', function() {
    return response()->file(public_path('en-construccion.html'));
})->name('en-construccion');

Route::get('/api/search-suggest', [ProductController::class, 'searchSuggest'])->name('api.search-suggest');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');

/*
|--------------------------------------------------------------------------
| Shopping Cart & Checkout Routes
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/pedido-completado/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::post('/pedido-voucher/{order_number}', [CheckoutController::class, 'uploadVoucher'])->name('checkout.voucher');

/*
|--------------------------------------------------------------------------
| Customer Authentication & Password Reset
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registro', [RegisterController::class, 'register'])->name('register.post');

Route::get('/recuperar-clave', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/recuperar-clave', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/restablecer-clave/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/restablecer-clave', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Customer Portal (Mi Cuenta) - Protected by auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('mi-cuenta')->name('customer.')->group(function () {
    Route::get('/', [CustomerPortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/pedidos', [CustomerPortalController::class, 'orders'])->name('orders');
    Route::get('/pedidos/{order_number}', [CustomerPortalController::class, 'orderDetail'])->name('order_detail');
    Route::get('/perfil', [CustomerPortalController::class, 'profile'])->name('profile');
    Route::post('/perfil', [CustomerPortalController::class, 'updateProfile'])->name('update_profile');
    Route::post('/clave', [CustomerPortalController::class, 'updatePassword'])->name('update_password');

    // Customer Chats with seller
    Route::get('/chats', [UserChatController::class, 'customerIndex'])->name('chats');
    Route::get('/chats/{id}', [UserChatController::class, 'customerShow'])->name('chat_show');
    Route::post('/chats/nuevo', [UserChatController::class, 'startChat'])->name('chat_start');
    Route::post('/chats/{id}/mensaje', [UserChatController::class, 'sendMessage'])->name('chat_send');
    Route::get('/api/chats/{id}/mensajes', [UserChatController::class, 'fetchMessages'])->name('chat_fetch');
});

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Control Panel Routes (Protected by 'admin' middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', AdminProductController::class);
    Route::post('products/{id}/toggle-price', [AdminProductController::class, 'togglePrice'])->name('products.toggle_price');
    Route::post('products/{id}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle_status');
    Route::delete('products/image/{id}', [AdminProductController::class, 'deleteImage'])->name('products.delete_image');
    Route::post('products/image/{id}/primary', [AdminProductController::class, 'setPrimaryImage'])->name('products.primary_image');

    // Categories
    Route::resource('categories', AdminCategoryController::class);

    // Brands
    Route::resource('brands', AdminBrandController::class);

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
    Route::get('orders/{id}/imprimir', [AdminOrderController::class, 'print'])->name('orders.print');

    // Customers (Reset password, block/unblock, delete, view history)
    Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
    Route::post('customers/{id}/toggle-block', [AdminCustomerController::class, 'toggleBlock'])->name('customers.toggle_block');
    Route::post('customers/{id}/reset-password', [AdminCustomerController::class, 'resetPassword'])->name('customers.reset_password');
    Route::delete('customers/{id}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');

    // Search Analytics
    Route::get('analytics/searches', [AdminSearchAnalyticsController::class, 'index'])->name('analytics.searches');
    Route::post('analytics/searches/clear', [AdminSearchAnalyticsController::class, 'clearLogs'])->name('analytics.clear');

    // Sliders & Banners
    Route::resource('sliders', AdminSliderController::class);
    Route::resource('banners', AdminBannerController::class);
    Route::post('banners/popup-config', [AdminBannerController::class, 'updatePopup'])->name('banners.update_popup');

    // Novedades / Blog
    Route::resource('articles', AdminArticleController::class);

    // Live Seller Chat Center
    Route::get('chats', [AdminChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{id}', [AdminChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{id}/reply', [AdminChatController::class, 'reply'])->name('chats.reply');
    Route::post('chats/{id}/status', [AdminChatController::class, 'updateStatus'])->name('chats.update_status');

    // Contact Inquiries
    Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{id}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::delete('inquiries/{id}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

    // System Settings (Branding, SMTP, Gateways, WhatsApp, Social, SEO)
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::post('settings/test-smtp', [AdminSettingController::class, 'testSmtp'])->name('settings.test_smtp');
});
