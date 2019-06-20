@extends('Amos.Feecheck')
 
@section('content')
	@if(count($fees) > 0)
		<h2>Search Results</h2>
		@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2 class="page-header text-center">Student AMS</h2>
		<h4>Fee Records</h4>
		<table class="table table-bordered table-striped">
			<thead>
				
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
		<h2>No Results Found</h2>
	@endif
@endsection