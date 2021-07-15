<?php
/**
 * @file   	sync_server_functions.php
 * @brief  	This file contains functions for handling shared memory, message queue etc.
 * @details	Detailed info here.
 * @date   	$Date: 2013-07-01 12:50:54 +0300 (ma, 01 heinä 2013) $
 * @version	$Revision: 5191 $
 */

global $config_file_name;
$config_file_name = "sync_server.conf";
global $debug;
$debug = 0;	/*!< Global debug flag. Set this to 1 to get debug information. */


//==========
// Functions
//==========
/**
 * @brief		Config parser.
 * @details		This function is used to parse variables from config file.
 * @param		file Config filename.
 * @return		Config array.
 */
function parse_config($filename)
{
    global $debug;
    if($debug)
    {
        print_log("Configfile to parse: ".$filename);
    }

    // Parse with sections
    $config_array = parse_ini_file($filename,true);
    if ($debug)
    {
        print_log("Config file data: ");
        print_r($config_array);
    }
    return($config_array);
}

/**
 * @brief		Opens shared memory block.
 * @details		This function is used to open shared memory block.
 * @param		key	System's id for shared memory block.
 * @param		flags	Access flags, a=access, c=create, w=read/write.
 * @param		mode	Permission mode in octal form. For example 666.
 * @param		size	The size of memory block.
 * @return		shid	Shared memory id.
 * @todo		Parameters and return value!
 */
function shared_mem_open($key,$flags,$mode,$size)
{
    global $debug;
    if ($debug)
    {
        print_log("shared_mem_open ".$key." ".$flags." ".$mode." ".$size);
        //echo "shared_mem_open ".$key." ".$flags." ".$mode." ".$size."<br>";
    }
    $id = shmop_open($key, "a", $mode, $size);
    if($id == FALSE)
    {
        print_log("Can't shm_open memory(key:%d) for reading".$id);
        //printf("Can't shm_open memory(key:%d) for reading\n", $id);
    }
    return($id);

}


/**
 * @brief		Closes shared memory block.
 * @details		This function is used to close/detach shared memory. This doesn't delete memory block.'
 * @return		No return value.
 * @todo		Parameters and return value. Error control!
 */
function shared_mem_close($id)
{
    shmop_close($id);
    return;

}


/**
 * @brief		Read shared memory data to array.
 * @details		This function is used to read shared memory block. After reading function returns array containing shared memory data.
 * @param		shm_id Shared memory id.
 * @return		Serialized array containing shared memory data.
 */
function read_shared_data($id,$size)
{
    //echo "Read data here<br>";
    $data_array=array();
    $mem=shmop_read($id, 0, $size);
    $data=serialize($mem);
    return($data);
}

// Print config file data
function show_config($config_array)
{
    foreach($config_array as $key => $value)
    {
        foreach( $value as $key2 => $value2)
        {
            print "$key $key2 => $value2\n<br />\n";
        }
    }

}

function write_programline($arr)
{
	$query = serialize($arr);
	
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 debugLog($head);
	 
	 $write = fwrite($fp, $head);
	 $header = '';
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }

}

function write_array_mixed($array)
{
	$query = serialize($array);
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);
	 $header = '';
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }
}
// Write command to message queue which will be send to washing machine
//
/**
 * @brief		Write command to message queue
 * @details		This function is used to write commands to message queue.
 * @param		commandqueue Message queue id.
 * @param		commandqueue Message type. 1=command.
 * @param		offset Offset to write.
 * @param		bytes How many bytes to write.
 * @param		data Data.
 * @return		1 on error, 0 on success.
 */
function write_command($offset,$data)
{	
	$query = serialize(array("single",array("offset"=>$offset,"cmd"=>$data)));
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);
	// $header = '';
	/*
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }
*/
}

function write_command_clear($start,$bytes)
{	
	$query = serialize(array("clear",array("start"=>$start,"bytes"=>$bytes)));
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);
	// $header = '';
	/*
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }
*/
}

function send_status($address, $status)
{	
	$query = serialize(array("status"=>$status));

	$host  = $address;
	$port = 80;
	$path = "/receive_status.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);
}

function write_command_move($offset,$data, $mode)
{	
	$query = serialize(array("move",array("offset"=>$offset,"cmd"=>$data,"mode"=>$mode)));
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);

}

function write_command_log($offset,$data,$logNro)
{	
	$query = serialize(array("log",array("offset"=>$offset,"cmd"=>$data,"logNro"=>$logNro)));
	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);

}


function write_string($arr)
{	
	$query = serialize($arr);

	global $config_file_name;
    $config = parse_config($config_file_name);

	$host  = $config["t700-1"]["Host-ip"];
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: text/html\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	// debugLog($head);
	 
	 $write = fwrite($fp, $head);
	 /*
	 $header = '';
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }
	*/

    return true;
}

