<?php
include "defines.php";
include "sync/sync_server_functions.php";

global $WASHCOUNTERS;

$data = json_decode(file_get_contents('php://input'), true);
$station = 	$data['data']; 	

global $config_file_name; 	
$config_file_name = "/var/www/html/sync/sync_server.conf";

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
$station_name = shmop_read($shid, STATION_NAME , 256); // read station name version v4.7

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
		$result = mysqli_query($link, "SELECT $str FROM $washcounter");  
		$row = mysqli_fetch_array($result);
		$count_value = $row[$str]; 
		$total_washes += $count_value;
		$washcounters_array[] = array("program" => $i, "sum" => $count_value);
	}	
}
else // Luetaan pesulaskurit jaetusta muistista kun versio 1.12 tai suurempi, updKHu v4.7
{
	$msg = "<table id='counters'><tr><th>Ohjelma</th><th>Pesuja</th></tr>";
	for($i=1;$i<31;$i++)
	{
		$str = "Program".$i;
		$result = mysqli_query($link,"SELECT $str FROM $washcounter");  
		$row = mysqli_fetch_array($result);
		$count_value_db = $row[$str]; 
		$total_washes_db += $count_value_db;
		
		$count_value = ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2), 1));
		$count_value += (ord(shmop_read($shid, WASHING_COUNTER_BUP+(($i-1)*2)+1, 1))) << 8;
		$total_washes += $count_value;
		$washcounters_array[] = array("program" => $i, "sum" => $count_value." (".$count_value_db.")");
		
		$msg .= "<tr><td>Ohjelma ".$i."</td><td>".$count_value." (".$count_value_db.")</td></tr>";
	}	
	$msg .= "<tr style='background: #00A2D8;'><td>TOTAL:</td><td>".$total_washes." (".$total_washes_db.")</td></tr>";
	$msg .= "</tr></table>";
}

$message = '<html><body>';
$message .= '<head>
<style>
#counters {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 400px;
}

#counters td, #counters th {
  border: 1px solid #ddd;
  padding: 5px 5px 0px 5px;
}

#counters tr:nth-child(even){background-color: #f2f2f2;}

#counters tr:hover {background-color: #ddd;}

#counters th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>';
$message .= $msg;
$message .= '</body></html>';

$pos = strpos($station_name, '*');
$station_name = substr($station_name, 0, $pos-1);

$to = 'pesulukemat@tammermatic.com';
//$to = 'joni.nurminen@microteam.fi';
$subject = $station_name." Ver:".$version." pesulaskurit";
$headers = "From: webmaster@example.com" . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$result = mail($to, $subject, $message, $headers);
//$result = 1;

if($result)
	echo "Send ok.";
else
	echo "Send failed.";
?>