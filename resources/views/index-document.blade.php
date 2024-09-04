<!-- resources/views/index-document.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Index a Document to Azure Cognitive Search</h1>

        <form action="{{ url('/index-document') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Index Document</button>
        </form>

        @if(isset($response))
            <h2>Response</h2>
            <pre>{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
</body>
</html>
