<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/Register', [UserController::class, 'register']);
Route::post('/Login', [UserController::class, 'login']);
Route::get('/getList', [UserController::class, 'getPageOfFeedbacks']);
Route::post('/addFeedback', [UserController::class, 'addFeedback']);
Route::delete('/deleteFeedback', [UserController::class, 'deleteFeedback']);
Route::put('/updateFeedback', [UserController::class, 'updateFeedback']);