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
    //system audits routes
    Route::get("/system-audits", [App\Http\Controllers\SystemAuditController::class, 'index'])->name("system-audits.index");
    Route::get("/print/transaction/{transaction}/receipt",[\App\Http\Controllers\TransactionController::class,'printReceipt'])->name("print.receipt");
    Route::get("/all/transactions",[\App\Http\Controllers\TransactionController::class,'index'])->name("all.transactions");
    Route::post("/transaction/store",[\App\Http\Controllers\TransactionController::class,'store'])->name("transaction.store");
    Route::get("/load/services/{provider}/provider/{branch?}",[\App\Http\Controllers\TransactionController::class,'loadServices'])->name("load.services.by.provider");
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
    //Branches Routes

    Route::get('/branches',[App\Http\Controllers\BranchController::class,'index'])->name('branches.index');
    Route::post("/branches/store", [App\Http\Controllers\BranchController::class, 'store'])->name("branches.store");
    Route::post("/branches/update/{branch_id}", [App\Http\Controllers\BranchController::class, 'update'])->name("branches.update");
    Route::get("/branches/delete/{branch_id}", [App\Http\Controllers\BranchController::class, 'deleteBranch'])->name("branches.delete");
    Route::get("/branches/users/{branch_id}", [App\Http\Controllers\BranchController::class, 'getBranchUsers'])->name("branches.users");

    // branches services routes
    Route::get("/branches/{branch}/services", [App\Http\Controllers\BranchController::class, 'getBranchServices'])->name("branches.services");
    Route::post("/branches/{branch}/services/store", [App\Http\Controllers\BranchController::class, 'storeBranchServices'])->name("branches.services.store");



    Route::get("/service-providers", [App\Http\Controllers\ServiceProviderController::class, 'index'])->name("providers.index");
    Route::post("/service-providers/store", [App\Http\Controllers\ServiceProviderController::class, 'store'])->name("providers.store");
    Route::post("/service-providers/update/{provider_id}", [App\Http\Controllers\ServiceProviderController::class, 'update'])->name("providers.update");
    Route::get("/service-providers/delete/{provider_id}", [App\Http\Controllers\ServiceProviderController::class, 'deleteProvider'])->name("providers.delete");

    //save representative info
    Route::post('/{serviceProvider}/representative/store', [App\Http\Controllers\ServiceProviderController::class, 'storeRepresentative'])->name('providers.representative.store');

    Route::get("/services", [App\Http\Controllers\ServiceController::class, 'index'])->name("services.index");
    Route::post("/services", [App\Http\Controllers\ServiceController::class, 'store'])->name("services.store");
    Route::post("/services/update/{service_id}", [App\Http\Controllers\ServiceController::class, 'update'])->name("services.update");
    Route::get("/services/delete/{service_id}", [App\Http\Controllers\ServiceController::class, 'delete'])->name("services.delete");

    Route::get("/service-charges", [App\Http\Controllers\ServiceChargesController::class, 'index'])->name("charges.index");
    Route::post("/service-charges/store", [App\Http\Controllers\ServiceChargesController::class, 'store'])->name("charges.store");
    Route::post("/service-charges/update/{charge_id}", [App\Http\Controllers\ServiceChargesController::class, 'update'])->name("charges.update");
    Route::get("/service-charges/delete/{charge_id}", [App\Http\Controllers\ServiceChargesController::class, 'deleteCharge'])->name("charges.delete");
    //set external branches percentage
    Route::post("/service-charges/set-external-branch-percentage", [App\Http\Controllers\ServiceChargesController::class, 'setExternalBranchPercentage'])->name("charges.set-external-branch-percentage");

    // top-up external branches
    Route::resource('branches.top-ups', App\Http\Controllers\BranchTopupController::class);

    //confirm top-up
    Route::get('/confirm-branch-top-ups/{top_up}', [\App\Http\Controllers\BranchTopupController::class, 'confirmBranchTopup'])->name('confirm-branch-top-ups');

    //reverse top-up
    Route::post('/reverse-branch-top-ups/{top_up}', [\App\Http\Controllers\BranchTopupController::class, 'reverseBranchTopup'])->name('reverse-branch-top-ups');

    //List branches top-ups
    Route::get('/branches/{branch}/top-ups', [\App\Http\Controllers\BranchTopupController::class, 'index'])->name('branches.top-ups.index');

    // top-up iposita
    Route::resource('iposita-topups', \App\Http\Controllers\IpositaTopupController::class);

    //confirm top-up
    Route::get('/confirm-iposita-top-ups/{top_up}', [\App\Http\Controllers\IpositaTopupController::class, 'confirmBranchTopup'])->name('confirm-iposita-top-ups');

    //iposita balance
    Route::get('/iposita-top-ups/balance', [\App\Http\Controllers\IpositaTopupController::class, 'getBalance'])->name('iposita-top-ups.balance');

    //system top-ups report
    Route::get('/system-top-ups/report', [\App\Http\Controllers\ReportController::class, 'systemTopUps'])->name('system-top-ups.report');

    //branch top-ups report
    Route::get('/branch-top-ups/report', [\App\Http\Controllers\ReportController::class, 'branchTopUps'])->name('branch-top-ups.report');

    //transactions report
    Route::get('/transactions/report', [\App\Http\Controllers\ReportController::class, 'transactions'])->name('transactions.report');
});

//check if branch has enough balance to make transaction
Route::post('/branches/check-balance', [App\Http\Controllers\BranchServiceBalanceController::class, 'checkBranchBalance'])->name('admin.branch.checkBalance');

Route::get('/districts/{province}', [App\Http\Controllers\DistrictController::class,'districtsByProvince']);
Route::get('/sectors/{sector}', [App\Http\Controllers\SectorController::class,'sectorsByDistrict']);
//get users by branches
Route::get('/branches/users', [App\Http\Controllers\BranchController::class,'usersByBranch'])->name('branches.users');

Auth::routes();
