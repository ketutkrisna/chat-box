<?php 
	
	session_start();
	if(isset($_SESSION['login'])){
		header('location:index.php');
	}
	$conn=mysqli_connect('localhost','root','','chat');

	if(isset($_POST['kirim'])){
		$username=$_POST['username'];
		$password=$_POST['password'];

		$result=mysqli_query($conn,"SELECT * FROM user WHERE username_user='$username' and password_user='$password'");
		$fet=mysqli_fetch_assoc($result);
		$session=$fet['id_user'];

		if($fet['username_user']==$username && $fet['password_user']==$password){
			$_SESSION['login']=$session;
			header('location:index.php');
		}else{
			echo "password salaah";
		}
	}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>login</title>
 </head>
 <body>
 
 	<h1>login</h1>

 	<form action="" method="post">
 		username
 		<input type="text" name="username">
 		password
 		<input type="password" name="password">
 		<button type="submit" name="kirim">kirim</button>
 	</form>

 </body>
 </html>