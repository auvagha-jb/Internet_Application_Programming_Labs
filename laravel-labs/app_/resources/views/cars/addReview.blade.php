<div class="lead">Add Car</div>
<form action="/addReview" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" name="car_id" id="car_id" placeholder="car_id" class="form-control">
        @if ($errors->has('car_id'))
        <span class="text-danger">{{ $errors->first('car_id')}}</span>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="review" id="review" placeholder="review" class="form-control">
        @if ($errors->has('review'))
        <span class="text-danger">{{ $errors->first('review')}}</span>
        @endif
    </div>
    <button class="btn btn-primary">Save</button>
</form>