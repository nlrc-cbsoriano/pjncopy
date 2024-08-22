<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message', '');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AZURE_OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(env('AZURE_OPENAI_ENDPOINT') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT_NAME') . '/completions', [
            'api-version' => env('AZURE_OPENAI_API_VERSION'),
            'prompt' => $message,
            'temperature' => 0,
            'max_tokens' => 60,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'best_of' => 1,
            'stop' => null,
        ]);

        // Log and inspect the response for debugging
        $responseBody = $response->json();
        \Log::info('Azure OpenAI Response: ' . print_r($responseBody, true));

        // Ensure response contains the text
        $reply = $responseBody['choices'][0]['text'] ?? 'No response';
        return response()->json(['text' => $reply]);
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Process the file as needed, e.g., store it, analyze it, etc.

            // For the sake of example, let's assume you just want to respond with a success message
            return response()->json(['text' => 'File uploaded successfully: ' . $file->getClientOriginalName()]);
        }

        return response()->json(['text' => 'No file uploaded'], 400);
    }
}


