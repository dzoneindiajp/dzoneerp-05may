<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/1122', function () {
    return view('new');
});

// No Permission
Route::get('/403', function () {
    return view('errors.404');
})->name('NoPermission');

// Not Found
Route::get('/404', function () {
    return view('errors.404');
})->name('NotFound');

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

// Route::get('logout',[HomeController::class,'logout'])->name('logout');

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Supplier
    Route::delete('suppliers/destroy', 'SupplierController@massDestroy')->name('suppliers.massDestroy');
    Route::resource('suppliers', 'SupplierController');

    // staff
    Route::delete('staffs/destroy', 'StaffController@massDestroy')->name('staffs.massDestroy');
    Route::resource('staffs', 'StaffController');

    //vendors
    Route::delete('vendors/destroy', 'VendorController@massDestroy')->name('vendors.massDestroy');
    Route::resource('vendors','VendorController');

    //Categories
    Route::resource('categories','CategoryController');

    // SubCategory
    Route::resource('subcategory','SubcategoryController');

    // Product
    Route::post('products/getsubCategory', 'ProductController@getsubCategory')->name('products.getsubCategory');
    Route::resource('products','ProductController');

    // purchases
    Route::post('purchases/getUsers', 'PurchaseController@getUsers')->name('purchases.getUsers');
    Route::resource('purchases','PurchaseController');

    // Sizes
    Route::resource('sizes', 'SizesController');

    // Colors
    Route::resource('colors', 'ColorsController');
    //Units
    Route::resource('units','UnitController');


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
