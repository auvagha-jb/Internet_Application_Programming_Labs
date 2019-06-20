<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
      

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    
     <ul class="nav navbar-nav navbar-left">
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ url('/') }}">Home</a></li>
       <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('student') }}">Register</a></li>
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('fees') }}">Fee Deposit</a></li>
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('paid') }}">Payments</a></li>
      


  
</div>
    </div>
</nav>
	<h2 align="center">Welcome to Student AMS</h2>
<div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success')}}
        @php
        Session::forget('success');
        @endphp
    </div>
    @endif
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-6 col-md-7 col-sm-offset-2 col-md-offset-3">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title" align="center" style="font-size: 20px;">Registration Form</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" accept="/studentcreate">
                            {{ csrf_field() }}
			    			<br><div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input style="font-size: 16px;" type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                            @if ($errors->has('first_name'))<span class="text-danger">{{ $errors->first('first_name')}}</span>
                            @endif
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input style="font-size: 16px;" type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
                                          @if ($errors->has('last_name'))<span class="text-danger">{{ $errors->first('last_name')}}</span>
                            @endif
			    					</div>
			    				</div>
			    			</div>

			    			<br><div class="form-group">
			    				<input style="font-size: 16px;" type="text" name="student_no" id="student_no" class="form-control input-sm" placeholder="Student Number">
                                  @if ($errors->has('student_no'))<span class="text-danger">{{ $errors->first('student_no')}}</span>
                            @endif
			    			</div>

			    				
			    					<br><div class="form-group">
                                        <label>Date of Birth</label>
			    						<input style="font-size: 16px;" type="Date" name="date_of_birth" id="date_of_birth" class="form-control input-sm" placeholder="Date of Birth">
                                          @if ($errors->has('date_of_birth'))<span class="text-danger">{{ $errors->first('date_of_birth')}}</span>
                            @endif
			    					</div>
			    				
			    		
			    					<br><div class="form-group">
			    						<input style="font-size: 16px;" type="text"  name="address" id="address" class="form-control input-sm" placeholder="Your Address">
                                          @if ($errors->has('address'))<span class="text-danger">{{ $errors->first('address')}}</span>
                            @endif
			    					</div>
			    				
			    			
			    			
			    			<br><input type="submit" style="font-size: 18px;" value="Register" class="btn btn-info btn-block">

			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>