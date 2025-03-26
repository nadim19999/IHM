<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SousCategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FormationSessionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReponseController;

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

Route::middleware('api')->group(function () {
    Route::resource('feedbacks', FeedbackController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('examens', ExamenController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('questions', QuestionController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('reponses', ReponseController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('cours', CourController::class);
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

Route::get('/formationSessions/{formationSessionID}/cours', [FormationSessionController::class, 'getCours']);

Route::get('/formationSessions/{formationSessionID}/candidats', [FormationSessionController::class, 'getCandidats']);

Route::get('/formationSessions/{formationSessionID}/feedbacks', [FormationSessionController::class, 'getFeedbacks']);

Route::get('/formationSessions/{formationSessionID}/examen', [FormationSessionController::class, 'getExamen']);

Route::get('/examens/{examenID}/questions', [ExamenController::class, 'getQuestions']);

Route::get('/questions/{questionID}/reponses', [QuestionController::class, 'getReponses']);

Route::post('/formationSessions/{sessionId}/register', [FormationSessionController::class, 'registerToSession'])->middleware('auth:api');

/*
Route::middleware('auth:api')->group(function () {
    Route::get('users/{id}', [AuthController::class, 'getUserByID']);
    Route::get('users/role/{role}', [AuthController::class, 'getUsersByRole']);
    Route::put('users/{id}', [AuthController::class, 'updateUser']);
    Route::post('users/{id}/block', [AuthController::class, 'blockUser']);
});
*/

Route::get('users/{id}', [AuthController::class, 'getUserByID']);
Route::get('users/role/{role}', [AuthController::class, 'getUsersByRole']);
Route::put('users/{id}', [AuthController::class, 'updateUser']);
Route::post('users/{id}/block', [AuthController::class, 'blockUser'])->middleware('auth:api');