<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserBuildController;
use App\Http\Controllers\Builds\buildDisplayControl;
use App\Http\Controllers\Builds\buildcompatability;
use App\Http\Controllers\Builds\ratingController;

use App\Http\Controllers\Admin\AdminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminControl\ActivityLogController;
use App\Http\Controllers\Admin\AdminControl\UserController;
use App\Http\Controllers\Admin\AdminControl\BuildController;


//  Route for the guest home
Route::get('/', function () {
    return view('guest');
}) ->name('guest');

// Route for the guest home
Route::get('/guest', function () {
    return view('guest');
}) ->name('guest');





//LOGIN SIDE

// Route for the login
Route::get('/login', function () {
    return view('login');
}) ->name('login');

// Route for the login post action
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');




//REGISTRATION SIDE

//  Route for the registration
Route::get('/register', function () {
    return view('register'); })->name('register');

// Route for the registration post action
Route::post('/register', [AuthManager::class, 'registrationPost'])->name('registration.post');








//USER LOGOUT
// Route for the logout
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');



//USER SIDE
// Route for the user home
Route::get('/home', function () {
    return view('user.userhome');
}) ->name('userhome');



// Route to load the user build
Route::get('/Yourbuilds', [UserBuildController::class, 'ShowUserBuild'])
    ->middleware('auth')
    ->name('userbuild');


// Route to load the user profile view
Route::get('/profile', [ProfileController::class, 'userprofile_view'])
    ->middleware('auth')
    ->name('user.userprofile');

// Route to handle the update of the user's profile
 Route::post('/profile/update', [ProfileController::class, 'update_user_profile'])
    ->middleware('auth')
    ->name('profile.update');








Route::prefix('builds')->group(function () {

    // Route to show the build
    Route::get('/{tag?}', [buildDisplayControl::class, 'DisplayBuild'])  ->middleware('auth')->name('builds.display');

    // Route to load information about the build
    Route::get('/buildinfo/{id}', [buildDisplayControl::class, 'getbuildinfo'])  ->middleware('auth')->name('build.info');

    // Route to load user build view
    Route::get('/userbuildinfo/{id}', [UserBuildController::class, 'getuserbuildsinfo'])  ->middleware('auth')->name('userbuilds.info');

    // Route to update user build
    Route::put('/update/{id}', [UserBuildController::class, 'update'])->name('builds.update');

    // Route to load delete user build view
    Route::delete('/{id}', [UserBuildController::class, 'deleteBuild'])->middleware('auth')->name('build.delete');

    // Route to rate a build
    Route::post('/rate-build', [ratingController::class, 'store'])->name('rate.build')->middleware('auth');



});


Route::prefix('admin')->group(function () {

        // Route to show the admin dashboard
        Route::get('/login', function () {
            return view('admin.login'); // Show login form
        })->name('admin.login');

        // Route for admin login POST request
        Route::post('/login', [AdminAuth::class, 'adminloginPost'])->name('admin.login.post');

        // Admin logout route
        Route::post('/logout', [AdminAuth::class, 'adminLogout'])->name('admin.logout');

        //
        Route::post('/reg', [AdminAuth::class, 'createAdmin'])->name('admin.register');

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/home', [AdminController::class, 'showDashboard'])
            ->name('admindashboard');

        // Activity log routes
        Route::get('/activity-logs', [ActivityLogController::class, 'fetchActivityLogs'])->name('admin.activity.logs');
        Route::get('/user-activity/{id}', [ActivityLogController::class, 'fetchUserActivityLogs'])->name('admin.fetch.users.activity');

        // User routes
        Route::get('/users', [UserController::class, 'fetchUsers'])->name('admin.fetch.users');

        Route::get('/users/{id}', [UserController::class, 'showUserInfo']);

        // Build routes
        Route::get('/builds', [BuildController::class, 'getRecommendedBuild']);

        // User build routes
        Route::get('/user-builds', [BuildController::class, 'getUserBuild']);

        // Build count
        Route::get('/build-counts', [BuildController::class, 'fetchBuildCount'])->name('admin.build.count');

        // delete build
        Route::delete('/builds/{id}', [BuildController::class, 'destroy'])->name('builds.destroy');

        Route::post('/builds/store', [BuildController::class, 'store'])->name('builds.store');

        Route::get('/get-compatible-parts/{motherboardId}', [BuildController::class, 'getCompatibleParts']);
    });
});





// Delete route
Route::delete('/component/{type}/{id}/delete', [BuildController::class, 'delete'])->name('component.delete');

Route::post('/get-component-data', [BuildController::class, 'getComponentData']);



Route::prefix('/api')->group(function () {

    // Fetch CPUs compatible with the selected motherboard
    Route::get('/compatible-cpus/{motherboardId}', [buildcompatability::class, 'getCompatibleCpus']);

    // Fetch all GPUs compatible with the motherboard
    Route::get('/compatible-gpus/{motherboardId}', [buildcompatability::class, 'getCompatibleGpus']);

    // Fetch all RAMs compatible with the motherboard
    Route::get('/compatible-rams/{motherboardId}', [buildcompatability::class, 'getCompatibleRams']);

    // Fetch all Storage devices compatible with the motherboard
    Route::get('/compatible-storages/{motherboardId}', [buildcompatability::class, 'getCompatibleStorages']);

    // Fetch all Computer Cases compatible with the motherboard and GPU length
    Route::get('/compatible-cases/{motherboardId}/{gpuId}', [buildcompatability::class, 'getCompatibleCases']);
    Route::get('/component-tdp/{componentType}/{componentId}', [buildcompatability::class, 'getComponentTDP']);
});
