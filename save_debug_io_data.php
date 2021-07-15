<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$card = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */
include 'sync/sync_server_functions.php';
// Parse config
$config = parse_config($config_file_name);
// Set variables
include 'select_shared_mem.php';
// Open queue
//global $messagequeue;
//$messagequeue = msg_get_queue($mqueue_key,0666);

switch ($request_method)
		{
		
		case 'get':
		/*
			$result = mysql_query("SELECT * FROM IoData WHERE card='$card' ORDER BY id");
			while($row = mysql_fetch_assoc($result))
				{
				 $json[] = $row;
				}
				echo json_encode($json), "\n";
				*/
		break;
		
		case 'post':
			$update = json_decode(file_get_contents('php://input'), true);
		
			$result = mysqli_query($link2,"SELECT number FROM SelectedMachine");  // get selected machine number
			$row = mysqli_fetch_array( $result );
			$selected_machine = $row['number'];
		
			if($selected_machine == 1) // select table
				$io = "IoData";
			if($selected_machine == 2)
				$io = "IoData2";
		
			// first delete everything
			mysqli_query($link,"DELETE FROM $io WHERE card='$card'");
			
			// add new selectiond data
			for($i=0;$i<count($update);$i++)
			{
				$id = $update[$i];
				mysqli_query($link,"INSERT INTO $io (id,card)VALUES ('$id','$card')");
			}
		
		break;
		}

	// close connection
	mysqli_close($link);

?>