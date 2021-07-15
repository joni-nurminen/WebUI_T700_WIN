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

			if($version < 112)
			{		
		/*
				for($i=1;$i<31;$i++)
				{
					$str = "Program".$i;
					$result = mysql_query("SELECT $str FROM $washcounter",$link) or die(mysql_error());  
					$row = mysql_fetch_array($result);
					$count_value = $row[$str]; 
					$total_washes += $count_value;
					$washcounters_array[] = array("program" => $i, "sum" => $count_value);
				}	
				*/
			echo "No support for this version (".$version.") Version must be 115 or bigger";
			}
			else // Luetaan pesulaskurit jaetusta ja synkataan ne tietokantaan muistista kun versio 1.12 tai suurempi, updJN v4.7
			{
				for($i=1;$i<31;$i++)
				{					
					$str = "Program".$i;
					$count_value = ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2), 1));
					$count_value += (ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2)+1, 1))) << 8;
					
					$result = mysqli_query($link,"UPDATE $washcounter SET $str=$count_value");  
				}	
				
				if($result)
					echo "Washcounters synced succesfully.";
				else
					echo "Error. Can't sync washcounters to database";
			}
				

?>
