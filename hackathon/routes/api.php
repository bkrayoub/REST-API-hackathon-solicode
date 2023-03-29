<?php

use App\Http\Controllers\ParticipantController;
use App\Models\Participants;
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
Route::get('/select', [ParticipantController::class, 'select']);

Route::get('/orderById', [ParticipantController::class, 'orderById']);

Route::post('/insert', [ParticipantController::class, 'insert']);

Route::get('/edit/{id}', [ParticipantController::class, 'edit']);

Route::post('/update/{id}', [ParticipantController::class, 'update']);

Route::get('/selectIdea', [ParticipantController::class, 'selectIdea']);

Route::post('/validate/{id}', [ParticipantController::class, 'validateIdea']);

Route::get('/selectAccepted', [ParticipantController::class, 'selectAccepted']);

Route::get('/countAccepted', [ParticipantController::class, 'countAccepted']);

Route::post('/deleteRefuesd', [ParticipantController::class, 'deleteRefuesd']);