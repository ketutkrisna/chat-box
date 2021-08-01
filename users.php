<?php 
	
	session_start();
	if(!isset($_SESSION['login'])){
		header('location:formlogin.php');
	}
	$id=$_SESSION['login'];
	require_once'functions.php';

	$time=time()+120;
	mysqli_query($conn,"UPDATE user set log_time='$time' where id_user='$id'");

	// fix jadi
	$result=mysqli_query($conn,"SELECT * from user order by log_time desc");

	$nama= mysqli_query($conn,"SELECT * FROM user WHERE id_user=$id");
	$fetnama= mysqli_fetch_assoc($nama);

	if(isset($_POST['buttoncari'])){
		$inputCari=htmlspecialchars($_POST['inputcari']);

		$result=mysqli_query($conn,"SELECT user.*,chat.*,max(id_chat) as newchat from user left join chat on user.id_user=chat.id_pengirim or chat.id_penerima=user.id_user where (id_penerima=$id or id_pengirim=$id) and nama_user like '%$inputCari%' group by id_user order by newchat desc");
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

    <style type="text/css">
    	body{
    		 overflow-x: hidden;
    	}
	  	.s{
		   width: 100%;
		   height: 200px;
		   background: #6fc1ad;
		   padding: 10px;
	  	}
	  	.scroll{
		   background: white;
		   width: 90%;
		   height: 90%;
		   overflow: auto;
		   font-size: 20px;
	 	   padding: 5px;
	  	}
 </style>

    <title>Chat box</title>
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
		<!-- <nav class="navbar navbar-light bg-light"> -->
			<!-- <div class="hide mt-1">
			<h5>Com</h5>
			</div> -->
		<div class="show">
		  <a class="navbar-brand" href="index.php">
		    <img src="img/<?=$fetnama['foto_user']; ?>" width="35" height="35" class="rounded-circle">
		  </a>	
		</div>
		  
		<!-- </nav> -->
		<!-- <nav class="navbar navbar-light bg-light"> -->
		  <form class="form-inline" action="" method="post">
		    <input style="height:33px" name="inputcari" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
		    <button style="height:33px;margin-top:2px" name="buttoncari" type="submit">cari</button>
		  </form>
		<!-- </nav> -->
	  <button class="navbar-toggler profil" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav ml-auto">
	      <a class="nav-item nav-link" href="#"><?=$fetnama['nama_user']; ?></a>
	      <a class="nav-item nav-link" href="#">Setting</a>
	      <a class="nav-item nav-link" href="logout.php">Keluar</a>
	    </div>
	  </div>
	</nav>
    
    <!-- <div class="container"> -->
    <div class="row" style="margin-top: 50px;">
    	<div class="col-12">
    		<div class="card text-center">
			  <div class="card-header" style="background-color: #eed">
			    <ul class="nav nav-tabs card-header-tabs justify-content-center">

				      <li class="nav-item" style="width:33%;">
				        <a class="nav-link" style="color: black;font-weight:bold;" href="index.php">Chatting</a>
				      </li>
				      <li class="nav-item" style="width:33%;font-weight:bold;">
				        <a class="nav-link" style="color: black;" href="#">Status</a>
				      </li>
				      <li class="nav-item" style="width:33%">
				        <a class="nav-link active" style="color: black;font-weight:bold;" href="users.php">Users</a>
				      </li>
			    		
			    </ul>
			  </div>
			  <div class="card-body listchat">
			  	<div class="container">

    		<?php foreach($result as $data){ ?>

				<?php if($data['id_user']==$id){
				}else{ ?>
    				<a href="info.php?idpengirim=<?=$data['id_user']; ?>" style="text-decoration: none;" class="text-left" data-toggle="tooltip" data-html="true" title="users">
					  <li class="media" style="margin-top: -15px; margin-bottom:-5px;height: 60px;overflow: hidden;">
					    <img class="mr-2 rounded-circle mt-2" src="img/<?=$data['foto_user']; ?>" width="50" height="50" alt="Generic placeholder image">
					    <div class="mr-auto">
					      <h5 class="text-left mt-2"><?=$data['nama_user']; ?>
					      <!-- <span class="" style="font-size:11px"><?=$data['jam_chat']; ?></span></h5>
					      <span><?=$fetorder['isi_chat']; ?></span> -->
					    </div>
					    <?php if($data['log_time']>=time()){ ?>
					      	<span class="bg-success ml-auto rounded-circle" style="width:15px;height:15px;margin-top:30px;margin-right:4px;"></span> <span style="margin-top:25px">Online</span>
					    <?php }else{ ?>
					    	<span class="bg-danger ml-auto rounded-circle" style="width:15px;height:15px;margin-top:30px;margin-right:4px;"></span> <span style="margin-top:25px">Offline</span>
					    <?php } ?>
					  </li>
					</a>
					<hr>
				<?php } ?>
			<?php } ?>

				</div>
			  </div>
			</div>
    	</div>
    <!-- </div> -->
   <!--  <div class="container">
    	<div class="row">
    		<div class="col-12">
    			<ul class="list" style="background-color: gray;border-radius: 10px">
				  <li class="media">
				    <img class="mr-3 rounded-circle" src="img/1.jpg" alt="Generic placeholder image">
				    <div class="media-body">
				      <h5 class="mt-0 mb-1">genji</h5>
				      Cras sit amet nibh libero
				      <span class="badge badge-danger badge-pill ml-auto">12</span>
				    </div>
				  </li>
				</ul>
    		</div>
    	</div>
    </div>	 -->
<!-- <div class="container" style="margin-top: 50px"> -->
	<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="nama : anjay<br>
		alamat : jln anjay <br>
		no tlp : 02391249124">
	  Tooltip with HTML
	</button>

	<!-- HTML to write -->
	<!-- <a href="#" data-toggle="tooltip" title="Some tooltip text!">Hover over me</a> -->

	<!-- Generated markup by the plugin -->
	<!-- <div class="tooltip bs-tooltip-top usage" role="tooltip">
	  <div class="arrow"></div>
	  <div class="tooltip-inner usage">
	    Some tooltip text!
	  </div>
	</div> -->
<!-- </div> -->
    
    


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="js/myscript.js"></script> -->
    <script type="text/javascript">
    	$(function () {
    		
    		$('[data-toggle="tooltip"]').tooltip();
    		$('.arrow').tooltip(options);
	    	var scroll = document.getElementById("roomchat");
			scroll.scrollTop = scroll.scrollHeight;
		// $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
		})
    </script>
  </body>
</html>
