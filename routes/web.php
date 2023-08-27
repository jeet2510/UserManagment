<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\HomeController;

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
});
Route::get('/welcome/user', function () {
    return view('welcomeUser');
});
Auth::routes(['verify'=>true]);
// Route::get('/admin/login', [HomeController::class, 'index'])->name('admin.login');
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class,'login'])->name('admin.login');
    Route::post('logout', [AdminLoginController::class,'logout'])->name('admin.logout');
    // Add other admin routes as needed
});
Route::get('login', [AdminLoginController::class,'userLoginForm'])->name('login');
// Route::post('/admin/dashboard', [AdminDashboardController::class,'index'])->name('admin.login');

Route::get('/users', [AdminDashboardController::class, 'index'])->name('users.index');
Route::patch('/users/{id}/update-role', [AdminDashboardController::class, 'updateRole'])->name('users.update.role');
Route::get('/users/{id}/change-status', [AdminDashboardController::class, 'changeStatus'])->name('users.change.status');
Route::get('/users/{id}', [AdminDashboardController::class, 'destroy'])->name('users.destroy');
Route::post('/users/bulk-actions', [AdminDashboardController::class, 'bulkActions'])->name('users.bulk.actions');

Route::get('/home', [HomeController::class, 'index'])->name('home');
