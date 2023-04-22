<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix("user") -> group( function () {
    Route::get("all", [UserController::class, "all_users"]);
    Route::post("login", [UserController::class, "login"]);
    Route::post("registration", [UserController::class, "registration"]);

});
Route::prefix("note") -> group( function () {
    Route::post("create", [NoteController::class, "create_note"]);
    Route::post("show/notes", [NoteController::class, "show_notes"]);
});
