<?php 
	
	session_start();
	if(!isset($_SESSION['login'])){
		header('location:formlogin.php');
	}
	$idpengirim=$_GET['idpengirim'];
	$id=$_SESSION['login'];
	require_once'functions.php';

	$time=time()+120;
	mysqli_query($conn,"UPDATE user set log_time='$time' where id_user='$id'");

	$result=mysqli_query($conn,"SELECT count(*) as botifikasi,nama_user,id_user,id_penerima,isi_chat,id_chat,tanggal_chat,jam_chat from user join chat on user.id_user=chat.id_pengirim where id_penerima=$id and id_user=$idpengirim or id_penerima=$idpengirim and id_user=$id group by id_chat");

	$update=mysqli_query($conn,"UPDATE chat SET notif_chat='sudah' where id_pengirim=$idpengirim and id_penerima=$id");

	if(isset($_POST['balas'])){
		date_default_timezone_set('Asia/Jakarta');
		$jam=date("H:i");
		$tanggal=date("Y-m-d");
		$isi=$_POST['isibalasan'];
		$query=mysqli_query($conn,"INSERT INTO chat VALUES('','$id','$idpengirim','$isi','$tanggal','$jam','belum')");
		header('location:info.php?idpengirim='.$idpengirim);
	}

	$temanchat=mysqli_query($conn,"SELECT * FROM user where id_user=$idpengirim");
	$fetteman=mysqli_fetch_assoc($temanchat);

	$profil=mysqli_query($conn,"SELECT * FROM user where id_user=$id");
	$fetprofil=mysqli_fetch_assoc($profil);

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
		  <a class="navbar-brand" href="index.php">
		    <img src="img/<?=$fetprofil['foto_user']; ?>" width="35" height="35" class="rounded-circle">
		  </a>
		<!-- </nav> -->
		<!-- <nav class="navbar navbar-light bg-light"> -->
		  <form class="form-inline">
		    <input style="height:33px" class="" type="search" placeholder="Search" aria-label="Search">
		    <button style="height:33px;margin-top:2px" class="" type="submit">cari</button>
		  </form>
		<!-- </nav> -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav ml-auto">
	      <a class="nav-item nav-link" href="#"><?=$fetprofil['nama_user']; ?></a>
	      <a class="nav-item nav-link" href="#">Setting</a>
	      <a class="nav-item nav-link" href="logout.php">Keluar</a>
	    </div>
	  </div>
	</nav>
    
    <!-- <div class="container"> -->
    <div class="row" style="margin-top: 50px;">
    	<div class="col-12">
    		<div class="card">
			  <div class="card-header" style="background-color: #eed;height: 60px">
			    <ul class="nav nav-tabs card-header-tabs">

					  <a class="navbar-brand ml-2 mb-2" href="profil,php">
					    <img src="img/<?=$fetteman['foto_user']; ?>" width="37" height="37" class="rounded-circle">
					    <span><?=$fetteman['nama_user']; ?></span>
					  </a>
			    	
			    </ul>
			  </div>
			  <div class="card-body roomchat" id="roomchat" style="max-height: 445px; overflow: auto;">

			  	<?php foreach($result as $data){ ?>
			  	<?php if($data['id_penerima']==$id){ ?>
			  		<div class="card border-success mb-3" style="width: 80%;border-radius:20px;box-shadow:2px 2px 4px green;padding: 5px 10px 5px 10px;">
					    <span class="card-text"><?=$data['isi_chat']; ?></span>
					    <span class="ml-1 mt-1" style="font-size: 11px"><?=$data['tanggal_chat']." "." ".$data['jam_chat']; ?></span>
					</div>
			  	<?php }else{ ?>
				  	<div class="card border-primary mb-3 ml-auto" style="width: 80%;border-radius:20px;box-shadow:-2px 2px 4px blue;padding: 5px 10px 5px 10px;">
					    <span class="card-text"><?=$data['isi_chat']; ?></span>
					    <span class="ml-auto mt-1" style="font-size: 11px"><?=$data['tanggal_chat']." "." ".$data['jam_chat']; ?></span>
					</div>
				<?php } ?>
				<?php } ?>

				

			  </div>
				 <form class="form-group" action="" method="post">
				    <input style="width: 80%;border-radius: 10px;height:37px;border:1px solid black" type="text" class="ml-3" placeholder="ketikan sesuatu..." name="isibalasan" autocomplete="off" required>
				  <button style="height: 35px;border-radius: 5px;" type="submit" class="btn-primary" name="balas">kirim</button>
				</form>
				</div>
    	</div>	
    <!-- </div> -->


    
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
