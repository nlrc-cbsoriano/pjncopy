<!-- resources/views/search-documents.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Documents</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Search Documents Using Azure Cognitive Search</h1>

        <form action="{{ url('/search-documents') }}" method="GET">
            <div class="form-group">
                <label for="query">Search Query:</label>
                <input type="text" name="query" id="query" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @if(isset($results))
            <h2>Search Results</h2>
            @if(count($results) > 0)
                <ul>
                    @foreach($results['value'] as $result)
                        <li>{{ $result['title'] }}: {{ $result['content'] }}</li>
                    @endforeach
                </ul>
            @else
                <p>No results found.</p>
            @endif
        @endif
    </div>
</body>
</html>
