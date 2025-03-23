<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SousCategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationSessionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('sousCategories', SousCategorieController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('formations', FormationController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('formationSessions', FormationSessionController::class);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'users'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refreshToken', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::get('users/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.adresseMail');

Route::get('/categories/{categorieID}/sousCategories', [CategorieController::class, 'getSousCategories']);

Route::get('/sousCategories/{sousCategorieID}/formations', [SousCategorieController::class, 'getFormations']);

Route::get('/formations/{formationID}/formationSessions', [FormationController::class, 'getFormationSessions']);