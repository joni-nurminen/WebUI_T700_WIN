<?php
session_start();

include "defines.php";
include "sync/sync_server_functions.php";

global $ERRORS;
global $config_file_name;
$config_file_name = "sync/sync_server.conf";
// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';
// Open memory for reading

$shid = shmop_open($shm_key, "w", 0666, $shm_size);
if($shid == FALSE)
	{
	$json['error']="Cant open shared memory";
	//exit(0);
	}

	switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':

				$result = mysqli_query($link3,"SELECT * FROM Carwash_alarms ORDER BY timestamp DESC LIMIT 1");
				while($row = mysqli_fetch_array($result))
				{
					$ifsf_id = $row['ifsf_id'];
					$alarm_type = $row['alarm_type'];
					$prog_number = $row['prog_number'];
					$line_number = $row['line_number'];
					$operation_mode = $row['operation_mode'];
					$program_step = $row['program_step'];
					$timestamp = $row['timestamp'];

					$ifsf_alarm_array[] = array("ifsf_id" => $ifsf_id, "alarm_type" => $alarm_type, "prog_number" => $prog_number, "line_number" => $line_number, "operation_mode" => $operation_mode, "program_step" => $program_step, "timestamp" => $timestamp);
				}
				$json['ifsf_alarm']=$ifsf_alarm_array;

				$result = mysqli_query($link2,"SELECT * FROM UserIp ORDER BY time_in DESC LIMIT 50");
				$num_rows = mysqli_num_rows($result);
				$i = 0;

				while($row = mysqli_fetch_array($result))
				{
					$ip = $row['ip'];
					$user = $row['user'];
					$in = $row['time_in'];
					$out = $row['time_out'];

					$user_information_array[] = array("ip" => $ip, "user" => $user, "time_in" => $in, "time_out" => $out);


					if($i<$num_rows)
						$i++;
				}
			//	echo json_encode($user_information_array), "\n";
				$json['user']=$user_information_array;

				$shm_data = shmop_read($shid, 30924, 56);
				// Varför?	shmop_close($shid);

				$G10Max     = ord(substr($shm_data,0,1))  + (ord(substr($shm_data,1,1))<<8);
				$GLoMax     = ord(substr($shm_data,4,1))  + (ord(substr($shm_data,5,1))<<8);
				$G40Max     = ord(substr($shm_data,8,1))  + (ord(substr($shm_data,9,1))<<8);
				$G160Max    = ord(substr($shm_data,12,1)) + (ord(substr($shm_data,13,1))<<8);
				$G320Max    = ord(substr($shm_data,16,1)) + (ord(substr($shm_data,17,1))<<8);
				$G640Max    = ord(substr($shm_data,20,1)) + (ord(substr($shm_data,21,1))<<8);
				$G1280Max   = ord(substr($shm_data,24,1)) + (ord(substr($shm_data,25,1))<<8);

				$G10Ave     = ord(substr($shm_data,28,1)) + (ord(substr($shm_data,29,1))<<8);
				$GLoAve     = ord(substr($shm_data,32,1)) + (ord(substr($shm_data,33,1))<<8);
				$G40Ave     = ord(substr($shm_data,36,1)) + (ord(substr($shm_data,37,1))<<8);
				$G160Ave    = ord(substr($shm_data,40,1)) + (ord(substr($shm_data,41,1))<<8);
				$G320Ave    = ord(substr($shm_data,44,1)) + (ord(substr($shm_data,45,1))<<8);
				$G640Ave    = ord(substr($shm_data,48,1)) + (ord(substr($shm_data,49,1))<<8);
				$G1280Ave   = ord(substr($shm_data,52,1)) + (ord(substr($shm_data,53,1))<<8);


				$json['ifsf'] = ord(shmop_read($shid, $FUNCTIONS[20] + SHM_FLASH_CACHE, 1)); //ifsf_config
				$json['state'] = ord(shmop_read($shid, 31324, 1)); //current state of machine, updKHu
				$json['G10Max']=$G10Max;
				$json['GLoMax']=$GLoMax;
				$json['G40Max']=$G40Max;
				$json['G160Max']=$G160Max;
				$json['G320Max']=$G320Max;
				$json['G640Max']=$G640Max;
				$json['G1280Max']=$G1280Max;

				$json['G10Ave']=$G10Ave;
				$json['GLoAve']=$GLoAve;
				$json['G40Ave']=$G40Ave;
				$json['G160Ave']=$G160Ave;
				$json['G320Ave']=$G320Ave;
				$json['G640Ave']=$G640Ave;
				$json['G1280Ave']=$G1280Ave;

				if($selected_machine == 1)
					$json['uptime'] =  get_remote_uptime("t700-1");
				else if($selected_machine == 2)
					$json['uptime'] =  get_remote_uptime("t700-2");
				else
					$json['uptime'] =  get_remote_uptime("t700-1");

				$time_A1 = ParseTime($shid, HAIRIO1_TIME);
				$time_A2 = ParseTime($shid, HAIRIO2_TIME);
				$time_A3 = ParseTime($shid, HAIRIO3_TIME);
				$time_A4 = ParseTime($shid, HAIRIO4_TIME);
				$time_A5 = ParseTime($shid, HAIRIO5_TIME);
				$time_A6 = ParseTime($shid, HAIRIO6_TIME);
				$time_A7 = ParseTime($shid, HAIRIO7_TIME);
				$time_A8 = ParseTime($shid, HAIRIO8_TIME);
				$time_A9 = ParseTime($shid, HAIRIO9_TIME);
				$time_A10 = ParseTime($shid, HAIRIO10_TIME);

				$json['Alarm1_time']=$time_A1;
				$json['Alarm2_time']=$time_A2;
				$json['Alarm3_time']=$time_A3;
				$json['Alarm4_time']=$time_A4;
				$json['Alarm5_time']=$time_A5;
				$json['Alarm6_time']=$time_A6;
				$json['Alarm7_time']=$time_A7;
				$json['Alarm8_time']=$time_A8;
				$json['Alarm9_time']=$time_A9;
				$json['Alarm10_time']=$time_A10;


				$shm_data = shmop_read($shid, (2252+19464), 40);
				shmop_close($shid);


				for($i = 0; $i < 10; $i++)
				{
					$S = ord(substr($shm_data,(0+($i<<2)),1))  + (ord(substr($shm_data,(1+($i<<2)),1))<<8);
					$A = ord(substr($shm_data,(2+($i<<2)),1))  + (ord(substr($shm_data,(3+($i<<2)),1))<<8);
					$alarm_A = "Alarm_A".$i;
					$alarm_S = "Alarm_S".$i;
						if(($A > 79) && ($A < 129))
						{
								//$json[$alarm_A]=$ERRORS[($A - 80)];
								$json[$alarm_A]= "A_".($A - 80);
								$json[$alarm_S]=$S;
							//	printf("<tr><td>%s-alarm</td><td>%d</td><td>%d</td></tr>", $ERRORS[($A - 80)], $S, ($i+1));
						}
						else
						{
								if($A == 0)
									$json[$alarm_A]="---";
								else
									$json[$alarm_A]=$A;

								$json[$alarm_S]=$S;
							//	printf("<tr><td>Alarm:%d</td><td>%d</td><td>%d</td></tr>", $A, $S, ($i+1));
						}
				}

				echo json_encode($json), "\n";
		break;
		case 'POST':
		break;
	}
	function ParseTime($shid, $alarm_offset)
	{
		for($i = 0; $i < 15; $i++)
		{
			$time_string[] = ord(shmop_read($shid, $alarm_offset+$i, 1));
		}


	 if($time_string[0] != null)
		$year = "20".$time_string[0];
	 else
		$year = "0000";

	 if($time_string[1] < 10)
		$month = "0".$time_string[1];
	else
		$month = $time_string[1];

	 if($time_string[2] < 10)
		$day = "0".$time_string[2];
	else
		$day = $time_string[2];


	 if($time_string[3] < 10)
		$hour = "0".$time_string[3];
	else
		$hour = $time_string[3];

	 if($time_string[4] < 10)
		$min = "0".$time_string[4];
	 else
		$min = $time_string[4];

	 return $year."-". $month."-".$day." ".$hour.":".$min;

	}
?>
