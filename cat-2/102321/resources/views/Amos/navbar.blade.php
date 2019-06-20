
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
		    	 <ul class="nav navbar-nav navbar-left">
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ url('/') }}">Home</a></li>
       <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('student') }}">Register</a></li>
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('fees') }}">Fee Deposit</a></li>
        <li> <a style="text-decoration: none; font-size: 18px;" href="{{ route('paid') }}">Payments</a></li>
		      
		    </div>
	  </div>
	</nav>