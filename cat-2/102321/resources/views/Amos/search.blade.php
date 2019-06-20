@extends('Amos.Feecheck')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 class="page-header text-center">Student AMS</h2>
        <h4>Fee Records</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Student Number</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach($fees as $fee)
                <tr>
                    <td>{{$fee->student_no}}</td>
                    <td>{{$fee->amount}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="font-size: 18px;"><strong>Total</strong></td>
                    <td style="font-size: 18px;"><b>{{$total}}</b></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
@endsection