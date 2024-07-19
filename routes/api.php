<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    
    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/insertdata', [DashboardController::class, 'insertdata']);
    Route::get('/getdata', [DashboardController::class, 'getdata']);
    Route::post('/postdatavisit', [DashboardController::class, 'postdatavisit']);
    Route::get('/getdatavisit', [DashboardController::class, 'getdatavisit']);
    Route::get('/getuser', [DashboardController::class, 'getusername']);
});
