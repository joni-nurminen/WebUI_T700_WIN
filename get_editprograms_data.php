<?php
include 'select_shared_mem.php';
// get our verb
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$resource = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;

/* Include definations */
include 'defines.php';
/* Include functions */
include 'sync/sync_server_functions.php';
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

	$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
				
	if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
	{
		if($selected_machine == 1)
		{
			$mainprograms = "MainPrograms";
			$sideprogramrule = "SideProgramRule";
			$passstyles = "PassStyles";
		}
		else if($selected_machine == 2)
		{
			$mainprograms = "MainPrograms2";
			$sideprogramrule = "SideProgramRule2";
			$passstyles = "PassStyles2";
		}
	}
	else
	{
		$mainprograms = "MainPrograms";
		$sideprogramrule = "SideProgramRule";
		$passstyles = "PassStyles";
	}
		
		$prg = 0;
		$json = null;
		
		switch ($request_method)
		{
		
			case 'get':

				$number = intval($_GET["button"]);
				$prg = $_GET["prg"];
				

					switch ($prg)
					{
						case "side":
						if($number != 0)
						{
							$result = mysqli_query($link,"SELECT SideProgram, Cmr_SideProgram, id, LangId FROM $sideprogramrule WHERE MainId='$number' AND UseModule = '1' ORDER BY id ASC");
							while($row = mysqli_fetch_assoc($result))
								{
								 $json[] = $row;
								}
						}
							break;

						case "pass":
						if($number != 0)
						{
							$result = mysqli_query($link,"SELECT * FROM $passstyles WHERE pass_id='$number'");
							while($row = mysqli_fetch_assoc($result))
								{
								 $json[] = $row;
								}
						}							
						break;
						
						case "main":
					
							$result = mysqli_query($link,"SELECT MainProgram, Speed_MainProgram, Cmr_MainProgram, id, LangId FROM $mainprograms WHERE MainProgram != '' AND UseModule = '1' ORDER BY id ASC");
							while($row = mysqli_fetch_assoc($result))
								{
								 $json[] = $row;
								}
					
						break;
							
						default:
						
							if ($resource != null) 
							{   // query for children of $resource
								$result = mysqli_query($link,"SELECT MainProgram, Speed_MainProgram, Cmr_MainProgram, id, LangId FROM $mainprograms WHERE id=$resource' AND MainProgram != '' AND UseModule = '1' ORDER BY id ASC");
							}
							else 
							{
								$result = mysqli_query($link,"SELECT MainProgram, Speed_MainProgram, Cmr_MainProgram, id, LangId FROM $mainprograms WHERE MainProgram != '' AND UseModule = '1' ORDER BY id ASC");
							}
							while($row = mysqli_fetch_assoc($result))
								{
									$json[] = $row;
								}
					}
				
				echo json_encode($json), "\n";
				mysqli_free_result($result);
				break;
			// so are posts
			case 'post':
				// When adding new stuff ...
				break;
			// here's the tricky bit...
			case 'put':
				// basically, we read a string from PHP's special input location,
				// and then parse it out into an array via parse_str... per the PHP docs:
				// Parses str  as if it were the query string passed via a URL and sets
				// variables in the current scope.
				$update = json_decode(file_get_contents('php://input'), true);
				

				$u = $update['Cmr_MainProgram'];
				$i = $update['id'];
				mysqli_query($link,"UPDATE $mainprograms SET Cmr_MainProgram=$u WHERE id=$i");
				break;
		}

		
        
?>