// Reads remote uptime stored in local file
function get_remote_uptime($id)
{
    $fp = "c:\\xampp\\htdocs\\sync\\".$id."_remote_uptime";
    $fh = fopen($fp, 'r');
	
	if (flock($fh, LOCK_EX)) 
	{
        $remote_uptime = fgets($fh);
		
		$seconds = $remote_uptime%60;
		$mins = floor($remote_uptime/60)%60;
		$hours = floor($remote_uptime/60/60)%24;
		$days = floor($remote_uptime/60/60/24);
		$time = $days."d ".$hours."h ".$mins."min ".$seconds."s";
        flock($fh, LOCK_UN); // unlock the file
		return $time;
    } 
	else 
	{
		return "0d 0h 0min 1s";
      //  echo "Could not lock $fp!\n";
    } 
	fclose($fp);
}

// Write uptime received from client to local file
function set_remote_uptime($id,$time)
{

    $fp = "C:\\xampp\\htdocs\\sync\\".$id."_remote_uptime";
    $fh = fopen($fp, 'w');

	if (flock($fh, LOCK_EX)) 
	{
        fwrite($fh, $time);
        flock($fh, LOCK_UN); // unlock the file
    } 
	else 
	{
        echo "Could not lock $fp!\n";
    }	
	fclose($fp);
	
}

// Reads remote uptime stored in local file. Returns seconds.
function get_remote_uptime_seconds($id)
{
    $fp = "C:\\xampp\\htdocs\\sync\\".$id."_remote_uptime";
    $fh = fopen($fp, 'r');
	if (flock($fp, LOCK_EX)) 
	{
        $remote_uptime = fgets($fh);
        flock($fp, LOCK_UN); // unlock the file
		return($remote_uptime);
    } 
	else 
	{
        echo "Could not lock $fp!\n";
    }   
	fclose($fp);
}

// Log function
function print_log($logstring)
{
    print date("M j H:i:s")." Server: ".$logstring."\n";
}

// Write IP received from client to local file
function set_remote_ip($id,$ip)
{
 
	$fp = "c:\\xampp\\htdocs\\sync\\".$id."_remote_ip";
    $fh = fopen($fp, 'w') or die("can't open file remote ip");
    fwrite($fh, $ip);
    fclose($fh);
	
}

// Reads remote IP stored in local file.
function get_remote_ip($id)
{
    $fp = "c:\\xampp\\htdocs\\sync\\".$id."_remote_ip";
    $fh = fopen($fp, 'r');
    $remote_ip = fgets($fh);
    fclose($fh);
    return($remote_ip);

}
// get shared mem size from washing programs

function get_mem_size($id1,$start,$count)
{

    global $config_file_name;

    // Open config data
    $config = parse_config($config_file_name);

    // Get keys, modes, sizes
    $shm_key_1  = $config[$id1]["Sharedmemory-key"];
    $shm_size_1 = $config[$id1]["Sharedmemory-size"];
    $shm_mode_1 = $config[$id1]["Sharedmemory-mode"];

    // Open memories
    $shm1 = shmop_open($shm_key_1, "a", 0666, $shm_size_1);

    // Get size
    for($i=$start; $i < ($start+$count+1); $i++)
    {
        $sum += intval(shmop_read($shm1,$i,1));
    }

    return $sum;

}

// Compares two shared memory block.
function shared_mem_compare($id1,$id2,$start,$count)
{
    global $config_file_name;

    // Diff counter
    $diff = 0;
    $temp=0;

    // Open config data
    $config = parse_config($config_file_name);

    // Get keys, modes, sizes
    $shm_key_1  = $config[$id1]["Sharedmemory-key"];
    $shm_key_2  = $config[$id2]["Sharedmemory-key"];
    $shm_size_1 = $config[$id1]["Sharedmemory-size"];
    $shm_size_2 = $config[$id2]["Sharedmemory-size"];
    $shm_mode_1 = $config[$id1]["Sharedmemory-mode"];
    $shm_mode_2 = $config[$id2]["Sharedmemory-mode"];

    /*
    // Testing
    print "shm1 key ".$shm_key_1."\n";
    print "shm2 key ".$shm_key_2."\n";
    print "shm1 size ".$shm_size_1."\n";
    print "shm2 size ".$shm_size_2."\n";
    */

    // Open memories
    $shm1 = shmop_open($shm_key_1, "a", 0666, $shm_size_1);
    $shm2 = shmop_open($shm_key_2, "a", 0666, $shm_size_2);

    // Compare memories
    for($i=$start; $i < ($start+$count+1); $i++)
    {
        $data1 = shmop_read($shm1,$i,1);
        $data2 = shmop_read($shm2,$i,1);
        if($data1 == $data2)
        {
            $temp++;
        }
        else
        {
            //$diff++;
            return false;
        }
    }
    return true;
}

function debugLog($text)
{
	$fh = fopen("C:/temp/debug.txt", 'a') or die("can't open file for debuglog");
	fwrite($fh, $text."\n");
	fclose($fh);
}
?>
