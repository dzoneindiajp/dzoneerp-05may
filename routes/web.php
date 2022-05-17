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

Route::redirect('/', 'login');
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

    // Processings
    Route::resource('processings','ProcessingController');

    // Finished
    Route::post('finished/getProcessing', 'FinishedController@getProcessing')->name('finished.getProcessing');
    Route::resource('finished','FinishedController');

    // purchases
    Route::post('purchases/getUsers', 'PurchaseController@getUsers')->name('purchases.getUsers');
    Route::get('purchases/{id}/invoice','PurchaseController@invoice')->name('purchases.invoice');
    Route::resource('purchases','PurchaseController');


    // return purchases
    Route::post('returnpurchases/getproducts', 'ReturnPurchaseController@getproducts')->name('returnpurchases.getproducts');
    Route::resource('returnpurchases','ReturnPurchaseController');

    // damage purchases
    Route::post('damagepurchases/getproducts', 'DamagePurchaseController@getproducts')->name('damagepurchases.getproducts');
    Route::resource('damagepurchases','DamagePurchaseController');

    //purchase inventory
    Route::resource('purchaseinventory','PurchaseInventoryController');

    // Sizes
    Route::resource('sizes', 'SizesController');

    // Colors
    Route::resource('colors', 'ColorsController');

    //Units
    Route::resource('units','UnitController');

    //Showroom
    Route::resource('showrooms','ShowroomController');

    // Reports
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        //purchase report
        Route::get('purchase','ReportController@index')->name('purchase.index');
        Route::post('getReport','ReportController@getReport')->name('purchase.getReport');

        //processing report
        Route::get('processingReport','ReportController@processingReport')->name('product.processingReport');
        Route::post('getprocessingReport','ReportController@getprocessingReport')->name('product.getprocessingReport');

        //finished report
        Route::get('finishedReport','ReportController@finishedReport')->name('product.finishedReport');
        Route::post('getfinishedReport','ReportController@getfinishedReport')->name('product.getfinishedReport');
    });
    
    // Reports
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        //purchase report
        Route::get('purchase','ReportController@index')->name('purchase.index');
        Route::post('getReport','ReportController@getReport')->name('purchase.getReport');

        //processing report
        Route::get('processingReport','ReportController@processingReport')->name('product.processingReport');
        Route::post('getprocessingReport','ReportController@getprocessingReport')->name('product.getprocessingReport');

        //finished report
        Route::get('finishedReport','ReportController@finishedReport')->name('product.finishedReport');
        Route::post('getfinishedReport','ReportController@getfinishedReport')->name('product.getfinishedReport');
    });

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
