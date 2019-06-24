<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    @include('links')
</head>

<body>
    @include('Jerry.navbar')

    @if(count($students) > 0)
    <div class="row p-3">
        <div class="col-md-2"></div>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <center class="lead">
                <h2>Students</h2>
            </center>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$student->student_no}}</td>
                        <td>{{$student->first_name." ".$student->last_name}}</td>
                        <td>{{$student->date_of_birth}}</td>
                        <td>{{$student->address}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <center class="lead">No students registered</center>
    @endif

</body>

</html>