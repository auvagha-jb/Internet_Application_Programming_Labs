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
        <div class="col-6">
            @include('cars.addReview')
        </div>
        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Make</td>
                        <td>Model</td>
                        <td>Review</td>
                        <td>View</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr>
                        <td>{{$review->make}}</td>
                        <td>{{$review->model}}</td>
                        <td>{{$review->review}}</td>
                        <td><a href="{{ url('review/details', $review->car_id) }}" class="btn btn-sm">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>