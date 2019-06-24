<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('links')
    <title>Home page</title>

    <style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand btn btn-primary" href="#">AMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a style="text-decoration: none; font-size: 18px;" href="#" class="nav-link active">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">
        <div class="title m-b-md">
            Student AMS
        </div>


        <a href="{{ route('student')}}"><button style="text-align: center; font-size: 30px; margin-bottom: 70px;"
                type="button" class="btn btn-outline-dark">Register a Student</button></a><br>
        <a href="{{ route('fees')}}"><button style="text-align: center;font-size: 30px; margin-bottom: 0px;"
                type="button" class="btn btn-outline-dark">Make Fee Payment</button></a><br><br><br><br>
        <a href="{{ route('paid')}}"><button style="text-align: center;font-size: 30px;" type="button"
                class="btn btn-outline-dark">View payments</button></a>
        <a href="{{ url('all/students')}}"><button style="text-align: center;font-size: 30px;" type="button"
                class="btn btn-outline-dark">View students</button></a>
    </div>
    </div>
</body>

</html>