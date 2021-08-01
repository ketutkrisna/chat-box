<?php 
	
	session_start();
	if(isset($_SESSION['login'])){
		header('location:index.php');
	}
	require_once'functions.php';

	if(isset($_POST['kirim'])){
		$username=$_POST['username'];
		$password=$_POST['password'];

		$result=mysqli_query($conn,"SELECT * FROM user WHERE username_user='$username' and password_user='$password'");
		$fet=mysqli_fetch_assoc($result);

		if(empty($fet)){
			$wrong=true;
		}else{
			$session=$fet['id_user'];
			if($fet['username_user']==$username && $fet['password_user']==$password){
				$_SESSION['login']=$session;
				// update login time
				$time=time()+120;
				mysqli_query($conn,"UPDATE user set log_time='$time' where id_user=$session");
				header('location:index.php');
			}else{
				echo "password salaah";
			}
		}
		
	}

 ?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Chat box</title>
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
		<!-- <nav class="navbar navbar-light bg-light"> -->
		  <a class="navbar-brand" href="#">
		    <img src="img/1.jpg" width="35" height="35" class="rounded-circle">
		  </a>
		<!-- </nav> -->
		<!-- <nav class="navbar navbar-light bg-light"> -->
		  <!-- <form class="form-inline">
		    <input class="" type="search" placeholder="Search" aria-label="Search">
		    <button class="" type="submit">cari</button>
		  </form> -->
		<!-- </nav> -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav ml-auto">
	      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
	      <a class="nav-item nav-link" href="#">Features</a>
	      <a class="nav-item nav-link" href="#">Pricing</a>
	      <a class="nav-item nav-link disabled" href="#">Disabled</a>
	    </div>
	  </div>
	</nav>
    
    <div class="container" style="margin-top: 130px;">
    	<h1 class="text-center">User Login</h1>
    	<?php if(isset($wrong)){ ?>
    		<p>Username/password salah!</p>
    	<?php } ?>
    	<form action="" method="post">
		  <div class="form-group row">
		    <label class="col-2 col-form-label">Username</label>
		    <div class="col-10">
		      <input type="text" class="form-control" placeholder="Username" name="username" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-2 col-form-label">Password</label>
		    <div class="col-10">
		      <input type="password" class="form-control" placeholder="Password" name="password" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <div class="col-10">
		      <button type="submit" class="btn btn-primary" name="kirim">Login</button>
		    </div>
		  </div>
		</form>

    </div>


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	var scroll = document.getElementById("roomchat");
		scroll.scrollTop = scroll.scrollHeight;
		// $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
    </script>
  </body>
</html>
