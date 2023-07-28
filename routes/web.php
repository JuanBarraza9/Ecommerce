<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AttributesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::post('/user/update', [UserController::class, 'userUpdatePassword'])->name('user.update.password');
}); // Group middleware

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//* Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');
});

//* Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'vendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');

    Route::get('/vendor/change/password', [VendorController::class, 'vendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'vendorUpdatePassword'])->name('vendor.update.password');
});

// Route public login
// admin
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

// vendor
Route::get('/become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::get('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login');
Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');

// admin middleware //
Route::middleware(['auth', 'role:admin'])->group(function(){
    // access brand
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand', 'allBrand')->name('all.brand');
        Route::get('/add/brand', 'addBrand')->name('add.brand');
        Route::post('/add/brand', 'storeBrand')->name('brand.store');
        Route::get('/edit/brand/{id}', 'editBrand')->name('edit.brand');
        Route::post('/update/brand', 'updateBrand')->name('brand.update');
        Route::get('/delete/brand/{id}', 'deleteBrand')->name('delete.brand');

    });


    // access category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/add/category', 'storeCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');

    });


    // access Subcategory
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/subcategory', 'allSubcategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'addSubcategory')->name('add.subcategory');
        Route::post('/add/subcategory', 'storeSubcategory')->name('subcategory.store');
        Route::get('/edit/subcategory/{id}', 'editSubcategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'updateSubcategory')->name('subcategory.update');
        Route::get('/delete/subcategory/{id}', 'deleteSubcategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}', 'getSubCategory');

    });


    // access Attributes
    Route::controller(AttributesController::class)->group(function(){
        // size
        Route::get('/all/attributes/sizes', 'allAttributesSizes')->name('all.sizes');
        Route::get('/add/attribute/size', 'addAttributeSize')->name('add.size');
        Route::post('/add/attribute/size', 'storeSize')->name('size.store');
        Route::get('/delete/size/{id}', 'deleteSize')->name('delete.size');
        // color
        Route::get('/all/attributes/colors', 'allAttributesColors')->name('all.colors');
        Route::get('/add/attribute/color', 'addAttributeColor')->name('add.color');
        Route::post('/add/attribute/color', 'storeColor')->name('color.store');
        Route::get('/delete/color/{id}', 'deleteColor')->name('delete.color');
        // gender

    });


    // access product
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'allProduct')->name('all.product');
        Route::get('/add/product', 'addProduct')->name('add.product');
        Route::post('/add/product', 'storeProduct')->name('product.store');

    });


    // access + elements
    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor', 'inactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'activeVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'activeVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'activeVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'inactiveVendorApprove')->name('inactive.vendor.approve');
 
    });



});
// end middleware admin
