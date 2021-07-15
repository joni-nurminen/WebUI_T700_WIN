<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

/* Include functions */
include 'sync/sync_server_functions.php';
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
// Set variables

$select = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */

include 'select_shared_mem.php';
//$messagequeue = msg_get_queue($mqueue_key,0666);

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shm_key);
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}
	
switch ($request_method)
{		
		case 'get':		
			if($select == "use_conf")
			{
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
				
				if($machine_type == 5 || $machine_type == 6) // twin machine selected. Send command for both machines 
				{
					//master
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(1, 49);
					
					//slave
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(1, 49);
				}
				else
				{
					write_command(1, 49);
				}
				return;
			}
			if($select == "uptime")
			{
				$json['uptime'] =  get_remote_uptime("t700-1");
				echo json_encode($json), "\n";
				return;
			}
		break;
}
?>