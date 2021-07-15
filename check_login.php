<?php
session_start();
include "select_shared_mem.php";

$lusername = $_POST['user'];
$lpassword = $_POST['login_password'];

$result = mysqli_query($link2, "SELECT * FROM Users WHERE username='$lusername' and password=SHA1('$lpassword')");
if(!$result)
{
  echo("Error description: " . mysqli_error($link2));
}

$count=mysqli_num_rows($result);

if($count==1) // passu ja salasana matsaa
{

	$_SESSION['username'] = $lusername;

	$ip=$_SERVER['REMOTE_ADDR']; // get client ip
	$mysqldate = date( 'Y-m-d H:i:s', time());

	$result = mysqli_query($link2,"INSERT INTO UserIp (ip,user,time_in, time_out) VALUES('$ip','$lusername','$mysqldate','') "); // add data 
	if(!$result)
	{
	  echo("Error description: " . mysqli_error($link2));
	}
	
	header("Location: main_page.php");

}
else
{
	header("Location: index.php?status=wrong");
}
?>