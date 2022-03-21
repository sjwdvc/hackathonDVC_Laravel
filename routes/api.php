<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::post('/user/login', [UserController::class, 'login'])->name('api.login');
    Route::post('/user/create', [UserController::class, 'store'])->name('api.storeUser');
    Route::get('/user/', [UserController::class, 'index'])->name('api.userIndex');
    Route::post('/user/show', [UserController::class, 'show'])->name('api.userShow');

    Route::get('/course/', [CourseController::class, 'index'])->name('api.courseIndex');
    Route::get('/course/{course}/users', [CourseController::class, 'getCourseUsers'])->name('api.courseUsersIndex');
    Route::post('/course/{course}/addUser', [CourseController::class, 'addUser'])->name('api.courseAddUser');
    Route::post('/course/{course}/markUserPresent', [CourseController::class, 'markUserPresent'])->name('api.courseMarkUserPresent');

//    Route::post();
});
