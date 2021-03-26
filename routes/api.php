<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChannelController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\API\VideoController;
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

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', [StatsController::class, 'index']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/{id}', [CountryController::class, 'show']);
});

Route::group(['prefix' => 'channels'], function () {
    Route::get('/', [ChannelController::class, 'index']);
    Route::get('/{id}', [ChannelController::class, 'show']);
});

Route::group(['prefix' => 'videos'], function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::get('/{id}', [VideoController::class, 'show']);
});
