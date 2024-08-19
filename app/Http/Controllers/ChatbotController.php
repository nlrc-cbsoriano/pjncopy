<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // $endpoint = env('AZURE_OPENAI_ENDPOINT');
        // $deploymentName = 'pjnchatbot_deployment'; // Use the name you set in the deployment
        // $apiVersion = '0613'; // Ensure this is the correct version
        // $url = "{$endpoint}/openai/deployments/{$deploymentName}/completions?api-version={$apiVersion}";

        // Call Azure OpenAI API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AZURE_OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(env('AZURE_OPENAI_ENDPOINT') . '/openai/deployments/' . env('AZURE_OPENAI_DEPLOYMENT_NAME') . '/completions', [
            'prompt' => $message,
            'max_tokens' => 100,
        ]);

        // Log and inspect the response for debugging
        $responseBody = $response->json();
        \Log::info('Azure OpenAI Response: ' . print_r($responseBody, true));

        // Ensure response contains the text
        $reply = $responseBody['choices'][0]['text'] ?? 'No response';
        return response()->json(['text' => $reply]);
    }

    public function getResponse(Request $request)
    {
        $endpoint = env('AZURE_OPENAI_ENDPOINT');
        $apiVersion = "2024-05-01-preview";
        $deploymentName = env('AZURE_OPENAI_DEPLOYMENT_NAME');
        $apiKey = env('AZURE_OPENAI_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$endpoint}/openai/deployments/{$deploymentName}/chat/completions?api-version={$apiVersion}", [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->input('message'),
                ]
            ],
            'max_tokens' => 800,
            'temperature' => 0.7,
            'top_p' => 0.95,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'stop' => null,
            'stream' => false,
        ]);

        return response()->json($response->json());
    }

}
