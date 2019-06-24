@extends('Jerry.Feecheck')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-xs-12 col-sm-12 col-md-8">
        <h4>Fee Records</h4>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
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