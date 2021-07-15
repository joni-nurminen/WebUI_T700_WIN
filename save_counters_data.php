<?php
include 'sync/sync_server_functions.php';
include 'defines.php';

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

//$messagequeue = msg_get_queue($mqueue_key,0666);

global $WASHCOUNTERS;
include 'mysql_connect_washcounters.php';
include 'mysql_connect_data.php';

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
        $json['error']="Cant open shared memory";
        $shid = shmop_open($shm_key, "c", 0666, $shm_size);
        return;
	}
	
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
				$maintenance = ord(shmop_read($shid,MAINTENANCE_MODE, 1)); // read if machine is in MAINTENANCE_MODE
				
				$result = mysqli_query($link2,"SELECT number FROM SelectedMachine");  // get selected machine number
				$row = mysqli_fetch_array( $result );
				$selected_machine = $row['number'];
				
				if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
				{
					if($selected_machine == 1)
						$washcounter = "WashCounters";
					else if($selected_machine == 2)
						$washcounter = "WashCounters2";
				}
				else
					$washcounter = "WashCounters";
				
				if($maintenance == 1) // maintenance mode is set. Use maintenance counters
					$washcounter = "WashCountersMaintenance";

				$update = json_decode(file_get_contents('php://input'), true);
				$prognumber = $update['prognumber'];
				$loop = 0;

				if( $prognumber != 0 )
				{
						$prog_counter = ord(shmop_read($shid, $WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 2));

						if($prog_counter != 0)
						{
						//$date = new DateTime();
					//	$timestamp =  get_remote_uptime_seconds("t700-1");//$date->getTimestamp();
					//	$timestamp = explode(".", $timestamp);
						$timestamp = date();//$timestamp[0];
						
							//DEBUG
							// $myFile = "/tmp/wcounters.txt";
							// $timestamp = date("d M Y H:i:s");
							// $stringData = $timestamp." 1.WCounters Prog:".$prognumber." ProgCounter:".$prog_counter."\n";
							// $fh = fopen($myFile, 'a') or die("can't open file");
							// fwrite($fh, $stringData);
							// fclose($fh);	

							//read old value fron the database
							$str = "Program".$prognumber;
							$result = mysqli_query($link,"SELECT $str FROM $washcounter");  
							$row = mysqli_fetch_array($result);
							// add 
							$sum = $row[$str] + $prog_counter; 
							// save new value to database
						
							$time = mysqli_query($link,"SELECT Timestamp FROM $washcounter");  
							$row = mysqli_fetch_array($time);
							$oldTimestamp = $row[0];
								
							if($timestamp > $oldTimestamp +5 || $timestamp < $oldTimestamp -5)
							{
								$result2 = mysqli_query($link,"UPDATE $washcounter SET $str='$sum'");  
								$result3 = mysqli_query($link,"UPDATE $washcounter SET Timestamp='$timestamp'");  
							}
							
							//DEBUG
							// $myFile = "/tmp/wcounters.txt";
							// $timestamp = date("d M Y H:i:s");
							// $stringData = $timestamp." 2.WCounters Prog:".$prognumber." ProgCounter:".$prog_counter." Sum:".$sum." r2:".$result2."\n";
							// $fh = fopen($myFile, 'a') or die("can't open file");
							// fwrite($fh, $stringData);
							// fclose($fh);	
                            
							// clear value to zero (shared mem)
							if($result2)
							{
								$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 0);
								$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER']+1,0);
								sleep(2);
								
                                $loop = 0;									
								for($i = 0;$i < 10; $i++)
								{
									$prog_counter = ord(shmop_read($shid, $WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 2));

									if($prog_counter != 0)
									{
										
										$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'],0);
										$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER']+1,0);
										$loop++;
									}
									else
									{
										break;
									}
								
								    usleep(5000);
								}
								
								//DEBUG
								// $myFile = "/tmp/wcounters.txt";
								// $timestamp = date("d M Y H:i:s");
								// $stringData = $timestamp." 3.WCounters Prog:".$prognumber." ProgCounter:".$prog_counter." Forloops:".$loop."\n\n";
								// $fh = fopen($myFile, 'a') or die("can't open file");
								// fwrite($fh, $stringData);
								// fclose($fh);	

							}

							//DEBUG
							// $myFile = "/tmp/wcounters.txt";
							// $timestamp = date("d M Y H:i:s");
							// $stringData = $timestamp." 4.WCounters Prog:".$prognumber." ProgCounter:".$prog_counter."\n";
							// $stringData2 = "-------------------------------------------------------------------------------------\n";
							// $fh = fopen($myFile, 'a') or die("can't open file");
							// fwrite($fh, $stringData);
							// fwrite($fh, $stringData2);
							// fclose($fh);	

						}
				}	

	
?>