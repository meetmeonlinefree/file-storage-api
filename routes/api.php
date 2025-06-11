<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;


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

Route::post('/upload/file', [FileController::class, 'uploadFile']);
Route::post('/upload/base64', [FileController::class, 'uploadBase64']);
Route::get('/file/{code}', [FileController::class, 'getFileByUniqueId']);
Route::get('/file/id/{id}', [FileController::class, 'getFileById']);
Route::get('/files', [FileController::class, 'getFiles']);