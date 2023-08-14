<?php

use App\Http\Controllers\api\LaundryController;
use App\Http\Controllers\api\ManageUserController;
use App\Http\Controllers\api\PromoController;
use App\Http\Controllers\api\ShopController;
use App\Http\Controllers\api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/promos', [PromoController::class, 'readAll']);
Route::get('/shops', [ShopController::class, 'readAll']);
Route::get('/laundries', [LaundryController::class, 'readAll']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/laundries/user', [LaundryController::class, 'readByUserId']);
    Route::post('/laundries/claim', [LaundryController::class, 'claim']);

    Route::get('/promos/limit', [PromoController::class, 'readLimit']);
    Route::get('/promos/shop/{shopId}', [PromoController::class, 'readByShopId']);

    Route::get('/shops/recommendation/limit', [ShopController::class, 'readRecommendationLimit']);
    Route::get('/shops/search/city/{city}', [ShopController::class, 'searchByCity']);

    Route::apiResource('/cms/users', ManageUserController::class);
    Route::apiResource('/cms/shops', ShopController::class);
    Route::apiResource('/cms/promos', PromoController::class);
    Route::apiResource('/cms/laundries', LaundryController::class);
});
