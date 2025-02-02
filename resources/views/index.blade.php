<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sync</title>
</head>
<body>
    <h1>Sync Data from Server</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('sync-data') }}" method="GET">
        <button type="submit">Sync Data</button>
    </form>
</body>
</html>
