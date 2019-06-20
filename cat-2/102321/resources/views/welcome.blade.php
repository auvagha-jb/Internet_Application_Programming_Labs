<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home page</title>

      <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            html, body {
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

            .links > a {
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
      <nav class="navbar navbar-default">
        <div class="container-fluid">
        
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>
 
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                 
              
            </div>
      </div>
    </nav>

            <div class="content">
                <div class="title m-b-md">
                     Student AMS
                </div>
          
                   <a href="{{ route('student')}}"><button style="text-align: center; font-size: 30px; margin-bottom: 70px;" type="button" class="btn btn-default">Register a Student</button></a><br>
                   <a href="{{ route('fees')}}"><button style="text-align: center;font-size: 30px; margin-bottom: 0px;" type="button" class="btn btn-default">Make Fee Payment</button></a><br><br><br><br>
                     <a href="{{ route('paid')}}"><button style="text-align: center;font-size: 30px;" type="button" class="btn btn-default">Payments</button></a>
           </div>
        </div>
    </body>
</html>
