<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Fronted\FrontedController;

use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\LogoController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StockController;

// use App\Http\Controllers\backend\VissionController;
// use App\Http\Controllers\backend\ProfileController;



Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/',[FrontedController::class,'index']);
Route::get('/about_us',[FrontedController::class,'about_us'])->name('about_us');
Route::get('/contact_us',[FrontedController::class,'contact_us'])->name('contact_us');
Route::post('/message',[FrontedController::class,'message'])->name('store_message');


Route::group(['middleware' => 'auth'],function(){
    Route::prefix('user')->group(function(){
        Route::get('/view',[UserController::class,'view_user'])->name('view_user');
        Route::get('/add',[UserController::class,'add_user'])->name('add_user');
        Route::post('/store',[UserController::class,'store_user'])->name('store_user');
        Route::get('/edit/{id}',[UserController::class,'edit_user'])->name('edit_user');
        Route::post('/update/{id}',[UserController::class,'update_user'])->name('update_user');
        Route::get('/delete/{id}',[UserController::class,'delete_user'])->name('delete_user');
    
}); 



Route::prefix('user')->group(function(){
    Route::get('/view',[UserController::class,'view_user'])->name('view_user');
    Route::get('/add',[UserController::class,'add_user'])->name('add_user');
    Route::post('/store',[UserController::class,'store_user'])->name('store_user');
    Route::get('/edit/{id}',[UserController::class,'edit_user'])->name('edit_user');
    Route::post('/update/{id}',[UserController::class,'update_user'])->name('update_user');
    Route::get('/delete/{id}',[UserController::class,'delete_user'])->name('delete_user');

});

Route::prefix('profile')->group(function(){
    Route::get('/view', [ProfileController::class,"index"])->name('profile.view');
    Route::get('/edit', [ProfileController::class,"edit"])->name('profile.edit');
    Route::post('/update', [ProfileController::class,"update"])->name('profile.update');
    Route::get('/password/view', [ProfileController::class,"password_view"])->name('profile.password_view');
    Route::post('/password/update', [ProfileController::class,"password_update"])->name('profile.password_update');
});


Route::prefix('logo')->group(function(){
    Route::get('/view',[LogoController::class,'view_logo'])->name('view_logo');
    Route::get('/add',[LogoController::class,'add_logo'])->name('add_logo');
    Route::post('/store',[LogoController::class,'store_logo'])->name('store_logo');
    Route::get('/edit/{id}',[LogoController::class,'edit_logo'])->name('edit_logo');
    Route::post('/update/{id}',[LogoController::class,'update_logo'])->name('update_logo');
    Route::get('/delete/{id}',[LogoController::class,'delete_logo'])->name('delete_logo');

});

Route::prefix('supplier')->group(function(){
    Route::get('/view',[SupplierController::class,'view'])->name('view_supplier');
    Route::get('/add',[SupplierController::class,'add'])->name('add_supplier');
    Route::post('/store',[SupplierController::class,'store'])->name('store_supplier');
    Route::get('/edit/{id}',[SupplierController::class,'edit'])->name('edit_supplier');
    Route::post('/update/{id}',[SupplierController::class,'update'])->name('update_supplier');
    Route::get('/delete/{id}',[SupplierController::class,'delete'])->name('delete_supplier');

});

Route::prefix('customer')->group(function(){
    Route::get('/view',[CustomerController::class,'view'])->name('view_customer');
    Route::get('/add',[CustomerController::class,'add'])->name('add_customer');
    Route::post('/store',[CustomerController::class,'store'])->name('store_customer');
    Route::get('/edit/{id}',[CustomerController::class,'edit'])->name('edit_customer');
    Route::post('/update/{id}',[CustomerController::class,'update'])->name('update_customer');
    Route::get('/delete/{id}',[CustomerController::class,'delete'])->name('delete_customer');
    Route::get('/credit',[CustomerController::class,'credit'])->name('credit_customer');
    Route::get('/credit/pdf',[CustomerController::class,'credit_pdf'])->name('credit_customer_pdf');
    Route::get('/credit/edit/customer/{invoice_id}',[CustomerController::class,'credit_edit_customer'])->name('credit_edit_customer');
    Route::post('/update/credit/customer/{invoice_id}',[CustomerController::class,'update_credit_customer'])->name('update_credit_customer');
    Route::get('/credit/details/customer/{invoice_id}',[CustomerController::class,'credit_details_customer'])->name('credit_details_customer');
    Route::get('/paid',[CustomerController::class,'paid'])->name('paid_customer');
    Route::get('/paid/pdf',[CustomerController::class,'paid_pdf'])->name('paid_customer_pdf');
    Route::get('/customer/wise/report',[CustomerController::class,'customer_wise_report'])->name('customer_wise_report');
    Route::get('/customer/wise/credit/report/pdf',[CustomerController::class,'customer_wise_credit_report_pdf'])->name('customer_wise_credit_report_pdf');
    Route::get('/customer/wise/paid/report',[CustomerController::class,'customer_wise_paid_report_pdf'])->name('customer_wise_paid_report_pdf');

    
});

Route::prefix('unit')->group(function(){
    Route::get('/view',[UnitController::class,'view'])->name('view_unit');
    Route::get('/add',[UnitController::class,'add'])->name('add_unit');
    Route::post('/store',[UnitController::class,'store'])->name('store_unit');
    Route::get('/edit/{id}',[UnitController::class,'edit'])->name('edit_unit');
    Route::post('/update/{id}',[UnitController::class,'update'])->name('update_unit');
    Route::get('/delete/{id}',[UnitController::class,'delete'])->name('delete_unit');

});

Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class,'view'])->name('view_category');
    Route::get('/add',[CategoryController::class,'add'])->name('add_category');
    Route::post('/store',[CategoryController::class,'store'])->name('store_category');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit_category');
    Route::post('/update/{id}',[CategoryController::class,'update'])->name('update_category');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('delete_category');

});

