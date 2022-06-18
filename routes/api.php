<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shipment\ShipmentController;
use App\Http\Controllers\Shipment\ShipmentFileController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'import', 'as' => 'import.', 'middleware' => []], function() {    

    Route::post('/shipment/file', [ShipmentFileController::class,'uploadFile'])->name('shipment.file');

});

Route::group(['prefix' => 'shipment', 'as' => 'shipment.', 'middleware' => []], function() {    

    Route::get('/files', [ShipmentController::class,'getShipmentFiles'])->name('get.file');

});