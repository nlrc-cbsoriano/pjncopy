<?php

namespace App\Services;

use OpenAI\Client;

class OpenAiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'api_key' => env('OPENAI_API_KEY'),
        ]);
    }

    public function generateText($prompt)
    {
        $response = $this->client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 150,
        ]);

        return $response->getChoices()[0]['text'];
    }
}
