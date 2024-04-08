<?php
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/UserAccount', function () {
    return view('UserAccount');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/editadmin', function () {
    return view('editadmin');
})->name('editadmin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');

require __DIR__.'/auth.php';
// routes/web.php
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login');
use App\Http\Controllers\UserController;

// Route pour afficher le formulaire de création d'utilisateur
Route::get('/users/create', [UserController::class, 'createForm'])->name('createForm');

// Route pour traiter les données du formulaire de création d'utilisateur
Route::post('/users/create', [UserController::class, 'createUser'])->name('createUser');
Route::get('/users', 'UserController@showUsers');
Route::get('/admin/users', [UserController::class, 'showUsers'])->name('admin.users');


Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/admin/users/{user}', [UserController::class, 'adminupdate'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [UserController::class, 'admindestroy'])->name('admin.users.destroy');
Route::get('/admin/users/{user}/edit', [UserController::class, 'adminedit'])->name('adminedit');
Route::put('/admin/users/{user}', 'UserController@adminupdate')->name('admin.users.update');
Route::get('/UserAccount', [UserController::class, 'showUserAccount'])->name('user.account');
Route::get('/cotation-generator', 'CotationController@generate')->name('cotation.generate');


Route::post('/acheter-crypto', [TransactionController::class, 'acheter'])->name('acheter-crypto');
Route::post('/vendre-crypto', [TransactionController::class, 'vendre'])->name('vendre-crypto');
