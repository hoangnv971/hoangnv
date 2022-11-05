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
	      	<input type="text" class="form-control" placeholder="Username" name="email">
	      </div>
	      <div class="form-group">
	      	<input type="password" class="form-control" placeholder="Password" name="password">
	      </div>
	      <div class="form-group align-left">
	      	<input type="checkbox" name="remember"> Remember me?
	      </div>
	      <button type="submit" id="login-button">Login</button>
	    </form>
	  </div>
	  
	  <ul class="bg-bubbles">
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	    <li></li>
	  </ul>
	</div>
</body>
</html>
<script defer src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>

<script defer type="text/javascript">
	 $("#login-button").click(function(event){
	     event.preventDefault();
	   
	   $('form').fadeOut(500);
	   $('.wrapper').addClass('form-success');
	});
</script>