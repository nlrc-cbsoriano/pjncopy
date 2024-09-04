<!-- resources/views/generate-content.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Content</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Generate Content Using Azure OpenAI</h1>

        <form action="{{ url('/generate-content') }}" method="GET">
            <div class="form-group">
                <label for="prompt">Prompt:</label>
                <input type="text" name="prompt" id="prompt" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>

        @if(isset($content))
            <h2>Generated Content</h2>
            <pre>{{ $content }}</pre>
        @endif
    </div>
</body>
</html>
