@extends('Jerry.Feecheck')

@section('content')
@if(count($fees) > 0)
<h2>Search Results</h2>
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-xs-12 col-sm-12 col-md-8">
        <h4>Fee Records</h4>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <th>Student Number</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </thead>
            <tbody>
                @foreach($fees as $fee)
                <tr>
                    <td>{{$fee->student_no}}</td>
                    <td>{{$fee->amount}}</td>
                    <td>{{$fee->paid_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@else
<center class="lead">No search results found</center>
@endif
@endsection