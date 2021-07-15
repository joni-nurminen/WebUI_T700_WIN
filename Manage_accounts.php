<?php
// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);
$type = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;

/* Include functions */
include 'sync/sync_server_functions.php';
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
include 'select_shared_mem.php';
global $messagequeue;
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
switch ($request_method)
		{
		
		case 'get':
		        sleep(5);
				$json['station_data'] = shmop_read($shid, SHM_FLASH_CACHE+24832, 256); // read station_data
				
				$json['email_to'] = shmop_read($shid, SHM_FLASH_CACHE+25088, 256); // read email_to data
				$json['email_to2'] = shmop_read($shid, SHM_FLASH_CACHE+25344, 256); // read email_to2 data
				$json['email_to3'] = shmop_read($shid, SHM_FLASH_CACHE+25600, 256); // read email_to3 data
						
				$json['email_cc'] = shmop_read($shid, SHM_FLASH_CACHE+25856, 256); // read email_cc data
				$json['email_cc2'] = shmop_read($shid, SHM_FLASH_CACHE+26112, 256); // read email_cc2 data
				$json['email_cc3'] = shmop_read($shid, SHM_FLASH_CACHE+26368, 256); // read email_cc3 data
				echo json_encode($json), "\n";

		break;
		
		case 'post':
			if($type == "set_values")
			{
				$update = json_decode(file_get_contents('php://input'), true);
				$station = 	$update['station_data']; 	
			
				$to = 	trim($update['to_value']); 	
				$to2 = 	trim($update['to_value2']); 	
				$to3 = 	trim($update['to_value3']); 	
				
				$cc = 	trim($update['cc_value']); 	
				$cc2 = 	trim($update['cc_value2']); 	
				$cc3 = 	trim($update['cc_value3']); 	
				
				for($i = 0; $i < strlen($station); $i++)
				{
					write_command(SHM_FLASH_CACHE+24832+$i, ord($update['station_data'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+24832+strlen($station), 0);
					write_command(SHM_FLASH_CACHE+24832+strlen($station)+1, 42);
					
					
				for($i = 0; $i < strlen($to); $i++)
				{
					write_command(SHM_FLASH_CACHE+25088+$i, ord($update['to_value'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+25088+strlen($to), 0);
					write_command(SHM_FLASH_CACHE+25088+strlen($to)+1, 42);
					
				for($i = 0; $i < strlen($to2); $i++)
				{
					write_command(SHM_FLASH_CACHE+25344+$i, ord($update['to_value2'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+25344+strlen($to2), 0);
					write_command(SHM_FLASH_CACHE+25344+strlen($to2)+1, 42);
					
					
				for($i = 0; $i < strlen($to3); $i++)
				{
					write_command(SHM_FLASH_CACHE+25600+$i, ord($update['to_value3'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+25600+strlen($to3), 0);
					write_command(SHM_FLASH_CACHE+25600+strlen($to3)+1, 42);
				
				for($i = 0; $i < strlen($cc); $i++)
				{
					write_command(SHM_FLASH_CACHE+25856+$i, ord($update['cc_value'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+25856+strlen($cc), 0);
					write_command(SHM_FLASH_CACHE+25856+strlen($cc)+1,42);
				
				for($i = 0; $i < strlen($cc2); $i++)
				{
					write_command(SHM_FLASH_CACHE+26112+$i, ord($update['cc_value2'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+26112+strlen($cc2), 0);
					write_command(SHM_FLASH_CACHE+26112+strlen($cc2)+1, 42);
				
				for($i = 0; $i < strlen($cc3); $i++)
				{
					write_command(SHM_FLASH_CACHE+26368+$i, ord($update['cc_value3'][$i]));	
				}
					write_command(SHM_FLASH_CACHE+26368+strlen($cc3), 0);
					write_command(SHM_FLASH_CACHE+26368+strlen($cc3)+1, 42);
				
				
				return;
			}
			$admin_pass = $_POST['admin_pass'];
			$tm_pass = $_POST['tm_pass'];
			$importer_pass = $_POST['importer_pass'];
			$operator_pass = $_POST['operator_pass'];
			$chain_pass = $_POST['chain_pass'];
			$wap_pass = $_POST['wap_pass'];

			if($admin_pass != null)
				SetNewPassword('Admin', $admin_pass,$link2); // lisätään uusi salasana tietokantaan
			if($tm_pass != null)
				SetNewPassword('TM', $tm_pass,$link2); 
			if($importer_pass != null)
				SetNewPassword('Importer', $importer_pass,$link2); 
			if($operator_pass != null)
				SetNewPassword('Operator', $operator_pass,$link2); 
			if($chain_pass != null)
				SetNewPassword('Chain', $chain_pass,$link2); 
			if($wap_pass != null)
				SetNewPassword('Wap', $wap_pass,$link2); 
				
				header("Location: index.php?status=ok");
		break;
		}


function SetNewPassword($username, $password,$link2)
{
	$password = mysqli_real_escape_string($link2,$password);
	
	$result = mysqli_query($link2,"UPDATE Users SET password= SHA1('$password') WHERE username='$username'");
	if(!$result)
	{
	  echo("Error description: " . mysqli_error($link2));
	}
	
}


?>
