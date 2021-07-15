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
//global $messagequeue;
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
		
		case 'get':
				$result = mysqli_query($link3,"SELECT * FROM ifsf_conf");  
				$row = mysqli_fetch_array($result);
				$server_lon_addr = $row[0]; 
				$cw_lon_addr = $row[1]; 
				$cw_lon_dev = $row[2]; 
				$code_veh_ord = $row[3]; 
				$stand_alone_auth = $row[4]; 
			//	$ifsf_bus_control = $row[5]; 
				$ifsf_bus_control = ord(shmop_read($shid, IFSF_BUS_CONTROL, 1)); // read real ifsf bus state from shared memory

				$ifsf_available = ord(shmop_read($shid, $FUNCTIONS[20] + SHM_FLASH_CACHE, 1)); //is ifsf available
				if($ifsf_available == 1 )
                {		
                    sleep(5);
                    $cw_server_uptime = exec(' ps -p $(pidof CW-Server) -o etime=');
                    $ifsf_server_uptime = exec(' ps -p $(pidof ifsf_server_easylon) -o etime=');
				}
				$json['server_lon_addr'] = $server_lon_addr;
				$json['cw_lon_addr'] = $cw_lon_addr;
				$json['cw_lon_dev'] = $cw_lon_dev;
				$json['code_veh_ord'] = $code_veh_ord;
				$json['stand_alone_auth'] = $stand_alone_auth;
				$json['ifsf_bus_control'] = $ifsf_bus_control;
				$json['cw_server_uptime'] = $cw_server_uptime;
				$json['ifsf_server_uptime'] = $ifsf_server_uptime;
				echo json_encode($json), "\n";

		break;
		
		case 'post':
		    $update = json_decode(file_get_contents('php://input'), true);
			/*
			if($update['command'] != null)
			{
				if($update['command'] == "restart_ifsf")
				{
					$last_line = system(' ps -p $(pidof ifsf_server_easylon) -o etime=', $retval);
					// Printing additional info
					echo $retval;
				}
				else if($update['command'] == "start_ifsf")
				{
					$last_line = system('service ifsf start', $retval);
					// Printing additional info
					echo $retval;
				}
				else if($update['command'] == "stop_ifsf")
				{
					$last_line = system('service ifsf stop', $retval);
					// Printing additional info
					echo $retval;
				}
				else
					echo "command not found..";
				
			break;
			}
			*/
			$server_lon_addr =  $update['serv_lon'];
			$cw_lon_addr =  $update['cw_lon'];
			$cw_lon_dev =  $update['cw_lon_dev'];
			$code_veh_ord =  $update['code_veh'];
			$stand_alone_auth =  $update['stand_alone'];
			$ifsf_bus_control =  $update['ifsf_bus'];
			//$shm_bytes_written = write_command($messagequeue,1,IFSF_BUS_CONTROL,1, $ifsf_bus_control);
			
			mysqli_query($link3,"UPDATE ifsf_conf SET server_lon_addr = '$server_lon_addr', 
											  cw_lon_addr = '$cw_lon_addr', 
											  cw_lon_dev = '$cw_lon_dev', 
											  code_veh_ord = '$code_veh_ord', 
											  stand_alone_auth = '$stand_alone_auth',
											  ifsf_bus = '$ifsf_bus_control'");  
			

			sleep(2);
			//header("Location: index.phpf?status=ok");
		break;
		}

?>
