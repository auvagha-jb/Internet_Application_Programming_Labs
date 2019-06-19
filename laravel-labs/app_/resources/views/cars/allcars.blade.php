<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>All cars</title>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Car ID</td>
                <td>Make</td>
                <td>Model</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($cars as $car)
            <tr>{{$car->id}}</tr>
            <tr>{{$car->make}}</tr>
            <tr>{{$car->model}}</tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>