<?php 

 session_start();
 date_default_timezone_set('Asia/Jakarta');
 require_once 'functions.php';
 $id=$_SESSION['login'];
 $time=time();
 mysqli_query($conn,"UPDATE user set log_time='$time' where id_user=$id");
 session_destroy();
 header('location:formlogin.php');


 ?>