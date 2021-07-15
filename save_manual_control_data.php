<?php
session_start();
$logged_user = $_SESSION['username'];
	
include "defines.php";
include 'sync/sync_server_functions.php';

// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';
// Open queue
global $messagequeue;
//$messagequeue = msg_get_queue($mqueue_key,0666);
// Open memory for reading
$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
if($shm_id == FALSE) 
	{
	$json['error']="Cant open shared memory";
	}

switch ($request_method)
{
		case 'get':

			$floor_wash_status = ord(shmop_read($shm_id, 31283, 1));
			$frost_blowout_status = ord(shmop_read($shm_id, 31281, 1));
			$drive_in = ord(shmop_read($shm_id, 31300, 1));
			$drive_out = ord(shmop_read($shm_id, 31304, 1));
			$maintenance = ord(shmop_read($shm_id, MAINTENANCE_MODE, 1));
			$pump_state = ord(shmop_read($shm_id, 31285, 1)); // luetaan pumpun tila
			$state = ord(shmop_read($shm_id, 31396, 1));
			$machine_state = ord(shmop_read($shm_id, OPERATION_MODE, 1)); // pesukoneen toimintatila, updKHu
		
			if ($state == 103) // Sivuharjat sivulle, updKHu
			{			
				$stroke = ord(shmop_read($shm_id, 1490, 1));
				$stroke += 1;
				if ($stroke == 2)
				{
					write_command(GOUT_00 + 3,0); // Vasen sivuharja sivulle off
					write_command(GOUT_00 + 5,0); // Oikea sivuharja sivulle off
					$shm_bytes_written = write_command(31396,0);
					$shm_bytes_written = write_command(1490,0);
				}
				else
					$shm_bytes_written = write_command(1490,$stroke);
			}

			$json['floor_wash_status']=$floor_wash_status; 
			$json['frost_blowout_status']=$frost_blowout_status; 
			$json['drive_in']=$drive_in; 
			$json['drive_out']=$drive_out; 
			$json['maintenance']=$maintenance; 
			$json['pump_state']=$pump_state; 
			$json['state']=$state; 
			$json['logged_user']=$logged_user;
			$json['machine_state']=$machine_state; // updKHu
			$json['uptime_master'] =  get_remote_uptime("t700-1"); // get master uptime	
			
			
			echo json_encode($json), "\n";
		break;
		
		case 'post':
			$update = json_decode(file_get_contents('php://input'), true);
			$command = $update['command'];
			$mode = $update['mode'];
			$state = ord(shmop_read($shm_id, 31396, 1));
				
				
					switch ($command) 
					{
					 case "reset_high_meas":
						//$shm_id = shmop_open($shm_key, "w", 0666, 34128); // updKHu
						$shm_bytes_written = write_command(31285,0);
						$shm_bytes_written = write_command(19663,0);
						break;
					 case "startpump":
						$operation_mode = ord(shmop_read($shm_id, OPERATION_MODE, 1)); // get operation mode from shared mem
						if($operation_mode != 6) // Jotakin muuta kuin washing (6) //idle (3) mode pitää olla päällä
						{
							$shm_id = shmop_open($shm_key, "w", 0666, 34128);
						    $pump_state = ord(shmop_read($shm_id, 31285, 1)); // luetaan pumpun tila
							
							if($pump_state == 1) // togltataan tilaa
								$shm_bytes_written = write_command(31285,0);
							else
								$shm_bytes_written = write_command(31285,1);	
						}
						//else // muissa operaatio modeissa pitää pystyä sammuttaan pumppu
						//{
						//	 $pump_state = ord(shmop_read($shm_id, 31285, 1)); // luetaan pumpun tila
						//	
						//	if($pump_state == 1) // togltataan tilaa
						//		$shm_bytes_written = write_command($messagequeue,1,31285,1, 0);
						//}
						break;	
					 case "floor_wash":
						//$shm_id = shmop_open($shm_key, "w", 0666, 34128); // updKHu
						write_command(31283,10);
						break;
					 case "maintenance":
					 	//$shm_id = shmop_open($shm_key, "w", 0666, 34128); // updKHu
						$mode = ord(shmop_read($shm_id, MAINTENANCE_MODE, 1));
						$machine_type = ord(shmop_read($shm_id, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
						if($mode == 1)
						{
							write_command(MAINTENANCE_MODE,0);
							write_command(31324,1);
							
							if($machine_type == 5 || $machine_type == 6) // kone on twinkone
							{
								// send also to slave machine
								$mqueue_key = $config["t700-2"]["Messagequeue-key"];
								$shm_key  = $config["t700-2"]["Sharedmemory-key"];
								$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
								$shm_size  = $config["t700-2"]["Sharedmemory-size"];
								
								//$messagequeue = msg_get_queue($mqueue_key,0666);
								// Open memory for reading
								$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
								if($shm_id == FALSE) 
								{
									$json['error']="Cant open shared memory";
								}
								else
								{
										$shm_id = shmop_open($shm_key, "w", 0666, 34128);
										write_command(MAINTENANCE_MODE,0);
										write_command(31324,1);
										shmop_close($shm_id);
								}
							}
						}
						else
						{
							write_command(MAINTENANCE_MODE,1);
							write_command(31324,9);

							
							if($machine_type == 5 || $machine_type == 6) // kone on twinkone
							{
								// send also to slave machine
								$mqueue_key = $config["t700-2"]["Messagequeue-key"];
								$shm_key  = $config["t700-2"]["Sharedmemory-key"];
								$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
								$shm_size  = $config["t700-2"]["Sharedmemory-size"];
								
								//$messagequeue = msg_get_queue($mqueue_key,0666);
								// Open memory for reading
								$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
								if($shm_id == FALSE) 
								{
									$json['error']="Cant open shared memory";
								}
								else
								{
										$shm_id = shmop_open($shm_key, "w", 0666, 34128);
										write_command(MAINTENANCE_MODE,1);
										write_command(31324,9);
										shmop_close($shm_id);
								}
							}
						}
							
						break;
					 case "gantry_backward":
						//$shm_id = shmop_open($shm_key, "w", 0666, 34128); //updKHu
							if($state == 100)
							{
							//	$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,100);
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
						break;
					 case "gantry_forward":
						//$shm_id = shmop_open($shm_key, "w", 0666, 34128); // updKHu
							if($state == 99)
							{
								//$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,99); // jos nappi ei ole painettu
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
						 break;
					 case "frost_blowout":
						//$shm_id = shmop_open($shm_key, "w", 0666, 34128); // updKHu
						$shm_bytes_written = write_command(31281,1);
							break;
					 case "roofbrush_up":
						$shm_id = shmop_open($shm_key, "w", 0666, 34128);
						$shm_bytes_written = write_command(31396,98);
							break;
					 case "roofnozzle_up":
						$shm_id = shmop_open($shm_key, "w", 0666, 34128);
						$shm_bytes_written = write_command(31396,97);
							break;
					 case "drive_in":
						$drive_in = ord(shmop_read($shm_id, 31300, 1));
						if($drive_in == 1)
							$shm_bytes_written = write_command(31300,0);
						else
							$shm_bytes_written = write_command(31300,1);
							break;
					 case "drive_out":
						$drive_out = ord(shmop_read($shm_id, 31304, 1));
						if($drive_out == 1)
							$shm_bytes_written = write_command(31304,0);
						else
							$shm_bytes_written = write_command(31304,1);
							break;
					
					 case "shutdown":
						$operation_mode = ord(shmop_read($shm_id, OPERATION_MODE, 1)); // get operation mode from shared mem
						if($operation_mode != 6) // something else than washing mode
						{
									$today = date("Y-m-d H:i:s"); // Logitiedostoon jälki, updKHu v1.1
									$log = sprintf("%s Shutdown pressed\n", $today);
									error_log($log, 3, "log/t700-php.log");

									$mqueue_key = $config["t700-2"]["Messagequeue-key"];
									$shm_key  = $config["t700-2"]["Sharedmemory-key"];
									$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
									$shm_size  = $config["t700-2"]["Sharedmemory-size"];
									
									//$messagequeue = msg_get_queue($mqueue_key,0666);
										// Open memory for reading
										$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
										if($shm_id == FALSE) 
										{
											$json['error']="Cant open shared memory";
										}
										else
										{
												$shm_id = shmop_open($shm_key, "w", 0666, 34128);
												$shm_bytes_written = write_command(1, 48);
												shmop_close($shm_id);
										}
										
									$mqueue_key = $config["t700-1"]["Messagequeue-key"];
									$shm_key  = $config["t700-1"]["Sharedmemory-key"];
									$shm_mode  = $config["t700-1"]["Sharedmemory-mode"];
									$shm_size  = $config["t700-1"]["Sharedmemory-size"];
									
									//$messagequeue = msg_get_queue($mqueue_key,0666);
										// Open memory for reading
										$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
										if($shm_id == FALSE) 
										{
											$json['error']="Cant open shared memory";
										}
										else
										{
												$shm_id = shmop_open($shm_key, "w", 0666, 34128);
												$shm_bytes_written = write_command(1, 48);
												shmop_close($shm_id);
										}	
						}
							break;
					 case "reboot":
						$operation_mode = ord(shmop_read($shm_id, OPERATION_MODE, 1)); // get operation mode from shared mem
						if($operation_mode != 6) // something else than washing mode
						{
							
									$today = date("Y-m-d H:i:s"); // Logitiedostoon jälki, updKHu v1.1
									$log = sprintf("%s Reboot pressed\n", $today);
									error_log($log, 3, "log/t700-php.log");
								
									$mqueue_key = $config["t700-2"]["Messagequeue-key"];
									$shm_key  = $config["t700-2"]["Sharedmemory-key"];
									$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
									$shm_size  = $config["t700-2"]["Sharedmemory-size"];
									
									//$messagequeue = msg_get_queue($mqueue_key,0666);
										// Open memory for reading
										$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
										if($shm_id == FALSE) 
										{
											$json['error']="Cant open shared memory";
										}
										else
										{
												$shm_id = shmop_open($shm_key, "w", 0666, 34128);
												$shm_bytes_written = write_command(1, 52);
												shmop_close($shm_id);
										}
										
									$mqueue_key = $config["t700-1"]["Messagequeue-key"];
									$shm_key  = $config["t700-1"]["Sharedmemory-key"];
									$shm_mode  = $config["t700-1"]["Sharedmemory-mode"];
									$shm_size  = $config["t700-1"]["Sharedmemory-size"];
									
									//$messagequeue = msg_get_queue($mqueue_key,0666);
										// Open memory for reading
										$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
										if($shm_id == FALSE) 
										{
											$json['error']="Cant open shared memory";
										}
										else
										{
												$shm_id = shmop_open($shm_key, "w", 0666, 34128);
												$shm_bytes_written = write_command(1, 52);
												shmop_close($shm_id);
										}	
						}
							break;
					 case "reset":
						$operation_mode = ord(shmop_read($shm_id, OPERATION_MODE, 1)); // get operation mode from shared mem
						if($operation_mode != 6) // something else than washing mode
						{
							$today = date("Y-m-d H:i:s"); // Logitiedostoon jälki, updKHu v1.1
							$log = sprintf("%s Reset pressed\n", $today);
							error_log($log, 3, "log/t700-php.log");

							$mqueue_key = $config["t700-2"]["Messagequeue-key"];
							$shm_key  = $config["t700-2"]["Sharedmemory-key"];
							$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
							$shm_size  = $config["t700-2"]["Sharedmemory-size"];
							
							//$messagequeue = msg_get_queue($mqueue_key,0666);
								// Open memory for reading
								$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
								if($shm_id == FALSE) 
								{
									$json['error']="Cant open shared memory";
								}
								else
								{
										$shm_id = shmop_open($shm_key, "w", 0666, 34128);
										$shm_bytes_written = write_command(1, 49); // same as save to flash command
										shmop_close($shm_id);
								}
								
							$mqueue_key = $config["t700-1"]["Messagequeue-key"];
							$shm_key  = $config["t700-1"]["Sharedmemory-key"];
							$shm_mode  = $config["t700-1"]["Sharedmemory-mode"];
							$shm_size  = $config["t700-1"]["Sharedmemory-size"];
							
							//$messagequeue = msg_get_queue($mqueue_key,0666);
								// Open memory for reading
								$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
								if($shm_id == FALSE) 
								{
									$json['error']="Cant open shared memory";
								}
								else
								{
										$shm_id = shmop_open($shm_key, "w", 0666, 34128);
										$shm_bytes_written = write_command(1, 49); // same as save to flash command
										shmop_close($shm_id);
								}	
						}

							break;
					 case "top_brush_down":
							if($state == 102)
							{
								//$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,102); // jos nappi ei ole painettu
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
							break;
					 case "top_brush_up":
							if($state == 98)
							{
								//$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,98); // jos nappi ei ole painettu
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
							break;
					 case "top_nozzle_up":
							if($state == 97)
							{
								//$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,97); // jos nappi ei ole painettu
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
							break;
					 case "top_nozzle_down":
							if($state == 101)
							{
								//$rand = rand(2, 255); // $rand = rand(1, 255); // updKHu
								$shm_bytes_written = write_command_move(1490,1,$mode);
							}
							else
							{
								if ($mode == "start")
								{
									$shm_bytes_written = write_command(31396,101); // jos nappi ei ole painettu
									usleep(200000); // sleep 200ms, updKHu
									$shm_bytes_written = write_command_move(1490,1,$mode); // Myös stroke viiveen päästä, updKHu
								}
							}
							break;
					case "side_brush_aside": // updKHu
						if($state == 103)
						{
							$stroke = ord(shmop_read($shm_id, 1490, 1));
							$stroke += 1;
							//$shm_bytes_written = write_command($messagequeue,1,1490,1,$rand);
							if ($stroke == 2)
							{
								write_command(GOUT_00 + 3,0); // Vasen sivuharja sivulle off
								write_command(GOUT_00 + 5,0); // Oikea sivuharja sivulle off
								$shm_bytes_written = write_command(31396,0);
								$shm_bytes_written = write_command(1490,0);
							}
						}
						else
						{
							$vsh_sivulla = ord(shmop_read($shm_id, 273, 1)); // vsh sivulla tila 500.13
							$osh_sivulla = ord(shmop_read($shm_id, 275, 1)); // osh sivulla tila 600.2
							if ($vsh_sivulla & 0x10)
								write_command(GOUT_00 + 3,1); // Vasen sivuharja sivulle on
							if ($osh_sivulla & 0x02)
								write_command(GOUT_00 + 5,1); // Oikea sivuharja sivulle on
							if (($vsh_sivulla & 0x10)  || ($osh_sivulla & 0x02))
							{
								$shm_bytes_written = write_command(31396,103);
								$shm_bytes_written = write_command(1490,1);
							}
						}
						break;
					}
		break;
}


function convert($shid, $offset)
{
	$byte_L = shmop_read($shid, $offset, 1);
	$byte_H = shmop_read($shid, $offset+1, 1);
    $word16b = ($byte_H << 8) + $byte_L;
	return $word16b;
}	
	
?>