Route::prefix('product')->group(function(){
    Route::get('/view',[ProductController::class,'view'])->name('view_product');
    Route::get('/add',[ProductController::class,'add'])->name('add_product');
    Route::post('/store',[ProductController::class,'store'])->name('store_product');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit_product');
    Route::post('/update/{id}',[ProductController::class,'update'])->name('update_product');
    Route::get('/delete/{id}',[ProductController::class,'delete'])->name('delete_product');

});

Route::prefix('purchase')->group(function(){
    Route::get('/view',[PurchaseController::class,'view'])->name('view_purchase');
    Route::get('/add',[PurchaseController::class,'add'])->name('add_purchase');
    Route::post('/store',[PurchaseController::class,'store'])->name('store_purchase');
    Route::get('/pending',[PurchaseController::class,'pending'])->name('pending_purchase');
    Route::post('/update/{id}',[PurchaseController::class,'update'])->name('update_purchase');
    Route::get('/delete/{id}',[PurchaseController::class,'delete'])->name('delete_purchase');
    Route::get('/approve_purches/{id}',[PurchaseController::class,'approve'])->name('approve_purches');
    Route::get('/daily_purchase',[PurchaseController::class,'daily_purchase'])->name('daily_purchase');
    Route::get('/daily_purchase_pdf',[PurchaseController::class,'daily_purchase_pdf'])->name('daily_purchase_pdf');

});

Route::prefix('invoice')->group(function(){
    Route::get('/view',[InvoiceController::class,'view'])->name('view_invoice');
    Route::get('/add',[InvoiceController::class,'add'])->name('add_invoice');
    Route::post('/store',[InvoiceController::class,'store'])->name('store_invoice');
    Route::post('/update/{id}',[InvoiceController::class,'update'])->name('update_invoice');
    Route::get('/delete/{id}',[InvoiceController::class,'delete'])->name('delete_invoice');
    Route::get('/pending',[InvoiceController::class,'pending'])->name('pending_invoice');
    Route::get('/approved/{id}',[InvoiceController::class,'approved'])->name('approved_invoice');
    Route::post('/approved_store/{id}',[InvoiceController::class,'approved_store'])->name('approved_store');
    Route::get('/print-invoice',[InvoiceController::class,'print_invoice'])->name('print_invoice');
    Route::get('/print_invoice_list/{id}',[InvoiceController::class,'print_invoice_list'])->name('print_invoice_list');
    Route::get('/monthly_pdf_report',[InvoiceController::class,'monthly_pdf_report'])->name('monthly_pdf_report');
    Route::get('/monthly_pdf_report_list',[InvoiceController::class,'monthly_pdf_report_list'])->name('monthly_pdf_report_list');

});
Route::prefix('stoke')->group(function(){
    Route::get('/report',[StockController::class,'stock_report'])->name('stock_report');
    Route::get('/report_download',[StockController::class,'stock_download'])->name('stock_download');
    Route::get('/supplier/product/wise/product',[StockController::class,'supplier_wise_report'])->name('supplier_product_wise_report');
    Route::get('/supplier/wise/pdf',[StockController::class,'supplier_wise_report_pdf'])->name('supplier_wise_report_pdf');
    Route::get('/product/wise/pdf',[StockController::class,'product_wise_report_pdf'])->name('product_wise_report_pdf');

});

Route::get('/get-category',[DefaultController::class,'get_category'])->name('get_category');
Route::get('/get-product',[DefaultController::class,'get_product'])->name('get_product');
Route::get('/get-current_stock_now',[DefaultController::class,'current_stock_now'])->name('current_stock_now');





















});
















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

