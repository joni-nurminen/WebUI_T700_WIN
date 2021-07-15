<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
// selected slotnumber
$buttonNumber = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* SaveProgram.php/4 */

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
			$savedprograms = "SavedPrograms";
			$copiedprogram = "CopiedProgram";
			$loadedset = "LoadedSet";
			$checksum = "CheckSum";
		}
		else if($selected_machine == 2)
		{
			$savedprograms = "SavedPrograms2";
			$copiedprogram = "CopiedProgram2";
			$loadedset = "LoadedSet2";
			$checksum = "CheckSum2";
		}
	}
	else
	{
		$savedprograms = "SavedPrograms";
		$copiedprogram = "CopiedProgram";
		$loadedset = "LoadedSet";
		$checksum = "CheckSum";
	}
	

switch ($request_method)
		{
		case 'get':		
					
			switch($buttonNumber)
			{
				case "set_1": // show programs from behind set 1
					$part = explode("_", $buttonNumber);
					$p = $part[1];
					$result = mysqli_query($link,"SELECT Program_Type, SlotNumber, id FROM $savedprograms WHERE Set_Number = '$p' ORDER BY SlotNumber");
					while($row = mysqli_fetch_assoc($result))
					{
					 $json[] = $row;
					}
				break;
				
				case "set_2": // show programs from behind set 2
					$part = explode("_", $buttonNumber);
					$p = $part[1];
					$result = mysqli_query($link,"SELECT Program_Type, SlotNumber, id FROM $savedprograms WHERE Set_Number = '$p' ORDER BY SlotNumber");
					while($row = mysqli_fetch_assoc($result))
					{
					 $json[] = $row;
					}
				break;
				
				case "set_3":// show programs from behind set 3
					$part = explode("_", $buttonNumber);
					$p = $part[1];
					$result = mysqli_query($link,"SELECT Program_Type, SlotNumber, id FROM $savedprograms WHERE Set_Number = '$p' ORDER BY SlotNumber");
					while($row = mysqli_fetch_assoc($result))
					{
					 $json[] = $row;
					}
				break;
				
				case "set_4": // show programs from behind set 4
					$part = explode("_", $buttonNumber);
					$p = $part[1];
					$result = mysqli_query($link,"SELECT Program_Type, SlotNumber, id FROM $savedprograms WHERE Set_Number = '$p' ORDER BY SlotNumber");
					while($row = mysqli_fetch_assoc($result))
					{
					 $json[] = $row;
					}
				break;
					
			break;
			}
		
			if($buttonNumber == "sync")
			{
					$operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem

					if($operation_mode == 9 || $operation_mode == 2 || $operation_mode == 3) // if mode is maintenance, idle or closed
					{

						SaveToSharedMemomory($deleteonly, $update, true, $link, $link2, $selected_machine,$savedprograms, $loadedset); // sync all washing programs to shared memory
						echo json_encode(array('sync_done' => 'done')), "\n"; // send sync ok message
						return;
					}
					else
					{
						echo json_encode(array('mode' => $operation_mode)), "\n";
						return;
					}
			}
			if($buttonNumber == "operationmode")
			{
				$operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem

				echo json_encode(array('mode' => $operation_mode)), "\n";
				return;	
			}
			if($buttonNumber == "get_copied_program")
			{				
				$result = mysqli_query($link,"SELECT * FROM $copiedprogram ORDER BY id");
				while($row = mysqli_fetch_assoc($result))
				{
				 $json[] = $row;
				}
			}
		
			if($buttonNumber == 100)
			{	// show all programs
				sleep(1);
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
				
				
				$result = mysqli_query($link2,"SELECT set_number,synced_set FROM $loadedset");
				$row = mysqli_fetch_array( $result );
				$json[] = $row['set_number'];
				$json[] = $row['synced_set'];
				
				if($machine_type == 5) // machine is twin 1
				{
					
					if(!shared_mem_compare("t700-1","t700-2",SHM_FLASH_CACHE,16383)) // if both are same in shared mem
					{
						$json[] = "false";
					}
					else
						$json[] = (array('sum' => "Both memorys OK"));
				}
				else // machinetype is single
				{
					if($machine_type != 5 || $machine_type != 6) // machine is not twinmachine
					{
						if($selected_machine == 1) // master valittu
							$machine = "t700-1";
						else if($selected_machine == 2) // slave valittu
							$machine = "t700-2";
						else
						 	$machine = "t700-1";
					}
					else
						$machine = "t700-1";
					
					$result = mysqli_query($link2,"SELECT sum FROM $checksum"); // get old sum from the database
					$row = mysqli_fetch_array( $result );
					$old_sum = $row['sum'];
				
					$sum = get_mem_size($machine,SHM_FLASH_CACHE,16383);
					
			//		$result = mysql_query("UPDATE CheckSum SET sum='$sum'",$link2);
					

						if($old_sum != $sum) // if sum from shared memory is not same with saved sum
						{
							$json[] = (array('sum' => $sum));
							$json[] = (array('old_sum' => $old_sum));
							
							$operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem

							if($operation_mode == 9 || $operation_mode == 2 || $operation_mode == 3) // if mode is maintenance, idle or closed
							{
						//		SaveToSharedMemomory($deleteonly, $update, true, $link, $link2, $selected_machine); // sync all washing programs to shared memory
								sleep(3);
								$sum = get_mem_size($machine,SHM_FLASH_CACHE,16383); // get new sum
								$result = mysqli_query($link2,"UPDATE $checksum SET sum='$sum'"); // update sum from shared mem to databaseF
							}
						}
						else
						{
							$json[] = (array('sum' => $sum));
							$json[] = (array('old_sum' => $old_sum));
						}

				}
				
				$result = mysqli_query($link,"SELECT Program_Type, SlotNumber, id FROM $savedprograms WHERE id = 1 ORDER BY SlotNumber");
				while($row = mysqli_fetch_assoc($result))
					{
					 $json[] = $row;
					}
				
				
					//SaveToSharedMemomory($deleteonly, $update, true); // debug call
			}
			else
			{
				$result = mysqli_query($link,"SELECT * FROM $savedprograms WHERE SlotNumber='$buttonNumber' ORDER BY id");
				while($row = mysqli_fetch_assoc($result))
				{
				 $json[] = $row;
				}
			}		
				echo json_encode($json), "\n";
		break;
		
		case 'post':
			$update = json_decode(file_get_contents('php://input'), true);
			$slot_nro = $update['copy_slot'];
			
			if($update['copy'] == "copy_program") // copy selected program to "clipboard"
			{
				mysqli_query($link,"DELETE FROM $copiedprogram"); // do some space. delete program if exists
				
				$result = mysqli_query($link,"INSERT INTO $copiedprogram SELECT * FROM $savedprograms WHERE SlotNumber=$slot_nro ORDER BY id ASC");
				
				if($result)
					echo json_encode(array('copy_done' => 'Program copied successfully')), "\n"; // send copy ok message
				else
					echo json_encode(array('copy_done' => 'Program copying failed')), "\n"; // send sync ok message
					
				return;
			}
			
			if($update['copy'] == "copy_program_to_set") // copy selected program from "clipboard" to set
			{
				mysqli_query($link,"DELETE FROM $savedprograms WHERE SlotNumber='$slot_nro'"); // do some space. delete program if exists
					
				$result = mysqli_query($link,"UPDATE $copiedprogram SET SlotNumber='$slot_nro'");
				
				$result = mysqli_query($link,"INSERT INTO $savedprograms SELECT * FROM $copiedprogram");
				
				//SaveToSharedMemomory($deleteonly, $update, true, $link, $link2);
				
				if($result)
					echo json_encode(array('copy_done' => 'Program copied to set successfully')), "\n"; // send copy ok message
				else
					echo json_encode(array('copy_done' => 'Program copying to set failed')), "\n"; // send sync ok message
					
				return;
			}
			
			if($update['sync_sets']  != null)
			{
						$result = mysqli_query($link2,"SELECT set_number FROM $loadedset"); // get loaded set from database
						if(!$result)
						{
						  echo("Error description: " . mysqli_error($link2));
						} 
						
						$row = mysqli_fetch_array( $result );
						$val = $row['set_number'];
						mysqli_query($link2,"UPDATE $loadedset SET synced_set='$val'"); // set it to synced also
						
			}
			
			if($update['program_set'] != null)
			{
				$set_number = $update['program_set'];
			}
			
			$deleteonly = $update['deleteall'] == "delete";
			
			if($deleteonly)
			{
				$slot = $update['SlotNumber'];
			}
			else
			{
				$slot = $update[0]['SlotNumber'];
			}
			
				mysqli_query($link,"DELETE FROM $savedprograms WHERE SlotNumber='$slot'");
				if (!$deleteonly)
				{	// save data to database
					for($i=0;$i<count($update);$i++)
					{
						$var0 = $update[$i]['SlotNumber'];
						$var1 = $update[$i]['id'];
						$var2 = $update[$i]['Direction'];
						$var3 = $update[$i]['MainProgram'];
						$var4 = $update[$i]['Cmr_MainProgram'];
						$var5 = $update[$i]['PassStyle'];
						$var6 = $update[$i]['SideProgram1'];
						$var7 = $update[$i]['Cmr_SideProgram1'];
						$var8 = $update[$i]['SideProgram2'];
						$var9 = $update[$i]['Cmr_SideProgram2'];
						$var10 = $update[$i]['SideProgram3'];
						$var11 = $update[$i]['Cmr_SideProgram3'];
						$var12 = $update[$i]['SideProgram4'];
						$var13 = $update[$i]['Cmr_SideProgram4'];
						$var14 = $update[$i]['SideProgram5'];
						$var15 = $update[$i]['Cmr_SideProgram5'];
						$speed = $update[$i]['Speed_MainProgram'];
						
						$type = $update[$i]['Program_Type'];
						$set_number = $update[$i]['Set_Number'];
						$lang = $update[$i]['LangIdMain'];
						$lang_s1 = $update[$i]['LangIdSide1'];
						$lang_s2 = $update[$i]['LangIdSide2'];
						$lang_s3 = $update[$i]['LangIdSide3'];
						$lang_s4 = $update[$i]['LangIdSide4'];
						$lang_s5 = $update[$i]['LangIdSide5'];

							mysqli_query($link,"INSERT INTO $savedprograms (
												SlotNumber, 
												id,
												Direction, 
												MainProgram, 
												LangIdMain,
												Cmr_MainProgram, 
												PassStyle, 
												SideProgram1,
												LangIdSide1,
												Cmr_SideProgram1, 
												SideProgram2,
												LangIdSide2,
												Cmr_SideProgram2, 
												SideProgram3,
												LangIdSide3,
												Cmr_SideProgram3, 
												SideProgram4,
												LangIdSide4,
												Cmr_SideProgram4,
												SideProgram5,
												LangIdSide5,
												Cmr_SideProgram5,
												Speed_MainProgram,
												Program_Type,
												Set_Number
												)
							VALUES ('$var0','$var1', '$var2', '$var3', '$lang', '$var4', '$var5', '$var6', '$lang_s1', '$var7', '$var8', '$lang_s2', '$var9', '$var10','$lang_s3', '$var11', '$var12','$lang_s4', '$var13','$var14','$lang_s5','$var15','$speed','$type','$set_number')");
					}
				}
		
				// program to shared memory
		 SaveToSharedMemomory($deleteonly, $update, false, $link, $link2,$selected_machine,$savedprograms,$loadedset);
		 sleep(3);
		 
		 $machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
		 if($machine_type != 5 ||  $machine_type != 6)
		 {
				if($selected_machine == 1)
					$m = "t700-1";
				else if($selected_machine == 2)
					$m = "t700-2";
				else
					$m = "t700-1";
		 }
		 
		 $sum = get_mem_size($m,SHM_FLASH_CACHE,16383); // get new sum
		 $result = mysqli_query($link2,"UPDATE $checksum SET sum='$sum'"); // update sum from shared mem to database
		break;
		}

	function SaveToSharedMemomory($deleteonly, $update, $sync, $link, $link2,$selected_machine,$savedprograms, $loadedset)
	{
	//global $messagequeue;
	global $PROGRAM_OFFSETS;
	global $PROGRAMS;
	global $PASS_STYLES;
	global $shid;
	
		if($sync)
		{
			
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			global $config_file_name;
			// Open config data
			$config = parse_config($config_file_name);
					
			if($machine_type == 5)
			{
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					write_command_clear(2252,16384);   // start offset and how many bytes to clear  
					
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					write_command_clear(2252,16384);     // start offset and how many bytes to clear 
			}
			else // singlemachine
			{
					if($selected_machine == 1)
						$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					else if($selected_machine == 2)
						$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					else
						$mqueue_key = $config["t700-1"]["Messagequeue-key"];
						
					write_command_clear(2252,16384);     // start offset and how many bytes to clear   
			}
				
		    sleep(3);
		
			$result = mysqli_query($link,"SELECT SlotNumber FROM $savedprograms WHERE SlotNumber > 0");
			
					$c = 1;
					while($row = mysqli_fetch_assoc($result))
					{
						
						if($dupclicate != $row['SlotNumber'])
						{
						//	echo $dupclicate. " " .  $row['SlotNumber']."<br>";
							$slotNumbers_arr[$c++] = $row['SlotNumber'];
							$dupclicate = $row['SlotNumber'];
						}
					}
					$program_arr = array_unique($slotNumbers_arr); //  remove duplicates
					
					
				//	print_r($program_arr);
				//	echo "<br>";
					for($i = 1; $i < count($program_arr)+1; $i++)
					{
					//	echo $program_arr[$i]." " . $i."<br>";
						if($program_arr[$i] != null) // something is saved behind slotnumber
						{
					//		echo $program_arr[$i]."<br>";
							$numb = $program_arr[$i];
							
							if($numb < 1)
								return;
							
							$result = mysqli_query($link,"SELECT * FROM $savedprograms WHERE SlotNumber=$numb ORDER BY id ASC"); // get program data from selected slot
							$num_rows = mysqli_num_rows($result);
					//		echo "<br>num_rows : ". $num_rows . " slot : ".$i . "<br>";
							
							$prog_num = "OHJ0".$numb;
					//		echo $prog_num;
							$StartOffset = $PROGRAM_OFFSETS[$prog_num]; // get offset 
						//	echo $prog_num. " " .$StartOffset. "<-- ohjelmaa";
						//	echo "<br>";
							
							$prog = array();
							while($row = mysqli_fetch_assoc($result))
							{
								$prog[] =			$PROGRAMS[$row['MainProgram']]; // Program function
								$prog[] = 			$PASS_STYLES[$row['PassStyle']];  // Pass style
								$prog[] = 			intval($row['Speed_MainProgram']); // Speed
								$prog[] =			intval($row['Cmr_MainProgram']);  // Main function Chemical Mixing Ratio
								$prog[] =			0x00;
								$prog[] =			0x00;
								$prog[] =			$PROGRAMS[$row['SideProgram1']];   // Parallel function 1
								$prog[] =			intval($row['Cmr_SideProgram1']);// Parallel function 1 Chemical Mixing Ratio
								$prog[] =			$PROGRAMS[$row['SideProgram2']]; // Parallel function 2
								$prog[] =			intval($row['Cmr_SideProgram2']); // Parallel function 2 Chemical Mixing Ratio
								$prog[] =			$PROGRAMS[$row['SideProgram3']]; // Parallel function 3
								$prog[] =			intval($row['Cmr_SideProgram3']);// Parallel function 3 Chemical Mixing Ratio
								$prog[] =			$PROGRAMS[$row['SideProgram4']];// Parallel function 4
								$prog[] =			intval($row['Cmr_SideProgram4']); // Parallel function 4 Chemical Mixing Ratio
								$prog[] =			$PROGRAMS[$row['SideProgram5']];// Parallel function 5
								$prog[] =			intval($row['Cmr_SideProgram5']); // Parallel function 5 Chemical Mixing Ratio
							}
							if(count($program_arr) > 0)
							{
								for($k=0; $k < 16; $k++)
								{
									$prog[] = 0x00; // 16 tyhjää merkkiä loppuun
								}
							}		

							$sum = (int)(intval($StartOffset) + 2252); // offset to write
							
							if($machine_type == 5) // machine is twin 1
							{    
								$mqueue_key = $config["t700-1"]["Messagequeue-key"];
								//$messagequeue = msg_get_queue($mqueue_key,0666);
								write_programline(array("program",$sum, count($prog), $prog)); // write program to master shared memory
								
								$mqueue_key = $config["t700-2"]["Messagequeue-key"];
								//$messagequeue = msg_get_queue($mqueue_key,0666);
								write_programline(array("program",$sum, count($prog), $prog)); // write program to slave shared memory
							}
							else // singlemachine
							{
								if($selected_machine == 1)
									$mqueue_key = $config["t700-1"]["Messagequeue-key"];
								else if($selected_machine == 2)
									$mqueue_key = $config["t700-2"]["Messagequeue-key"];
								else
									$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					
								//$messagequeue = msg_get_queue($mqueue_key,0666);
								write_programline(array("program",$sum, count($prog), $prog)); // write program to master shared memory
							}


						//	echo "<br><br>";
						}
						else
						{
						
						}
					}
		}			
		else if($deleteonly) // just remove whole program from the shared memory
		{
			$result = mysqli_query($link2,"SELECT set_number,synced_set FROM $loadedset");
			$row = mysqli_fetch_array( $result );
			$set = $row['set_number'];
			$synced_set = $row['synced_set'];
			
			if($set != $synced_set)
			{
				$json[] = (array('message' => "Set in shared memory is: ".$synced_set.". Selected set is : ".$set." --> No syncing.."));
				echo json_encode($json), "\n";
				return;
			}
			
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			global $config_file_name;
			// Open config data
			$config = parse_config($config_file_name);
			
			$prog = "OHJ0".$update['SlotNumber'];
			$StartOffset = $PROGRAM_OFFSETS[$prog];
			$sum = (int)(intval($StartOffset) + 2252);
			$data = array();
			
			for($k=0; $k < 16; $k++)
			{
				$data[] = 0x00; // 16 tyhjää merkkiä alkuun
			}
			
			if($machine_type == 5) // machine is twin 1
			{
				$mqueue_key = $config["t700-1"]["Messagequeue-key"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to master shared memory
				
				$mqueue_key = $config["t700-2"]["Messagequeue-key"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to slave shared memory
				
				$json[] = (array('message' => "Single program removed from both machines"));
			echo json_encode($json), "\n";
			}
			else
			{
					if($selected_machine == 1)
						$mqueue_key = $config["t700-1"]["Messagequeue-key"];
					else if($selected_machine == 2)
						$mqueue_key = $config["t700-2"]["Messagequeue-key"];
					else
						$mqueue_key = $config["t700-1"]["Messagequeue-key"];
						

				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to master shared memory
				
				$json[] = (array('message' => "Single program removed"));
			echo json_encode($json), "\n";
			}

		}
		else
		{
			$result = mysqli_query($link2,"SELECT set_number,synced_set FROM $loadedset");
			$row = mysqli_fetch_array( $result );
			$set = $row['set_number'];
			$synced_set = $row['synced_set'];
			
			if($set != $synced_set)
			{
				$json[] = (array('message' => "Set in shared memory is: ".$synced_set.". Selected set is : ".$set." --> No syncing.."));
				echo json_encode($json), "\n";
				return;
			}
			
			
			
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
			global $config_file_name;
			// Open config data
			$config = parse_config($config_file_name);
		
			if($update[0]['SlotNumber'] < 1)
				return;
				
			$prog = "OHJ0".$update[0]['SlotNumber'];
			$StartOffset = $PROGRAM_OFFSETS[$prog];

			$data = array();
			
			
			for($i=0;$i < count($update); $i++)
			{
				$data[] =			$PROGRAMS[$update[$i]['MainProgram']]; // Program function
				$data[] = 			$PASS_STYLES[$update[$i]['PassStyle']];  // Pass style
				$data[] = 			intval($update[$i]['Speed_MainProgram']); // Speed
				$data[] =			intval($update[$i]['Cmr_MainProgram']);  // Main function Chemical Mixing Ratio
				$data[] =			0x00;
				$data[] =			0x00;
				$data[] =			$PROGRAMS[$update[$i]['SideProgram1']];   // Parallel function 1
				$data[] =			intval($update[$i]['Cmr_SideProgram1']);// Parallel function 1 Chemical Mixing Ratio
				$data[] =			$PROGRAMS[$update[$i]['SideProgram2']]; // Parallel function 2
				$data[] =			intval($update[$i]['Cmr_SideProgram2']); // Parallel function 2 Chemical Mixing Ratio
				$data[] =			$PROGRAMS[$update[$i]['SideProgram3']]; // Parallel function 3
				$data[] =			intval($update[$i]['Cmr_SideProgram3']);// Parallel function 3 Chemical Mixing Ratio
				$data[] =			$PROGRAMS[$update[$i]['SideProgram4']];// Parallel function 4
				$data[] =			intval($update[$i]['Cmr_SideProgram4']); // Parallel function 4 Chemical Mixing Ratio
				$data[] =			$PROGRAMS[$update[$i]['SideProgram5']];// Parallel function 5
				$data[] =			intval($update[$i]['Cmr_SideProgram5']); // Parallel function 5 Chemical Mixing Ratio
			}	
			

			if(count($update) > 0)
			{

					for($k=0; $k < 16; $k++)
					{
						$data[] = 0x00; // 16 tyhjää merkkiä loppuun
					}
			}		

			
				
			$sum = (int)(intval($StartOffset) + 2252);
			
			if($machine_type == 5) // machine is twin 1
			{
				$mqueue_key = $config["t700-1"]["Messagequeue-key"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to master shared memory
				
				$mqueue_key = $config["t700-2"]["Messagequeue-key"];
				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to slave shared memory
			}
			else
			{
				if($selected_machine == 1)
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
				else if($selected_machine == 2)
					$mqueue_key = $config["t700-2"]["Messagequeue-key"];
				else
					$mqueue_key = $config["t700-1"]["Messagequeue-key"];
						

				//$messagequeue = msg_get_queue($mqueue_key,0666);
				write_programline(array("program",$sum, count($data), $data)); // write program to master shared memory
			}
								
			//write_programline($messagequeue,1,$sum, $data);
			//echo json_encode(array('message' => "Single program synced ! ")), "\n";

			$json[] = (array('message' => "Single program synced !"));
			echo json_encode($json), "\n";
			
		}
	}	
	// close connection
	mysqli_close($link);

?>