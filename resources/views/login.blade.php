<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{ mix('/assets/login.css') }}">
</head>
<body>
	<div class="wrapper">
	  <div class="container">
	    <h1>Welcome</h1>
	    
	    <form class="form" method="post" id="form-login">
	      <div class="message">
	      </div>
	      @csrf
	      <div class="form-group">
	      	@if(count($errors) > 0)
	      		@foreach($errors->all() as $error)
	      			<div class="message">{{$error}}</div>
	      		@endforeach
	      	@endif
	      	<input type="text" class="form-control" placeholder="Username" name="email">
	      </div>
	      <div class="form-group">
	      	<input type="password" class="form-control" placeholder="Password" name="password">
	      </div>
	      <div class="form-group remember-login">
	      	<input type="checkbox" name="remember" id="remember"> <label for="remember">Remember login?</label>
	      </div>
	      <button type="submit" id="login-button">Login</button>
	    </form>
	  </div>
	  
	  <ul class="bg-bubbles">
	    
	  </ul>
	</div>
</body>
</html>
<script  src="https://code.jquery.com/jquery-3.6.1.js" crossorigin="anonymous"></script>

<script  type="text/javascript">
	document.addEventListener('DOMContentLoaded', function(){
		$("#login-button").click(function(event){
		     event.preventDefault();
		   $('.wrapper').addClass('form-success');
		   $('form').fadeOut(500).submit();

		});
	})

	 for (var i = 0; i <= 15; i++) {
	 	$(".bg-bubbles").append(`<div class="scene">
							    	<div class="cube">
										<div class="cube__face cube__face--front"></div>
										<div class="cube__face cube__face--back"></div>
										<div class="cube__face cube__face--right"></div>
										<div class="cube__face cube__face--left"></div>
										<div class="cube__face cube__face--top"></div>
										<div class="cube__face cube__face--bottom"></div>
								    </div>
								</div>`);

	 }
</script>