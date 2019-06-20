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
    <div class="row pt-3">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="lead">Add Car</div>
            <form action="/cars" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="make" id="make" placeholder="Make" class="form-control">
                    @if ($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="model" id="model" placeholder="Model" class="form-control">
                    @if ($errors->has('model'))
                    <span class="text-danger">{{ $errors->first('model')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="date" name="produced_on" id="produced_on" class="form-control">
                    @if ($errors->has('produced_on'))
                    <span class="text-danger">{{ $errors->first('produced_on')}}</span>
                    @endif
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
</body>

</html>