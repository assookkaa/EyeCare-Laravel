<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Staff
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button type='submit'>logout</button>
    </form>
</body>
</html>