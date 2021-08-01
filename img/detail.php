<?php 

	session_start();
	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}
	$idpengirim=$_GET['id'];
	$id=$_SESSION['login'];
	$conn=mysqli_connect('localhost','root','','chat');

	$result=mysqli_query($conn,"SELECT count(*) as ok,nama_user,id_user,id_penerima,isi_chat,id_chat from user join chat using (id_user) where id_penerima=$id and id_user=$idpengirim or id_penerima=$idpengirim and id_user=$id group by id_chat");

	if(isset($_POST['balas'])){
		$isi=$_POST['isibalasan'];
		$query=mysqli_query($conn,"INSERT INTO chat VALUES('','$id','$idpengirim','$isi','belum')");
		header('location:detail.php?idpengirim='.$idpengirim);
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>datail</title>
 </head>
 <body>
 	<h1>detail pesan</h1>

 		<?php foreach($result as $data){ ?>
 		<div class="row" style="background-color: #bbb;margin: 10px 0 10px 0">
 			<?=$data['nama_user']; ?><br> <?=$data['isi_chat'];  ?></td>
 		</div>
 		<?php } ?>
 		<form action="" method="post">
 			<input type="text" name="isibalasan">
 			<button type="submit" name="balas">balas</button>
 		</form>

 </body>
 </html>