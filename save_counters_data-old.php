<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

/* Include functions */
//include 'mysql_connect.php';


include 'sync/sync_server_functions.php';
include 'defines.php';


$select = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */
// Parse config
$config = parse_config($config_file_name);


include 'select_shared_mem.php';

//$messagequeue = msg_get_queue($mqueue_key,0666);

global $WASHCOUNTERS;

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
		case 'post':
		
				include 'mysql_connect_washcounters.php';
				
				$update = json_decode(file_get_contents('php://input'), true);
				$prognumber = $update['prognumber'];
			//	console.log("Prognumber:",$prognumber);
				
				if($prognumber != 0 && $counting == 0)
				{
                        $counting = 1;
                        //sleep(10);

						$prog_counter = ord(shmop_read($shid, $WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 2));
						if($prog_counter != 0)
						{
							//read old value fron the database
							$str = "Program".$prognumber;
							$result = mysqli_query($link, "SELECT $str FROM WashCounters");  
							$row = mysqli_fetch_array($result);
							// add 
							$sum = $row[$str] + $prog_counter; 
							// save new value to database
							$result2 = mysqli_query($link,"UPDATE WashCounters SET $str='$sum'");  

                            
							// clear value to zero (shared mem)
							if($result2)
							{
								$maxsleep = 0;

								$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'],0);
								$shm_bytes_written = write_command($WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER']+1,0);
								sleep(6);
								$prog_counter = ord(shmop_read($shid, $WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 2));
								while (($prog_counter != 0) && ($maxsleep < 5))
								{
									sleep(6);
									$maxsleep = $maxsleep + 1;
									$prog_counter = ord(shmop_read($shid, $WASHCOUNTERS['PROG_'.$prognumber.'_COUNTER'], 2));
								}
							}
						}
                        $counting = 0;
				}

				sleep(10);

		break;
		
}
	
?>