<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Feesearch</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
@include('Amos.navbar')
	 	<form  style="margin-left: 400px; width: 300px;" action="{{ URL::to('find') }}" method="POST">
		      		{{ csrf_field() }}
		        	<div  class="input-group">
		          		<input type="text" id="search" name="search" class="form-control" placeholder="Search Student">
		          		<span class="input-group-btn">
	                  		<button  type="submit" class="btn btn-default">
	                   		<span class="glyphicon glyphicon-search"></span>
	                   		</button>
	                	</span>
		        	</div>
		      	</form> 
 
<div id="result" class="panel panel-default" style="width:400px; position:absolute; left:180px; top:55px; z-index:1; display:none">
	<ul style="margin-top:10px; list-style-type:none;" id="memList">
 
	</ul>
</div>
<div class="container">
	@yield('content')
 
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
 
		$('#search').keyup(function(){
			var search = $('#search').val();
			if(search==""){
				$("#feeList").html("");
				$('#result').hide();
			}
			else{
				$.get("{{ URL::to('search') }}",{search:search}, function(data){
					$('#feeList').empty().html(data);
					$('#result').show();
				})
			}
		});
	});
</script>
</body>
</html>