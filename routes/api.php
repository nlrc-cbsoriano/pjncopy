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


use App\Http\Controllers\ExampleController;


Route::get('/generate-content', [ExampleController::class, 'showGenerateContentForm']);
Route::get('/generate-content', [ExampleController::class, 'generateContent'])->name('generate.content');

Route::get('/search-documents', [ExampleController::class, 'showSearchDocumentsForm']);
Route::get('/search-documents', [ExampleController::class, 'searchDocuments'])->name('search.documents');

Route::get('/index-document', [ExampleController::class, 'showIndexDocumentForm']);
Route::post('/index-document', [ExampleController::class, 'indexDocument'])->name('index.document');
