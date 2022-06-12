<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Events\message;
use Illuminate\Http\Request;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth:web'],function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::view('dashboard', 'admin.index')->name('dashboard');
    Route::resource('profile',App\Http\Controllers\ProfileController::class);
    Route::resource('categories',App\Http\Controllers\CategoryController::class);
    Route::resource('posts',App\Http\Controllers\PostController::class);
    Route::resource('tags',App\Http\Controllers\TagController::class);
    Route::resource('comments',App\Http\Controllers\CommentController::class);
    Route::resource('invoices',App\Http\Controllers\InvoiceController::class);
    Route::get('fetch',[App\Http\Controllers\CategoryController::class,'fetchcategory']);
    Route::get('fetchTag',[App\Http\Controllers\TagController::class,'fetchTag']);
    Route::get('fetchpost',[App\Http\Controllers\PostController::class,'fetchPost']);

    
    Route::get('/pay',[App\Http\Controllers\fatoorahcontroller::class,'payOrder'])->name('payment');
        
    Route::get('/call_back',[App\Http\Controllers\fatoorahcontroller::class,'paymentCallBack']);
    Route::get('/chat', [App\Http\Controllers\ChatsController::class,'index'])->name('chat');
    Route::post('messages', function(Request $request){
        event(new message($request->username,$request->message));
        return["success"=>true];
    });
}); 