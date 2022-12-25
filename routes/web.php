<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


Route::redirect('/','customer/createPage')->name('post#home');
Route::get('customer/createPage',[PostController::class,'create'])->name('post#createPage');
Route::post('post/create',[PostController::class,'postCreate'])->name('post#create');

Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
// Route::delete('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');

Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('post#updatePage');

Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('post#editPage');
Route::post('post/update',[PostController::class,'update'])->name('post#update');

//db relation test
Route::get('product/list',function(){
    $data = Product::select('products.*','categories.name as category_name','categories.description')
            ->rightJoin('categories','products.category_id','categories.id')
            ->get();
    dd($data->toArray());

});

Route::get('order/list',function(){
$data = Order::select('customers.name as customer_name','customers.email',
                    'products.name as products_name')
        ->join('customers','orders.customer_id','customers.id')
        ->join('products','orders.product_id','products.id')
        ->get();
dd($data->toArray());

});
