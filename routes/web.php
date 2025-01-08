<?php

use App\Http\Livewire\User\History;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\User\OrdersCart;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Chef\Profile\ChefBio;
use App\Http\Livewire\User\AccountSettings;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Orders\ListOrders;
use App\Http\Livewire\Chef\Settings\ChefSettings;
use App\Http\Livewire\Admin\Products\ListProducts;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Chef\Dashboard\ChefDashboard;
use App\Http\Livewire\Admin\Settings\UpdateSettings;
use App\Http\Livewire\Admin\Products\CreateProductsForm;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/homepage', [UserController::class, 'index'])->name('home');
    Route::get('/homepage/account-settings', AccountSettings::class)->name('account');
    Route::get('/homepage/orders', OrdersCart::class)->name('order');
    Route::get('/homepage/orders/history', History::class)->name('history');
});

Route::group(['middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::get('admin/users', ListUsers::class)->name('admin.users');
    Route::get('admin/products', ListProducts::class)->name('admin.products');
    Route::get('admin/orders', ListOrders::class)->name('admin.orders');
    Route::get('admin/products/create', CreateProductsForm::class)->name('admin.products.create');
    Route::get('admin/profile', UpdateProfile::class)->name('admin.profile.edit');
    Route::get('admin/settings', UpdateSettings::class)->name('admin.settings');
});

Route::group(['middleware' => ['auth', 'chef', 'verified']], function () {
    Route::get('chef/dashboard', ChefDashboard::class)->name('chef.dashboard');
    Route::get('chef/profile', ChefBio::class)->name('chef.profile.edit');
    Route::get('chef/settings', ChefSettings::class)->name('chef.settings');
});