<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('adminlogin');
});

Route::group(['middleware' => 'admin'],
      function(){

        Route::get("/login",[AdminController::class,'login'])->name('login');
        Route::post('/admin_login',[Admincontroller::class,'admin_login']);
        
        Route::get("/register",[AdminController::class,'register']);
        Route::post('/admin_register',[AdminController::class,'admin_register']);
    }
);

Route::get('/logout',[AdminController::class,'logout']);

Route::group(['middleware' => 'bunny'],
      function(){

        Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admindash');
        Route::get('/createproduct',[AdminController::class,'create']);
        Route::post('/save_product',[AdminController::class,'save_product']);
        Route::get('/products',[AdminController::class,'products']);

        Route::get('edit/{id}', [AdminController::class, 'edit']);
        Route::put('insert/{id}', [AdminController::class, 'insert']);
        Route::get('delete/{id}', [AdminController::class, 'delete'])->name('delete');

    }
);



