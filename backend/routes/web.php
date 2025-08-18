<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/BackRegister', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/BackGetPageOfFeedbacks', [UserController::class, 'getPageOfFeedbacks']);
Route::post('/BackAddFeedback', [UserController::class, 'addFeedback']);
Route::delete('/BackDeleteFeedback', [UserController::class, 'deleteFeedback']);
Route::put('/BackUpdateFeedback', [UserController::class, 'updateFeedback']);
Route::get('/BackGetLogins', [UserController::class, 'getLogins']);
Route::get('/BackGetProjects', [UserController::class, 'getProjects']);
Route::get('/isAuth', [UserController::class, 'isAuth']);
Route::get('/logout', [UserController::class, 'logout']);


Route::fallback(function () {
    return response(null, 404);
});