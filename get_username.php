<?php
session_start();				
$logged_user = $_SESSION['username'];

switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': 
				$json['logged_user']=$logged_user; 	
				echo json_encode($json), "\n";
         break;
    }	
	
?>
