@if(count($fees) > 0)
	@foreach($fees as $fee)
		<li>{{ url('find/'.$fee->id) }} {{ $fee->student_no }} {{ $fee->amount }} {{$fee->paid_at}}</li>
	@endforeach
@else
	<li style="text-align: center;">No Results Found</li>
@endif