<?php
include '/xampp/htdocs/sync/sync_server_functions.php';
// Parse config
$file = fopen('/xampp/htdocs/sync/t700-1_remote_ip','r');
$remoteIp = fgets($file);
fclose($file);

$target_url = "http://cloud.tammermatic.com/Tammermatic/public/addStationData";
$config = parse_config($config_file_name);
include '/xampp/htdocs/select_shared_mem.php';

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
{
    $json['error']="Cant open shared memory";
    $shid = shmop_open($shm_key, "c", 0666, $shm_size);
    return;
}

	$data = shmop_read($shid, 2252+24832, 256); // read station_data
	preg_match_all('!\d+!', $data, $nro);
	$nro = $nro[0][0];
	if(strlen($nro) < 4)
	{
		echo "station name is too short. Need to be 4 numbers: ".$nro;
		return;
	}
	else
	{
		$washlog = "washlog_".$nro.".csv";
		$errorlog = "errorlog_".$nro.".csv";
		$operationlog = "operationlog_".$nro.".csv";
		$openinghours = "openinghours_".$nro.".csv";

		/********WASHLOG**************/

		$washLogArr = array();
		$sqlwashLog = "SELECT * FROM WashLog";
		$conn=odbc_connect('test','','');

		if (!$conn)
		  {exit("Connection Failed: " . $conn);}

		$result=odbc_exec($conn,$sqlwashLog);
		if (!$result)
		{
			echo 'Exec error: ' . odbc_errormsg();
		}
		else
		{
			while ( ($row = odbc_fetch_array($result)) )
			{
				array_push($washLogArr, $row);
			}

			$header = array('Time', 'Day_Id', 'Prog_nr', 'Washing_mode', 'Shift_nr', 'Status', 'Entry_time', 'Wash_time', 'Ccalc_prewash1',
			'Ccalc_prewash2', 'Ccalc_foam', 'Ccalc_shampoo', 'Ccalc_wax', 'Ccalc_rinse_aid', 'Ccalc_polish_wax',
			'Wcalc_brush_wash', 'Wcalc_HP_wash', 'Wcalc_rinse', 'Wcalc_RO_water', 'Wcalc_extra', 'Ecalc_inverterU4', 'Ecalc_inverterU6',
			'Ecalc_brushes', 'Ecalc_drying', 'Ecalc_HP_wash', 'Ecalc_booster1', 'Ecalc_booster2', 'Epar_HP_rinse',
			'Epar_RO_water', 'Epar_extra', 'Ccalc_wheelprewash', 'Ccalc_dip', 'Ccalc_tireshine', 'Ccalc_shinelux',
			'Ccalc_rainlux', 'Ccalc_lavafoam', 'Ccalc_insect', 'Ccalc_airwax');

			$fp = fopen("C:/xampp/htdocs/cloud/".$washlog, 'wa+');
			if(!$fp)
				exit("Cant create/open file: " . $fp);

			fputcsv($fp, $header);

			foreach ($washLogArr as $lines) 
			{
				fputcsv($fp, $lines);
			}

			odbc_free_result($result);
		}
			
		odbc_close($conn);

		/********ERRORLOG**************/
		$errorLogArr = array();
		$sqlErrorLog = "SELECT * FROM ErrorLog";
		$conn=odbc_connect('test','','');

		if (!$conn)
		  {exit("Connection Failed: " . $conn);}

		$result=odbc_exec($conn,$sqlErrorLog);
		if (!$result)
		{
			echo 'Exec error: ' . odbc_errormsg();
		}
		else
		{
			while ( ($row = odbc_fetch_array($result)) )
			{
				array_push($errorLogArr, $row);
			}

			$header = array('Time', 'Error_code', 'CW_state', 'Step');

			$fp = fopen("C:/xampp/htdocs/cloud/".$errorlog, 'wa+');
			if(!$fp)
				exit("Cant create/open file: " . $fp);

			fputcsv($fp, $header);

			foreach ($errorLogArr as $lines) 
			{
				fputcsv($fp, $lines);
			}

			odbc_free_result($result);
		}
			
		odbc_close($conn);

		/********OPERATIONLOG**************/
		$operationLogArr = array();
		$sqlOperationLog = "SELECT * FROM OperationLog";
		$conn=odbc_connect('test','','');

		if (!$conn)
		  {exit("Connection Failed: " . $conn);}

		$result=odbc_exec($conn,$sqlOperationLog);
		if (!$result)
		{
			echo 'Exec error: ' . odbc_errormsg();
		}
		else
		{
			while ( ($row = odbc_fetch_array($result)) )
			{
				array_push($operationLogArr, $row);
			}

			$header = array('Time', 'Day_Id', 'CW_state', 'Max_capacity','Duration');

			$fp = fopen("C:/xampp/htdocs/cloud/".$operationlog, 'wa+');
			if(!$fp)
				exit("Cant create/open file: " . $fp);

			fputcsv($fp, $header);

			foreach ($operationLogArr as $lines) 
			{
				fputcsv($fp, $lines);
			}

			odbc_free_result($result);
		}
			
		odbc_close($conn);
		
		/********WORKINGHOURS**************/
		$openingHoursArr = array();
		$sqlOpeningHours = "SELECT Day_Id,Opening_time,Closing_time,Open_hours,Description FROM StationWorkingHours";
		$conn=odbc_connect('test','','');

		if (!$conn)
		  {exit("Connection Failed: " . $conn);}

		$result=odbc_exec($conn,$sqlOpeningHours);
		if (!$result)
		{
			echo 'Exec error: ' . odbc_errormsg();
		}
		else
		{
			while ( ($row = odbc_fetch_array($result)) )
			{
				array_push($openingHoursArr, $row);
			}

			$header = array('Day_Id', 'Opening_time', 'Closing_time','Open_hours','Description');

			$fp = fopen("C:/xampp/htdocs/cloud/".$openinghours, 'wa+');
			if(!$fp)
				exit("Cant create/open file: " . $fp);

			fputcsv($fp, $header);

			foreach ($openingHoursArr as $lines) 
			{
				fputcsv($fp, $lines);
			}

			odbc_free_result($result);
		}
			
		odbc_close($conn);
	}

	$washlog_with_full_path = "C:/xampp/htdocs/cloud/".$washlog;
	$errorlog_with_full_path = "C:/xampp/htdocs/cloud/".$errorlog;
	$operationlog_with_full_path = "C:/xampp/htdocs/cloud/".$operationlog;
	$openinghours_with_full_path = "C:/xampp/htdocs/cloud/".$openinghours;

	$postData = array(
		'washlog'=>new CURLFile(realpath($washlog_with_full_path)),
		'errorlog'=>new CURLFile(realpath($errorlog_with_full_path)),
		'operationlog'=>new CURLFile(realpath($operationlog_with_full_path)),
		'openinghours'=>new CURLFile(realpath($openinghours_with_full_path))
	);

  //  $post = array('file_contents'=>new CURLFile(realpath($file_name_with_full_path_new)));

	$headers = array("Content-Type" => "multipart/form-data");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL,$target_url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $result=curl_exec ($ch);
    curl_close ($ch);
    echo $result."\n";
	

	// check if folder with station name exits in root-folder,if found -> delete and create it
	if (file_exists("C:/xampp/htdocs/cloud/".$nro)) 
	{
		$directory = "C:/xampp/htdocs/cloud/".$nro;
		$directory = escapeshellarg($directory);
		$res = exec("rmdir /Q /S $directory");
		// give some permissions for folder. 777 iik..
		$res = mkdir("C:/xampp/htdocs/cloud/".$nro, 0777, true);

		if($res)
			echo "Directory deleted and created\n";
		else
			echo "Cant delete/create direcory..\n";
	}
	else
	{
		$res = mkdir("C:/xampp/htdocs/cloud/".$nro, 0777, true);

		if($res)
			echo "Directory created\n";
		else
			echo "Cant create direcory..\n";
	}

	// get conf-file from the carwash machine and save it to stationnumber folder
	//$resConf = exec("wget -P C:/xampp/htdocs/cloud/".$nro." ".$remoteIp."/config.cfg");
	$resConf = exec("cd C:/xampp/htdocs/cloud/".$nro." && curl -O ".$remoteIp."/config.cfg");
	
	// Enter the name of directory 
	$pathdir =  "C:\\xampp\\htdocs\\cloud\\".$nro."\\";  
	  
	// get conf file size to make sure there is some data
	$confSize = filesize($pathdir."config.cfg")."\n";

	if($confSize < 1000)
	{
		echo "Error config.cfg size is too small: ".$confSize;
		return;
	}
	
	// copy all washing sets to stationnumber folder
	$res = exec("copy /Y C:\\xampp\htdocs\lib\Database\\t700_set_1.sql \"C:\\xampp\htdocs\cloud\\".$nro."\"");
	$res = exec("copy /Y C:\\xampp\htdocs\lib\Database\\t700_set_2.sql \"C:\\xampp\htdocs\cloud\\".$nro."\"");
	$res = exec("copy /Y C:\\xampp\htdocs\lib\Database\\t700_set_3.sql \"C:\\xampp\htdocs\cloud\\".$nro."\"");
	$res = exec("copy /Y C:\\xampp\htdocs\lib\Database\\t700_set_4.sql \"C:\\xampp\htdocs\cloud\\".$nro."\"");

	
	// Enter the name to creating zipped directory 
	$zipcreated = "C:/xampp/htdocs/cloud/".$nro.".zip"; 
	// Create new zip class 
	$zip = new ZipArchive; 
	   
	if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) 
	{ 
		// Store the path into the variable 
		$dir = opendir($pathdir); 
		
		while($file = readdir($dir)) 
		{ 
			if(is_file($pathdir.$file)) 
			{ 
				echo $pathdir.$file." ";
				echo filesize($pathdir.$file)."\n";
				$zip -> addFile($pathdir.$file, $file); 
			}
		} 
		$zip ->close(); 
	}
	else
		echo "Error when creating a zip.";



	// path to endpoint which handles the zip file (upcloud)
	$target_url = "http://cloud.tammermatic.com/Tammermatic/public/receiveconf";
	$zip_with_full_path = realpath($zipcreated);
	
	$postData = array(
		'zip'=>new CURLFile(realpath($zip_with_full_path))
	);
	
	$headers = array("Content-Type" => "application/zip");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	$result=curl_exec ($ch);
	curl_close ($ch);
	echo $result."\n";

?>