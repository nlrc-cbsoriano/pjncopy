<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/chatbot', [ChatbotController::class, 'sendMessage']);
Route::post('/chatbot/upload', [ChatbotController::class, 'uploadFile']);
// Route::post('/chatbot/getresponse', [OpenAIController::class, 'getResponse']);