<?php

use App\Models\FreeIssue;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FreeIssueController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])
    ->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])
    ->name('customers.store');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])
    ->name('customers.show');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
    ->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])
    ->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
    ->name('customers.destroy');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');
Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');
Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');
Route::get('/get-product-price/{productId}', [ProductController::class, 'getProductPrice'])
    ->name('get-product-price');


Route::get('/free_issues', [FreeIssueController::class, 'index'])
    ->name('free_issues.index');
Route::get('/free_issues/create', [FreeIssueController::class, 'create'])
    ->name('free_issues.create');
Route::post('/free_issues', [FreeIssueController::class, 'store'])
    ->name('free_issues.store');
Route::get('/free_issues/{free_issue}', [FreeIssueController::class, 'show'])
    ->name('free_issues.show');
Route::get('/free_issues/{free_issue}/edit', [FreeIssueController::class, 'edit'])
    ->name('free_issues.edit');
Route::put('/free_issues/{free_issue}', [FreeIssueController::class, 'update'])
    ->name('free_issues.update');
Route::delete('/free_issues/{free_issue}', [FreeIssueController::class, 'destroy'])
    ->name('free_issues.destroy');
Route::get('/get-free-issue/{productId}', [FreeIssueController::class, 'getFreeIssueByProduct'])
    ->name('get-free-issue');


Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])
    ->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])
    ->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])
    ->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
    ->name('orders.destroy');

Route::get('/order/{orderId}/download-pdf', [OrderController::class, 'downloadPDF'])
    ->name('orders.pdf.download');
Route::get('order/{order}/export-excel', [OrderController::class, 'exportExcel'])
    ->name('orders.excel.export');
Route::post('orders/bulk', [OrderController::class, 'bulkPDFGeneration'])
    ->name('orders.bulk');

Route::get('/discounts/index', [DiscountController::class, 'index'])
    ->name('discounts.index');
Route::get('/discounts/create', [DiscountController::class, 'create'])
    ->name('discounts.create');
Route::post('/discounts', [DiscountController::class, 'store'])
    ->name('discounts.store');
Route::get('/discounts/{discount}', [DiscountController::class, 'show'])
    ->name('discounts.show');
Route::get('/discounts/{discount}/edit', [DiscountController::class, 'edit'])
    ->name('discounts.edit');
Route::put('/discounts/{discount}', [DiscountController::class, 'update'])
    ->name('discounts.update');
Route::delete('/discounts/{discount}', [DiscountController::class, 'destroy'])
    ->name('discounts.destroy');
Route::get('/get-discount/{productId}/{quantity}', [DiscountController::class, 'discountByProduct'])
    ->name('get-product-discount');