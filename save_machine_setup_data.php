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

global $FUNCTIONS;


// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE)
{
    $json['error']="Cant open shared memory";
    $shid = shmop_open($shm_key, "c", 0666, $shm_size);
    return;
}

$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype

if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
{
    if($selected_machine == 1)
    {
        $iocardselections = "IoCardSelections";
        $machinesetupfunctions = "MachineSetupFunctions";
        $machinesetupdata = "MachineSetupData";
    }
    else if($selected_machine == 2)
    {
        $iocardselections = "IoCardSelections2";
        $machinesetupfunctions = "MachineSetupFunctions2";
        $machinesetupdata = "MachineSetupData2";
    }
}
else
{
    $iocardselections = "IoCardSelections";
    $machinesetupfunctions = "MachineSetupFunctions";
    $machinesetupdata = "MachineSetupData";
}

switch ($request_method)
{
case 'get':

    $machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
    $bay_type = ord(shmop_read($shid, BAY_TYPE + SHM_FLASH_CACHE, 1)); //bay type
    $door_control = ord(shmop_read($shid, DOOR_CONTROL + SHM_FLASH_CACHE, 1)); //doorcontrol
    $door_function = ord(shmop_read($shid, DOOR_FUNCTION + SHM_FLASH_CACHE, 1)); //doorfunction
    $sum_of_pumps = ord(shmop_read($shid, KP_PUMPS + SHM_FLASH_CACHE, 1)); //sum of pumps
    $sum_of_deiceseqs = ord(shmop_read($shid, DEICE_SEQS + SHM_FLASH_CACHE, 1)); //deice sequences
    $wax_type = ord(shmop_read($shid, VAHATYYPPI + SHM_FLASH_CACHE, 1)); //waxtype
	$foam_type = ord(shmop_read($shid, VAAHTOTYYPPI + SHM_FLASH_CACHE, 1)); //foamtype
    $operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem

    $json['chassis_wash'] = ord(shmop_read($shid, $FUNCTIONS[1] + SHM_FLASH_CACHE, 1)); //ALUSTAPESURI
    $json['wheel_wash'] = ord(shmop_read($shid, $FUNCTIONS[2] + SHM_FLASH_CACHE, 1)); //PYORAPESURI
    $json['prewash_2'] = ord(shmop_read($shid, $FUNCTIONS[3] + SHM_FLASH_CACHE, 1)); //TOINEN_ESIPESU
    $json['van_nozzles'] = ord(shmop_read($shid, $FUNCTIONS[4] + SHM_FLASH_CACHE, 1)); //PAKOSUUTTIMET
    $json['ro_water'] = ord(shmop_read($shid, $FUNCTIONS[5] + SHM_FLASH_CACHE, 1)); //OSMOOSIKAARI
    $json['wheel_brush'] = ord(shmop_read($shid, $FUNCTIONS[6] + SHM_FLASH_CACHE, 1)); //KP_HUUHT_KAARI
    $json['buffing_wax'] = ord(shmop_read($shid, $FUNCTIONS[7] + SHM_FLASH_CACHE, 1)); //HARJAVAHA_LAITE
    $json['wheel_prewash'] = ord(shmop_read($shid, $FUNCTIONS[8] + SHM_FLASH_CACHE, 1)); //PYORA_ESIPESU
    $json['tyre_shiner'] = ord(shmop_read($shid, $FUNCTIONS[9] + SHM_FLASH_CACHE, 1)); //PYORA_KIILLOTUS
    $json['opt_scanner'] = ord(shmop_read($shid, $FUNCTIONS[10] + SHM_FLASH_CACHE, 1)); //SCANNERILAITE
    $json['air_wax'] = ord(shmop_read($shid, $FUNCTIONS[11] + SHM_FLASH_CACHE, 1)); // ILMAVAHA
    $json['biojet_in_use'] = ord(shmop_read($shid, $FUNCTIONS[12] + SHM_FLASH_CACHE, 1)); //Biojet
    $json['drive_in_prewash'] = ord(shmop_read($shid, $FUNCTIONS[13] + SHM_FLASH_CACHE, 1)); //drivein prewash
    $json['option1'] = ord(shmop_read($shid, $FUNCTIONS[14] + SHM_FLASH_CACHE, 1)); //option1
    $json['option2'] = ord(shmop_read($shid, $FUNCTIONS[15] + SHM_FLASH_CACHE, 1)); //option2
    $json['option3'] = ord(shmop_read($shid, $FUNCTIONS[16] + SHM_FLASH_CACHE, 1)); //option3
    $json['option4'] = ord(shmop_read($shid, $FUNCTIONS[17] + SHM_FLASH_CACHE, 1)); //option4
    $json['option5'] = ord(shmop_read($shid, $FUNCTIONS[18] + SHM_FLASH_CACHE, 1)); //option5
    $json['option6'] = ord(shmop_read($shid, $FUNCTIONS[19] + SHM_FLASH_CACHE, 1)); //option6
    $json['option7'] = ord(shmop_read($shid, $FUNCTIONS[20] + SHM_FLASH_CACHE, 1)); //ifsf_config
    $json['option8'] = ord(shmop_read($shid, $FUNCTIONS[21] + SHM_FLASH_CACHE, 1)); //option8
    $json['option9'] = ord(shmop_read($shid, $FUNCTIONS[22] + SHM_FLASH_CACHE, 1)); //option9
    $json['option10'] = ord(shmop_read($shid, $FUNCTIONS[23] + SHM_FLASH_CACHE, 1)); //option10
    $json['option11'] = ord(shmop_read($shid, $FUNCTIONS[24] + SHM_FLASH_CACHE, 1)); //option11
    $json['option12'] = ord(shmop_read($shid, $FUNCTIONS[25] + SHM_FLASH_CACHE, 1)); //option12

    $json['machine_type']=$machine_type; // add machinetype
    $json['bay_type']=$bay_type; // add type
    $json['door_control']=$door_control; // add doorcontrol
    $json['door_function']=$door_function; // add doorfunction
    $json['sum_of_pumps']=$sum_of_pumps; // add sum of pumps
    $json['sum_of_deiceseqs']=$sum_of_deiceseqs; // add sum of deiceseqs
    $json['wax_type']=$wax_type; // add waxtype
	$json['foam_type']=$foam_type; // add foamtype
	

    $json['operation_mode']=$operation_mode; // get operation mode

    $result = mysqli_query($link, "SELECT * FROM $iocardselections");  // get selected machine number
	if(!$result)
	{
	  echo("Error description: " . mysqli_error($link));
	}
    $row = mysqli_fetch_array( $result );
    //	$selected_machine = $row['number'];

    $json['in1']=$row['in1']; // add input1
    $json['in2']=$row['in2'];
    $json['in3']=$row['in3'];
    $json['in4']=$row['in4'];
    $json['in5']=$row['in5'];
    $json['in6']=$row['in6'];

    $json['out1']=$row['out1']; // add output1
    $json['out2']=$row['out2'];
    $json['out3']=$row['out3'];
    $json['out4']=$row['out4'];
    $json['out5']=$row['out5'];
    $json['out6']=$row['out6'];
	
	$result = mysqli_query($link,"SELECT email_interval FROM $machinesetupdata");
	if(!$result)
	{
	  echo("Error description: " . mysqli_error($link));
	}
    $row = mysqli_fetch_array( $result );
    $json['email_interval']=$row['email_interval'];

    echo json_encode($json), "\n";

    break;

case 'post':
    $update = json_decode(file_get_contents('php://input'), true);

    $shm_data = ord(shmop_read($shid, 31324, 1)); // toimintatila
    if(($shm_data < 1)||($shm_data >4))
    {
		echo json_encode(array('message_err' => "Wrong operation mode!")), "\n";
        return;
    }
    if($select == "use_conf")
    {
        write_command(1, 49);
        return;
    }
    if($select == "card_selections")
    {
        $in1 = $update['in1'];
        $in2 = $update['in2'];
        $in3 = $update['in3'];
        $in4 = $update['in4'];
        $in5 = $update['in5'];
        $in6 = $update['in6'];

        $out1 = $update['out1'];
        $out2 = $update['out2'];
        $out3 = $update['out3'];
        $out4 = $update['out4'];
        $out5 = $update['out5'];
        $out6 = $update['out6'];

        //	mysql_query("INSERT INTO $iocardselections (in1,in2,in3,in4,in5,in6) VALUES (1,2,3,4,5,6)",$link);	// clear values first
        $result = mysqli_query($link,"UPDATE $iocardselections SET in1='$in1',
                              in2='$in2',
                              in3='$in3',
                              in4='$in4',
                              in5='$in5',
                              in6='$in6',
                              out1='$out1',
                              out2='$out2',
                              out3='$out3',
                              out4='$out4',
                              out5='$out5',
                              out6='$out6'");

        if($result)
            echo json_encode(array('message_ok' => "Selections successfully saved")), "\n";
        else
            echo json_encode(array('message_err' => "Saving failed!")), "\n";

        return;
    }
	if($select == "counters_conf")
    {
		 $email_interval = json_decode(file_get_contents('php://input'), true);
		 $email_interval = $update['email_interval'];
         $result = mysqli_query($link,"UPDATE $machinesetupdata SET email_interval='$email_interval'");
		 
		 //Seconds: 0-59
		 //Minutes: 0-59
		 //Hours: 0-23
		 //Day of Month: 1-31
		 //Months: 0-11
		 //Day of Week: 0-6
		 
		 if($result)
		 {
			 if($email_interval == 0) // every week
				$output = shell_exec('sh createCronJob.sh 0 0 \* \* 6');
			 else  if($email_interval == 1) // every month
				$output = shell_exec('sh createCronJob.sh 0 0 1 \* \*');
			 else
				$output = shell_exec('sh createCronJob.sh 0 0 1 \* \*');
			
			 echo json_encode(array('message_ok' => "Setting saved. ".$output)), "\n";
		 }
		 else
			  echo json_encode(array('message_err' => "Cant save machinesetupdata to database")), "\n";
    }
	
    if($select == "selections")
    {
		
		$array_update = array();
		$array_update_send = array();
		$array_clear = array();
		$array_clear_send = array();
		
		for($i = 1; $i<=count($FUNCTIONS); $i++)
		{	
			$array_clear['offset'] =  $FUNCTIONS[$i]+ SHM_FLASH_CACHE; // offset
			$array_clear['cmd'] = "0"; // cmd	
			$array_clear_send[] = $array_clear;
		}
		write_array_mixed(array("mixed", $array_clear_send));
		

		for($i = 0; $i<=count($FUNCTIONS); $i++)
		{
			for($j = 1; $j<=25; $j++)
			{
				if($j == $update[$i])
				{
					$array_update['offset'] =  $FUNCTIONS[$j]+ SHM_FLASH_CACHE; // offset
					$array_update['cmd'] = "1"; // cmd	
					$array_update_send[] = $array_update;
				}
			}
		}
		write_array_mixed(array("mixed", $array_update_send));
		
	
/*
		for($i = 1; $i<=26; $i++)
		{
			if($i == $update[$i-1])
			{
			 
				$data[] = "1";
				//array_push($data,1);
				$res = mysqli_query($link,"UPDATE $machinesetupfunctions SET value=1 WHERE id='$i'"); // save values to the database
				if(!$res)
				{
					echo json_encode(array('message_err' => "Can't save settings to DB")), "\n";
					return;
				}
			}
			else
			{
				$data[] = "0";
			//	array_push($data,0);
				$res = mysqli_query($link,"UPDATE $machinesetupfunctions SET value=0 WHERE id='$i'"); // save values to the database
				if(!$res)
				{
					echo json_encode(array('message_err' => "Can't save settings to DB")), "\n";
					return;
				}
			}
		}
			*/
		
		echo json_encode(array('message_ok' => "Settings saved! Reloading page..")), "\n";
    }
    if($select == "conf_types")
    {
        $machine_type = $update['machine_type'];
        $bay_type = $update['bay_type'];
        $door_control = $update['door_control'];
        $door_function = $update['door_function'];
        $sum_of_pumps = $update['sum_of_pumps'];
        $sum_of_deiceseqs = $update['sum_of_deiceseqs'];
        $wax_type = $update['wax_type'];
		$foam_type = $update['foam_type'];

        // save paramaters to database
        $res = mysqli_query($link,"UPDATE $machinesetupdata SET machine_type='$machine_type',
                    bay_type='$bay_type',
                    door_control='$door_control',
                    door_function='$door_function',
                    sum_of_pumps='$sum_of_pumps',
                    sum_of_deiceseqs='$sum_of_deiceseqs',
                    wax_type='$wax_type',
					foam_type='$foam_type'");

		if(!$res)
		{
			echo json_encode(array('message_err' => "Can't save settings to DB")), "\n";
			return;
		}
        /*  save paramaters also to shared memory*/

        write_command(MACHINE_TYPE + SHM_FLASH_CACHE,$machine_type);
        write_command(BAY_TYPE + SHM_FLASH_CACHE,$bay_type);
        write_command(DOOR_CONTROL + SHM_FLASH_CACHE,$door_control);
        write_command(DOOR_FUNCTION + SHM_FLASH_CACHE,$door_function);
        write_command(KP_PUMPS + SHM_FLASH_CACHE,$sum_of_pumps);
        write_command(DEICE_SEQS + SHM_FLASH_CACHE,$sum_of_deiceseqs);
        write_command(VAHATYYPPI + SHM_FLASH_CACHE,$wax_type);
		write_command(VAAHTOTYYPPI + SHM_FLASH_CACHE,$foam_type);
		
		echo json_encode(array('message_ok' => "Settings saved.")), "\n";

    }
    sleep(1);

    break;
}

// close connection
mysqli_close($link);


?>
