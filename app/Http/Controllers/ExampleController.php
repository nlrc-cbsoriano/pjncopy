<?php 
namespace App\Http\Controllers;

use App\Services\OpenAIService;
use App\Services\AzureSearchService;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected $openAI;
    protected $searchService;

    public function __construct(OpenAIService $openAI, AzureSearchService $searchService)
    {
        $this->openAI = $openAI;
        $this->searchService = $searchService;
    }

    public function showGenerateContentForm()
    {
        return view('generate-content');
    }

    public function generateContent(Request $request)
    {
        $prompt = $request->input('prompt');
        $response = $this->openAI->generateText($prompt);
        return view('generate-content', ['content' => $response['choices'][0]['text']]);
    }

    public function showSearchDocumentsForm()
    {
        return view('search-documents');
    }

    public function searchDocuments(Request $request)
    {
        $query = $request->input('query');
        $results = $this->searchService->search($query);
        return view('search-documents', ['results' => $results]);
    }

    public function showIndexDocumentForm()
    {
        return view('index-document');
    }

    public function indexDocument(Request $request)
    {
        $document = [
            'id' => uniqid(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        $response = $this->searchService->indexDocument($document);
        return view('index-document', ['response' => $response]);
    }
}
