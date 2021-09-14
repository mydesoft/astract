<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Models\Role;
// use Auth;

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
//Authentication Controller
Route::get('/', [AuthenticationController::class, 'login'])->name('login');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'loginUser'])->name('loginUser');
Route::post('/register', [AuthenticationController::class, 'registerUser'])->name('registerUser');
Route::get('/confirmation', [AuthenticationController::class, 'confirmation'])->name('confirmation');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//Contact Controller
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'contactAction'])->name('contactAction');

//Protected Routes
Route::group(['middleware' => ['auth']], function(){

    //Logged In User Route
    Route::group(['middleware' => ['user']], function(){
        Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');

    });

    //Admin Routes
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/registered-users', [AdminController::class, 'registeredUsers'])->name('registeredUsers');
        Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
        Route::post('/activate/{user}', [AdminController::class, 'activate'])->name('activate');
        Route::post('/deactivate/{user}', [AdminController::class, 'deActivate'])->name('deactivate');
        Route::get('/delete/{user}', [AdminController::class, 'delete'])->name('delete');
        Route::post('/add-admin', [AdminController::class, 'addAdmin'])->name('addAdmin');
        Route::get('/delete/admin/{admin}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
        Route::get('/read-messages', [AdminController::class, 'readMessages'])->name('readMessages');
        Route::get('/unread-messages', [AdminController::class, 'unreadMessages'])->name('unreadMessages');
        Route::get('/mark-as-read/{message}', [AdminController::class, 'markAsRead'])->name('markAsRead');
        Route::get('/delete-message/{message}', [AdminController::class, 'deleteMessage'])->name('deleteMessage');







    });
});



