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
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

use App\Models\Subcategory;


Route::get('', [ProductController::class, 'showHome'])->name('home');

Route::get('fashion', [ProductController::class, 'showFashion'])->name('fashion');
Route::get('electronic', [ProductController::class, 'showElectronics'])->name('electronic');
Route::get('jewellery', [ProductController::class, 'showJewellery'])->name('jewellery');

Route::post('/add_cart/{id}', [CartController::class, 'addToCart'])->name('add_cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.page');

Route::post('/cart/increase/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/decrease/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');


Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');



Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('categories', CategoryController::class);
Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
Route::resource('subcategories', SubcategoryController::class);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);

Route::get('/get-subcategories/{category_id}', function ($category_id) {
    $subcategories = Subcategory::where('category_id', $category_id)->get();
    return response()->json(['subcategories' => $subcategories]);
});


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

Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/dashboard/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
});

Route::get('/profile', function () {
    $user = \App\Models\Student::find(session('uid'));
    return view('user.profile', compact('user'));
})->name('user.profile');
