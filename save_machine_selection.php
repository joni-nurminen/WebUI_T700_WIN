<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
// selected slotnumber
$machinenumber = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;

/* create connection */
include 'mysql_connect_data.php';

switch ($request_method)
	{
		case 'get':		

				mysqli_query($link2,"UPDATE SelectedMachine SET number='$machinenumber'"); // slave is dropped from the line. use master
				
				$result = mysqli_query($link2,"SELECT number FROM SelectedMachine");  // read it back
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link2));
				}
				$row = mysqli_fetch_array( $result );
				$selected_machine = $row['number'];
				$json['selected_machine'] = $selected_machine;
				echo json_encode($json), "\n";
		break;
		
		case 'post':
		break;
	}

	// close connection
	mysqli_close($link2);

?>