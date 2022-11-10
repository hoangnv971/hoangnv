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
	    
	    <form class="form" method="post">
	      <div class="message">
	      </div>
	      @csrf
	      <div class="form-group">
	      	@if(count($errors) > 0)
	      		<div class="message">{{$errors->first('email')}}</div>
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
<script  src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>

<script  type="text/javascript">
	 $("#login-button").click(function(event){
	     event.preventDefault();
	   
	   $('form').fadeOut(500);
	   $('.wrapper').addClass('form-success');
	});

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
  </div>`)

	 }
</script>