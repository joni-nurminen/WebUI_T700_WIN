<?php
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$com = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */
include 'sync/sync_server_functions.php';
/* Include defines */
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
// Set variables
include 'select_shared_mem.php';
// Open queue
	
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
	case 'post':
			$update = json_decode(file_get_contents('php://input'), true);
			$command = $update['run_command'];
			$prog_number = $update['prog_number'];
			$mach_type = $update['type'];
			
		switch ($command)
		{
			case 'start': // start is pressed
			//	$operation_mode = 	ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem

				//	if($operation_mode == 4) // Customer entry
				//	{
			
						switch ($prog_number)
						{       // 1...15
							case 1:
							case 2:
							case 3:
							case 4:
							case 5:
							case 6:
							case 7:
							case 8:
									$shifting = ($prog_number - 1);   // let's shift 1 by 0...7 on LO
									if($mach_type == "twin") // twin machine selected. Send command for both machines 
									{
										//master
										$mqueue_key = $config["t700-1"]["Messagequeue-key"];
										//$messagequeue = msg_get_queue($mqueue_key,0666);
								
										write_command(ALLOWSTART_H,0);
										write_command(ALLOWSTART_L,(1 << $shifting));
										
										//slave
										/*
										$mqueue_key = $config["t700-2"]["Messagequeue-key"];
										$messagequeue = msg_get_queue($mqueue_key,0666);
								
										write_command($messagequeue,1,ALLOWSTART_H,1,0);
										write_command($messagequeue,1,ALLOWSTART_L,1,(1 << $shifting));
										*/
									}
									else
									{
										write_command(ALLOWSTART_H,0);
										write_command(ALLOWSTART_L,(1 << $shifting));
									}
									break;
							case 9:
							case 10:
							case 11:
							case 12:
							case 13:
							case 14:
							case 15:
							case 16:
									$shifting = ($prog_number - 9); // let's shift 1 by 0...7 on HI 
									if($mach_type == "twin") // twin machine selected. Send command for both machines 
										{
											//master
											$mqueue_key = $config["t700-1"]["Messagequeue-key"];
											//$messagequeue = msg_get_queue($mqueue_key,0666);
									
											write_command(ALLOWSTART_L,0);
											write_command(ALLOWSTART_H,(1 << $shifting));
											//slave
											/*
											$mqueue_key = $config["t700-2"]["Messagequeue-key"];
											$messagequeue = msg_get_queue($mqueue_key,0666);
									
											write_command($messagequeue,1,ALLOWSTART_L,1,0);
											write_command($messagequeue,1,ALLOWSTART_H,1,(1 << $shifting));
											*/
										}
										else
										{
											write_command(ALLOWSTART_L,0);
											write_command(ALLOWSTART_H,(1 << $shifting));
										}
									break;
							case 17:
							case 18:
							case 19:
							case 20:
							case 21:
							case 22:
							case 23:
							case 24:
									$shifting = ($prog_number - 17); // let's shift 1 by 0...7 on LO
									if($mach_type == "twin") // twin machine selected. Send command for both machines 
										{
											//master
											$mqueue_key = $config["t700-1"]["Messagequeue-key"];
											//$messagequeue = msg_get_queue($mqueue_key,0666);
									
											write_command(ALLOWSTART_HH,0);
											write_command(ALLOWSTART_LL,(1 << $shifting));
											//slave
											/*
											$mqueue_key = $config["t700-2"]["Messagequeue-key"];
											$messagequeue = msg_get_queue($mqueue_key,0666);
									
											write_command($messagequeue,1,ALLOWSTART_HH,1,0);
											write_command($messagequeue,1,ALLOWSTART_LL,1,(1 << $shifting));
											*/
										}
										else
										{
											write_command(ALLOWSTART_HH,0);
											write_command(ALLOWSTART_LL,(1 << $shifting));
										}
									break;
							case 25:
							case 26:
							case 27:
							case 28:
							case 29:
							case 30:	
							case 31:
							case 32:
									$shifting = ($prog_number - 25); // let's shift 1 by 0...7 on HI 
									if($mach_type == "twin") // twin machine selected. Send command for both machines 
											{
												//master
												$mqueue_key = $config["t700-1"]["Messagequeue-key"];
												//$messagequeue = msg_get_queue($mqueue_key,0666);
										
												write_command(ALLOWSTART_LL,0);
												write_command(ALLOWSTART_HH,(1 << $shifting));
												//slave
												/*
												$mqueue_key = $config["t700-2"]["Messagequeue-key"];
												$messagequeue = msg_get_queue($mqueue_key,0666);
										
												write_command($messagequeue,1,ALLOWSTART_LL,1,0);
												write_command($messagequeue,1,ALLOWSTART_HH,1,(1 << $shifting));
												*/
											}
											else
											{
												write_command(ALLOWSTART_LL,0);
												write_command(ALLOWSTART_HH,(1 << $shifting));
											}
									break;
					//	}
					
					}
						
			break;
			case 'stop':// stop is pressed
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			
				if($machine_type == 5) // if selected machinetype is t700 twin 1
				{
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,8);
					write_command(ALLOW_CONTINUE_CANCEL,0);
					/*
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command($messagequeue,1,OPERATION_MODE,1,8);
					*/
				}
				else
				{
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,8);
					write_command(ALLOW_CONTINUE_CANCEL,0);
				}
				
				
			break;
			case 'pause':// pause is pressed
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			
				if($machine_type == 5) // if selected machinetype is t700 twin 1
				{
				//	$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,7);
					write_command(ALLOW_CONTINUE_CANCEL,0);
					/*
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command($messagequeue,1,OPERATION_MODE,1,7);
					*/
				}
				else
				{
				//	$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,7);
					write_command(ALLOW_CONTINUE_CANCEL,0);
				}
			break;	
			case 'continue_prog':// continue is pressed
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			
				if($machine_type == 5) // if selected machinetype is t700 twin 1
				{
				//	$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,6);
					write_command(ALLOW_CONTINUE_CANCEL,0);
					/*
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command($messagequeue,1,OPERATION_MODE,1,6);
					*/
				}
				else
				{
				//	$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					//$messagequeue = msg_get_queue($mqueue_key,0666);
					write_command(OPERATION_MODE,6);
					write_command(ALLOW_CONTINUE_CANCEL,0);
				}
			break;	
		}
	break;
	
	case 'get':
		if($com == "get_operation_state")
		{
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			
			if($machine_type == 5) // if selected machinetype is t700 twin 1
			{
				$mqueue_key = $config["t700-1"]["Messagequeue-key"];
				$shm_key  = $config["t700-1"]["Sharedmemory-key"];
				$shm_size  = $config["t700-1"]["Sharedmemory-size"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);

				// Open memory for reading
				$shid = shmop_open($shm_key, "w", 0666, $shm_size );
				$operation_mode = 	ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from master shared mem
				$json['operation_mode_master'] = $operation_mode;
				
				$mqueue_key = $config["t700-2"]["Messagequeue-key"];
				$shm_key  = $config["t700-2"]["Sharedmemory-key"];
				$shm_size  = $config["t700-2"]["Sharedmemory-size"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);

				// Open memory for reading
				$shid = shmop_open($shm_key, "w", 0666, $shm_size );
				$operation_mode = 	ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from slave shared mem
				$json['operation_mode_slave'] = $operation_mode;
			}
			else // if some other is selected
			{
		
				$operation_mode = 	ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem
				$json['operation_mode_master'] = $operation_mode;
				$json['operation_mode_slave'] = null;
			
			}
			echo json_encode($json), "\n";
		}
	break;
}

?>