<?php

namespace App\Services;

// use OpenAI\Client;

// class OpenAiService
// {
//     protected $client;

//     public function __construct()
//     {
//         $this->client = new Client([
//             'api_key' => env('OPENAI_API_KEY'),
//         ]);
//     }

//     public function generateText($prompt)
//     {
//         $response = $this->client->completions()->create([
//             'model' => 'text-davinci-003',
//             'prompt' => $prompt,
//             'max_tokens' => 150,
//         ]);

//         return $response->getChoices()[0]['text'];
//     }
// }


use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $endpoint;
    protected $apiKey;
    protected $deploymentName;
    protected $apiVersion;

    public function __construct()
    {
        $this->endpoint = env('AZURE_OAI_ENDPOINT');
        $this->apiKey = env('AZURE_OAI_KEY');
        $this->deploymentName = env('AZURE_OAI_DEPLOYMENT');
        $this->apiVersion = env('AZURE_OAI_API_VERSION');
    }

    public function generateText($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->endpoint . '/openai/deployments/'.$this->deploymentName.'/completions?api-version='.$this->apiVersion, [
            'prompt' => $prompt,
            'max_tokens' => 50,
        ]);

        return $response->json();
    }
}
