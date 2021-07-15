<?php 
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

/* Include functions */
include 'sync/sync_server_functions.php';
include 'defines.php';


$select = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */
// Parse config
$config = parse_config($config_file_name);


include 'select_shared_mem.php';

//$messagequeue = msg_get_queue($mqueue_key,0666);

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );

if($shid == FALSE) 
	{
	$json['error']="Cant open shared memory";
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	return;
	}
global $MODULES;

$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype

if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
	{
		if($selected_machine == 1)
		{
			$sideprogramrule = "SideProgramRule";
			$mainprograms = "MainPrograms";

		}
		else if($selected_machine == 2)
		{
			$sideprogramrule = "SideProgramRule2";
			$mainprograms = "MainPrograms2";
		}
	}
	else
	{
			$sideprogramrule = "SideProgramRule";
			$mainprograms = "MainPrograms";
	}
	

$offline_test = shmop_read($shid, $MODULES["PROG1"], 11); // offline test
$id = (dechex(hexdec(ord( substr($offline_test, 0, 1))))); // mainprogram
//echo $id." ".$PROGRAMSCODE[$id]."<br>";

if($id == 0) // koodaamaton --> system is offline
	{
	echo json_encode(array('message' => "Using offline mode modules")), "\n";
	return;
	}

mysqli_query($link,"UPDATE $sideprogramrule SET UseModule='0'"); // set usemodules to zero first
mysqli_query($link,"UPDATE $mainprograms SET UseModule='0'"); // set mainmodules to zero first


for($i = 1; $i < count($MODULES)+1; $i++)
{
	$prog = "PROG".$i;

	$data = shmop_read($shid, $MODULES[$prog], 11); // read moduledata from shared mem 11 bytes per program
	$main_id = (dechex(hexdec(ord( substr($data, 0, 1))))); // mainprogram

	$result = mysqli_query($link,"UPDATE $mainprograms SET UseModule='1' WHERE id='$main_id'"); // set mainmodules


	$side1 = (dechex(hexdec(ord( substr($data, 1, 1)))));
	$side2 = (dechex(hexdec(ord( substr($data, 2, 1)))));
	$side3 = (dechex(hexdec(ord( substr($data, 3, 1)))));
	$side4 = (dechex(hexdec(ord( substr($data, 4, 1)))));
	$side5 = (dechex(hexdec(ord( substr($data, 5, 1)))));
	$side6 = (dechex(hexdec(ord( substr($data, 6, 1)))));
	$side7 = (dechex(hexdec(ord( substr($data, 7, 1)))));
	$side8 = (dechex(hexdec(ord( substr($data, 8, 1)))));
	$side9 = (dechex(hexdec(ord( substr($data, 9, 1)))));
	$side10 = (dechex(hexdec(ord( substr($data, 10, 1)))));

	$result = mysqli_query($link,"UPDATE $sideprogramrule SET UseModule='1' WHERE ( LangId='$side1' OR LangId='$side2' 
																							OR LangId='$side3'
																							OR LangId='$side4'
																							OR LangId='$side5'
																							OR LangId='$side6'
																							OR LangId='$side7'
																							OR LangId='$side8'
																							OR LangId='$side9' 
																							OR LangId='$side10') AND MainId='$main_id' "); // set sidemodules to 1 what we are going to use

	echo $i.". ".$PROGRAMSCODE[$main_id]."(".$main_id.")_".$side1."_".$side2."_".$side3."_".$side4."_".$side5."_".$side6."_".$side7."_".$side8."_".$side9."_".$side10."-->".$MODULES[$prog]. "<br>";

}
	if($result && $shid)
		echo json_encode(array('message' => "Modules synced from the shared mem")), "\n";
	else
		echo json_encode(array('message' => "Module syncing failed..")), "\n";


?>