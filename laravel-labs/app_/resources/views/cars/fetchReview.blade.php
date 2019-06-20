<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>All cars</title>
</head>

<body>
    @include('helpers.navbar')

    <div class="row pt-3">
        <div class="col-3"></div>
        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Car id</td>
                        <td>Review</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr>
                        <td>{{$review->id}}</td>
                        <td>{{$review->review}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="/review/details/1">See more</a>
        </div>
    </div>
</body>

</html>