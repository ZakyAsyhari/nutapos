<?php

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


Route::get('nutapos/soal4/', 'App\Http\Controllers\Api\NutaposController@soal4');
Route::get('nutapos/soal5/', 'App\Http\Controllers\Api\NutaposController@soal5');
Route::get('nutapos/soal6/', 'App\Http\Controllers\Api\NutaposController@soal6');