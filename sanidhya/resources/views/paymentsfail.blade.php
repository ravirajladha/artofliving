<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Order Data</title>
</head>
<body>
    <h1>Fetch Order Data</h1>
    
    @if(isset($orderData))
        <h2>Fetched Order Data:</h2>
        <pre>{{ json_encode($orderData, JSON_PRETTY_PRINT) }}</pre>
    @elseif(isset($error))
        <h2>Error:</h2>
        <p>{{ $error }}</p>
    @endif

    <form method="POST" action="{{ route('fetch-order') }}">
        @csrf
        <label for="order_id">Order ID:</label>
        <input type="text" name="order_id" id="order_id" required>
        <button type="submit">Fetch Data</button>
    </form>
</body>
</html>
