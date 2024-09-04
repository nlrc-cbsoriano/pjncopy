<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AzureSearchService
{
    protected $endpoint;
    protected $apiKey;
    protected $index;

    public function __construct()
    {
        $this->endpoint = env('AZURE_SEARCH_ENDPOINT');
        $this->apiKey = env('AZURE_SEARCH_KEY');
        $this->index = env('AZURE_SEARCH_INDEX');
    }

    public function search($query)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get($this->endpoint . "/indexes/{$this->index}/docs", [
            'search' => $query,
        ]);

        return $response->json();
    }

    public function indexDocument($document)
    {
        $response = Http::withHeaders([
            'api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->endpoint . "/indexes/{$this->index}/docs/index?api-version=2021-04-30-Preview", [
            'value' => [$document],
        ]);

        return $response->json();
    }
}
