<?php
session_start();
include "select_shared_mem.php";
	
$state = $_GET['state'];
$button = $_GET['button'];
$status = $_GET['status'];
$username = $POST['username'];

if($status == "logout")
{
	$ip=$_SERVER['REMOTE_ADDR']; // get client ip
	$mysqldate = date( 'Y-m-d H:i:s', time()); // get current time
	$user =  $_SESSION['username']; // get username
	
	$result = mysqli_query($link2,"UPDATE UserIp SET time_out='$mysqldate' WHERE ip='$ip' AND user='$user'"); // save logout time to database

	$_SESSION['username'] == null;
	$_SESSION['level'] == null;
	session_destroy();
}

/*
if($_SESSION['username'] != null)
{
echo $_SESSION['username'];
}
else
echo "tyhjaa on";
*/
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"/>
   <link rel="stylesheet" type="text/css" href= "lib/css/ultralux.css">
   <script language="JavaScript" type="text/javascript" src="lib/Functions.js"></script>
   <link rel="shortcut icon" href="lib/css/images/favicon.ico">
  <title>T700</title>
</head>
	<body onbeforeunload="ConfirmClose()" onunload="HandleOnClose()">
	<div id="maindiv_login">
		<table id="maindiv_login_table" border ="0">
		<tr>
		<td>
			<div class="draglistarea_orange" >
				<h3>Login</h3>
					<div class="container"> 
						<?php
							if($state == "new_account")
							{
								include("new_account.php");
							}
							else
							{
								include("login.php");
							}
						?> 
					</div>
			</div>
		</td>
		</tr>
		</table>
	</div>
	</body>
</html>
