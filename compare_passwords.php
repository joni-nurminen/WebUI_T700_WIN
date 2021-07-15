<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
/* create connection */
include "select_shared_mem.php";

switch ($request_method)
	{
		case 'get':		
				
				$result = mysqli_query($link2,"SELECT pass FROM Password");
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link2));
				}
				$row = mysqli_fetch_array( $result );
				$pass = $row['pass'];
				$json['pass'] = $pass;
				echo json_encode($json), "\n";
		break;
		
		case 'post':
				$update = json_decode(file_get_contents('php://input'), true);
				$pass = $update['pass']; 	
				
				$result = mysqli_query($link2,"UPDATE Password SET pass='$pass'");
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link2));
				}
		break;
	}
?>