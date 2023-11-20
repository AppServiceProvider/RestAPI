<?php

use App\Http\Controllers\Api\{RegisterController, ProductController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

// Route::group(['middleware'=>'auth:santum'], function () {

//     Route::resource('products', ProductController::class);

// });

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
    Route::get('logout',[RegisterController::class,'logout']);

});

Route::fallback(function () {
    return response()->json(['message' => 'Route not found.'], 404);
});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
