<?php

use App\Http\Actions\AddPointAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
Route::put('/customers/add_point', AddPointAction::class);
Route::post('/send-email', function (Request $request) {
    $mail = new App\Mail\Sample();
    Mail::to($request->get('to'))->send($mail);
    return response()->json('ok');
});
