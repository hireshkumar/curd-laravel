<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registrationcontroller;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('categories', CategoryController::class);
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::resource('subcategories', SubcategoryController::class);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);

Route::get('recodes', [Registrationcontroller::class, 'recodes'])->name('recodes');

Route::get('/registerform', [Registrationcontroller::class, 'index'])->name('registerform');

Route::post('/register', [Registrationcontroller::class, 'register'])->name('register');
//

Route::get('/import', function () {
    return view('import'); 
})->name('import');



Route::get('/export-excel', function() {
    return Excel::download(new UsersExport, 'students.xlsx');
})->name('export.excel');

Route::post('/import-excel', function () {
    Excel::import(new UsersImport, request()->file('file'));
    return back()->with('success', 'Students imported successfully!');
})->name('import.excel');



Route::get('forgot-password', [AuthController::class, 'showForgetPassword'])->name('auth.forgetpassword');

Route::post('forgot-password', [AuthController::class, 'submitForgetPassword'])->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'submitResetPassword'])->name('password.update');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);



// Route::middleware(['auth.sessionac'])->group(function () {

 Route::get('records', [Registrationcontroller::class, 'records'])->name('records');
 Route::get('variable_data', [Registrationcontroller::class, 'variable_data']);
 Route::post('image', [Imagecontroller::class, 'store'])->name('variable_data');
 Route::get('edit_record/{id}', [Registrationcontroller::class, 'edit_record'])->name('edit_record');
 Route::get('delete_record/{id}', [Registrationcontroller::class, 'delete_record'])->name('delete_record');
 Route::post('update_data/{id}', [RegistrationController::class, 'update_data'])->name('update_data');
 Route::get('toggle_status/{id}', [RegistrationController::class, 'toggle_status'])->name('toggle_status');
 Route::get('/get-cities/{state_id}', [RegistrationController::class, 'getCities']);
 Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); 
 Route::get('/file', [Registrationcontroller::class, 'index']);

// });

