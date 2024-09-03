
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Employees</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Search Employees by Email</h1>

        <form action="{{ url('/employee/search') }}" method="GET">
            <div class="form-group">
                <label for="query">Search:</label>
                <input type="text" id="query" name="query" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

    </div>

</body>
</html>
