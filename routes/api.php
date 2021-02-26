<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/createitem', [ItemController::class, 'create']);
Route::post('/getitems', [ItemController::class, 'get']);
Route::post('/deleteitem', [ItemController::class, 'delete']);
Route::post('/edititem', [ItemController::class, 'update']);
Route::post('/updatestate', [ItemController::class, 'updatestate']);
Route::post('/search', [ItemController::class, 'search']);
Route::get('/generate',[ApiController::class,'generate']);

