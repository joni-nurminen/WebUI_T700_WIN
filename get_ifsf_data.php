<?php
include "defines.php";
include "sync/sync_server_functions.php";

global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	$json['error']="Cant open shared memory";
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}

    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': 
			$shm_id = shmop_open($shm_key, "w", 0666, 34128);
			$ifsf = ord(shmop_read($shm_id, 19701, 1)); // option7 -> ifsf
			$maintenance = ord(shmop_read($shm_id, MAINTENANCE_MODE, 1)); // maintenance
			$operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem
			$allow_continue_cancel = ord(shmop_read($shid, ALLOW_CONTINUE_CANCEL, 1)); // After emergencybutton is released -> allow continue and cancel commands
			
			$json['ifsf']=$ifsf; 
			$json['maintenance']=$maintenance; 
			$json['operation_mode']=$operation_mode; // get operationmode
			$json['allow_continue_cancel'] =  $allow_continue_cancel;	// allow continue and cancel
         break;
    }
	  echo json_encode($json);
?>
