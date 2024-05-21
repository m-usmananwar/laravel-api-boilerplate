<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware(["guest"])->group(function () {
    Route::post("/signin", [AuthController::class, "signIn"]);
    Route::post("/signup", [AuthController::class, "signUp"]);
});

Route::middleware(["auth:sanctum"])->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
});
