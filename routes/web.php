<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PreviousRecordController;
use App\Http\Controllers\ContactController;
Route::get('/', [LandingController::class, 'index']);
Route::get('/shopkeeper/login', [ShopController::class, 'login'])->name('shop.login');

Route::post('/shopkeeper/login', [ShopController::class, 'loginPost'])->name('shop.login.post');

Route::get('/shop/register', [ShopController::class, 'register'])->name('shop.register');

Route::post('/shop/register', [ShopController::class, 'registerPost'])->name('shop.register.post');

Route::middleware(['nocache'])->group(function(){

    Route::get('/shopkeeper/dashboard', [ShopController::class,'index']);
    


 Route::get('/shopkeeper/profile', [ShopController::class, 'profile'])
    ->name('shop.profile');
    Route::post('/shopkeeper/profile/update', [ShopController::class, 'updateProfile'])
    ->name('shop.profile.update');
    Route::post('/shopkeeper/password/update',
    [ShopController::class,'updatePassword'])
    ->name('shop.password.update');










Route::get('/shopkeeper/customers', [CustomerController::class, 'index'])
    ->name('customers.index');
    Route::post('/shopkeeper/customers/store', [CustomerController::class, 'store'])
    ->name('customers.store');
    Route::post('/shopkeeper/customers/update/{id}', [CustomerController::class, 'update'])
    ->name('customers.update');

Route::get('/shopkeeper/customers/delete/{id}', [CustomerController::class, 'delete'])
    ->name('customers.delete');
    Route::get('/shopkeeper/billing', [ShopController::class, 'billing'])
    ->name('billing');
    Route::get('/shopkeeper/reminders', [ShopController::class, 'reminders'])
    ->name('reminders');
  Route::get('/shopkeeper/products', [ProductController::class, 'index'])
    ->name('shopkeeper.products');
   
Route::get('/shopkeeper/products/create', [ProductController::class, 'create'])->name('shopkeeper.products.create');

Route::post('/shopkeeper/products/store', [ProductController::class, 'store'])->name('shopkeeper.products.store');
Route::post('/shopkeeper/products/update/{id}', [ProductController::class, 'update'])
    ->name('shopkeeper.products.update');

Route::get('/shopkeeper/products/delete/{id}', [ProductController::class, 'delete'])
    ->name('shopkeeper.products.delete');





Route::post('/bill/store', [BillingController::class, 'storeBill'])->name('bill.store');
Route::get('/bill/invoice/{id}', [BillingController::class, 'invoice'])->name('bill.invoice');
Route::get('/bill/history/{customer_id}', [BillingController::class, 'history'])->name('bill.history');
Route::post('/shopkeeper/bill/{id}/update',
    [BillingController::class, 'update'])
    ->name('bill.update');
    Route::get('/shopkeeper/reminders',
    [BillingController::class,'paymentReminder'])
    ->name('payment.reminder');
    Route::get('/shopkeeper/send-reminder/{id}',
    [BillingController::class,'sendReminder'])
    ->name('send.reminder');
    

Route::get('/shopkeeper/previous-records', [PreviousRecordController::class, 'index'])
    ->name('previous.records');

Route::post('/shopkeeper/previous-records/store', [PreviousRecordController::class, 'store'])
    ->name('previous.records.store');
Route::post('/shopkeeper/previous-records/update/{id}',[PreviousRecordController::class,'update']);

Route::get('/shopkeeper/calculator', [ShopController::class, 'calculator'])
    ->name('shopkeeper.calculator');



})->name('shop.dashboard');

Route::get('/shop/logout', [ShopController::class, 'logout'])->name('shop.logout');



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'loginPost'])->name('admin.login.post');
Route::get('/admin/register',[AdminController::class,'register'])->name('admin.register');

Route::post('/admin/register',[AdminController::class,'registerPost'])->name('admin.register.post');

Route::middleware(['nocache'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class,'index']);
   

Route::get('/admin/addnew', [AdminController::class, 'addNew'])
    ->name('admin.addnew');
Route::post('/admin/addnew', [AdminController::class, 'storeShopkeeper'])->name('admin.storeShopkeeper');
Route::get('/admin/shopkeepers', [AdminController::class, 'shopkeepers'])->name('shopkeepers');
Route::get('/admin/edit_shopkeeper/{id}', [AdminController::class, 'edit'])->name('shopkeepers.edit');

Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('shopkeepers.update');
Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('shopkeepers.delete');
Route::post('/admin/shopkeepers/update-status', [AdminController::class, 'updateStatus'])->name('shopkeepers.updateStatus');
Route::get('/admin/profile', [AdminController::class,'profile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminController::class,'edit'])->name('admin.profile.edit');

Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])
    ->name('admin.profile.update');
Route::get('/admin/change-password', [AdminController::class,'changePassword'])->name('admin.password');

Route::post('/admin/change-password', [AdminController::class,'updatePassword'])->name('admin.password.update');
Route::post('/admin/change-password', [AdminController::class, 'updatePassword'])
    ->name('admin.password.update');


})->name('admin.dashboard');
 Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');









    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
    ->name('forgot.password');

Route::post('/forgot-password', [ForgotPasswordController::class, 'updatePassword'])
    ->name('forgot.password.update');
    

Route::get('/contact', [ContactController::class,'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class,'store'])
    ->name('contact.store');
    Route::view('/about', 'about')->name('about');