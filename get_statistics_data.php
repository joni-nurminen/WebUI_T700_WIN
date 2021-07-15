<?php

include "defines.php";
include "sync/sync_server_functions.php";

global $WASHCOUNTERS;

global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shm_key);
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}
	
	switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': 
			include 'mysql_connect_washcounters.php';
			include 'mysql_connect_data.php';
		
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			$version = ord(shmop_read($shid, VERSION_NRO , 1)); // read tammercontrol version, updKHu v4.7

			if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
			{
				if($selected_machine == 1)
					$washcounter = "WashCounters";
				else if($selected_machine == 2)
					$washcounter = "WashCounters2";
			}
			else
				$washcounter = "WashCounters";

			$washcounters_array = array();
			$total_washes = 0;
			$total_washes_db = 0;

			if($version < 112)
			{		
				for($i=1;$i<31;$i++)
				{
					$str = "Program".$i;
					$result = mysqli_query($link,"SELECT $str FROM $washcounter");
					if(!$result)
					{
					  echo("Error description: " . mysqli_error($link));
					}					
					$row = mysqli_fetch_array($result);
					$count_value = $row[$str]; 
					$total_washes += $count_value;
					$washcounters_array[] = array("program" => $i, "sum" => $count_value);
				}	
			}
			else // Luetaan pesulaskurit jaetusta muistista kun versio 1.12 tai suurempi, updKHu v4.7
			{
				for($i=1;$i<31;$i++)
				{					
					$str = "Program".$i;
					$result = mysqli_query($link,"SELECT $str FROM $washcounter");
					if(!$result)
					{
					  echo("Error description: " . mysqli_error($link));
					}					
					$row = mysqli_fetch_array($result);
					$count_value_db = $row[$str]; 
					$total_washes_db += $count_value_db;
					$count_value = ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2), 1));
					$count_value += (ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2)+1, 1))) << 8;
					$total_washes += $count_value;
					$washcounters_array[] = array("program" => $i, "sum" => $count_value." (".$count_value_db.")");
				}	
			}

			$washcounters_array_maintenance = array();
			$total_washes_maintenance = 0;
		
			for($i=1;$i<31;$i++)
			{
				$str = "Program".$i;
				$result = mysqli_query($link,"SELECT $str FROM WashCountersMaintenance");
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link));
				}				
				$row = mysqli_fetch_array($result);
				$count_value = $row[$str]; 
				$total_washes_maintenance += $count_value;
				$washcounters_array_maintenance[] = array("program" => $i, "sum" => $count_value);
			}
							
			$suspended_washes_l = ord(shmop_read($shid, SUSPENDED_WASHES, 1)); 
			$suspended_washes_h = ord(shmop_read($shid, SUSPENDED_WASHES+1, 1)); 
			$suspended_washes = ($suspended_washes_h << 8) + $suspended_washes_l;
				
				
			$washcounters_array[] = array("total" => 31, "sum" => $total_washes." (".$total_washes_db.")");
			$washcounters_array[] = array("suspended" => 32, "sum" => $suspended_washes);
			$washcounters_array[] = array("maintenance_washes" => $washcounters_array_maintenance);
				
			echo json_encode($washcounters_array), "\n";

         break;
		 
	}

?>
