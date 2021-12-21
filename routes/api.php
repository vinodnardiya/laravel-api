<?php

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

Route::post('/user/signup', [App\Http\Controllers\Api\V1\UsersController::class, 'createUser']);
Route::get('/users', [App\Http\Controllers\Api\V1\UsersController::class, 'listUsers']);
Route::post('/user/login', [App\Http\Controllers\Api\V1\UsersController::class, 'UserLogin']);

Route::post('/loan/create', [App\Http\Controllers\Api\V1\LoanController::class, 'create']);
Route::patch('/loan/{id}', [App\Http\Controllers\Api\V1\LoanController::class, 'update']);
Route::get('/loan/{id}', [App\Http\Controllers\Api\V1\LoanController::class, 'getProjectDetails']);
Route::delete('/loan/{id}', [App\Http\Controllers\Api\V1\LoanController::class, 'delete']);
Route::get('/loans', [App\Http\Controllers\Api\V1\LoanController::class, 'index']);

Route::post('/insurance/create', [App\Http\Controllers\Api\V1\InsuranceController::class, 'create']);
Route::patch('/insurance/{id}', [App\Http\Controllers\Api\V1\InsuranceController::class, 'update']);
Route::get('/insurance/{id}', [App\Http\Controllers\Api\V1\InsuranceController::class, 'getProjectDetails']);
Route::delete('/insurance/{id}', [App\Http\Controllers\Api\V1\InsuranceController::class, 'delete']);
Route::get('/insurances', [App\Http\Controllers\Api\V1\InsuranceController::class, 'index']);

Route::post('/transaction/create', [App\Http\Controllers\Api\V1\TransactionController::class, 'create']);
Route::patch('/transaction/{id}', [App\Http\Controllers\Api\V1\TransactionController::class, 'update']);
Route::get('/transaction/{id}', [App\Http\Controllers\Api\V1\TransactionController::class, 'getProjectDetails']);
Route::delete('/transaction/{id}', [App\Http\Controllers\Api\V1\TransactionController::class, 'delete']);
Route::get('/transactions', [App\Http\Controllers\Api\V1\TransactionController::class, 'index']);
