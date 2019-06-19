<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>Add Car</title>
</head>

<body>
    @include('helpers.navbar')
    <div class="row">
        <div class="col-6">
            <div class="lead">Add Car</div>
            <form action="/newCar" method="post">
                <div class="form-group">
                    <input type="text" name="make" id="make" placeholder="Make" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="model" id="model" placeholder="Model" class="form-control">
                </div>
                <div class="form-group">
                    <input type="date" name="produced_on" id="produced_on" class="form-control">
                </div>
            </form>
        </div>
    </div>
</body>

</html>