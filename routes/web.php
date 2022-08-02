<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\DashboardController::class,'index'])->name("admin.dashboard")->middleware("auth");

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name("dashboard");
    //user mngmt
    Route::prefix('user-management')->group(function () {
        //permission routes
        Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions/update/{permission_id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
        Route::post('/permissions/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        //
        Route::get('/permissions/add-permission-to-user/{user_id}', [App\Http\Controllers\PermissionController::class, 'addPermissionToUser'])->name('user.add.permissions');
        Route::post('/permissions/add-permissions-to-user/store', [App\Http\Controllers\PermissionController::class, 'storePermissionToUser'])->name('permissions_to_user.store');

        //users routes
        Route::get("/users", [App\Http\Controllers\UserController::class, 'index'])->name("users.index");
        Route::post("/users/store", [App\Http\Controllers\UserController::class, 'store'])->name("users.store");
        Route::post("/users/update/{user_id}", [App\Http\Controllers\UserController::class, 'update'])->name("users.update");
        Route::get("/users/profile/{user_id}", [App\Http\Controllers\UserController::class, 'userProfile'])->name("users.profile");

        //disable user
        Route::post("/users/disable/{user_id}", [App\Http\Controllers\UserController::class, 'disableUser'])->name("users.disable");
        //show user flow history
        Route::get("/users/flow-history/{user_id}", [App\Http\Controllers\UserController::class, 'showUserFlowHistory'])->name("users.flow.history");

        //Profile URL
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update.profile');

        //Reset user password
        Route::get('/users/reset-password/{user_id}', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset.password');
        Route::get('/users/change-password', [App\Http\Controllers\ProfileController::class, 'changePasswordForm'])->name('user.change.password');
        Route::post('/users/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('user.update.password');

    });
    //system audits routes
    Route::get("/system-audits", [App\Http\Controllers\SystemAuditController::class, 'index'])->name("system-audits.index");

    //Property Types routes
    Route::resource('property-types', \App\Http\Controllers\PropertyTypeController::class);
    Route::resource('property-items', \App\Http\Controllers\PropertyItemController::class);
    //property item history routes
    Route::get('/property-items/history/{property_item_id}', [App\Http\Controllers\PropertyItemController::class, 'showPropertyItemHistory'])->name('property-items.history');

    //Route expropriation
    Route::resource('expropriations', \App\Http\Controllers\ExpropriationController::class);
    //Route expropriation submit route
    Route::get('/expropriations/{expropriation}/submit', [App\Http\Controllers\ExpropriationController::class, 'submit'])->name('expropriations.submit');
    //review user request
    Route::post('{expropriation}/review', [App\Http\Controllers\ExpropriationController::class, 'review'])->name('expropriations.review');

});

//ajax requests
Route::get('districts/{province}', [\App\Http\Controllers\LocalityController::class,'districtsByProvince']);
Route::get('sectors/{district}', [\App\Http\Controllers\LocalityController::class,'sectorsByDistrict']);
Route::get('cells/{sector}', [\App\Http\Controllers\LocalityController::class,'cellsBySector']);

Auth::routes();
