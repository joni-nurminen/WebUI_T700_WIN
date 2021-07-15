<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$type = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;

/* Include functions */
include 'sync/sync_server_functions.php';
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
include 'select_shared_mem.php';
global $messagequeue;
//$messagequeue = msg_get_queue($mqueue_key,0666);
global $FUNCTIONS;

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
{
$json['error']="Cant open shared memory";
$shid = shmop_open($shm_key, "c", 0666, $shm_size);
return;
}

switch ($request_method)
{
	case 'get': // get camera settings from the database
			sleep(1);
			$result = mysqli_query($link,"SELECT * FROM camerasettings");
			{
			while($row = mysqli_fetch_assoc($result))
				{
					$json[] = $row;
				}
			}
			echo json_encode($json), "\n";
	break;

	case 'post':
		if($type == "set_camera_values") // save camera settings to database
		{
			$update = json_decode(file_get_contents('php://input'), true);
			$camera_status = 	$update['camera_status']; 	
		
			$camera_ip = 		trim($update['camera_ip']); 	
			$camera_port = 		trim($update['camera_port']); 	
			$camera_quality = 	trim($update['camera_quality']); 	
			
			$camera_fps = 		trim($update['camera_fps']); 	
			$camera_width = 	trim($update['camera_width']); 	
			$camera_height = 	trim($update['camera_height']); 	
			
			$result = mysqli_query($link,"UPDATE camerasettings SET camera_status='$camera_status', camera_ip='$camera_ip',camera_port='$camera_port',camera_quality='$camera_quality',camera_fps='$camera_fps',camera_width='$camera_width',camera_height='$camera_height'");
			if(!$result)
			{
				echo("Error description: " . mysqli_error($link));
			}
			else
				echo("camera settings saved succesfully");
		}	
	break;
}
?>
