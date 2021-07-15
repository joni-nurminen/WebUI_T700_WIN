<?php
include "sync_server_functions.php";

// Parse config
$config = parse_config($config_file_name);

// Get queue key from config
$mqueue_key = $config["t700-1"]["Messagequeue-key"];

// Open queue
//$messagequeue = msg_get_queue($mqueue_key,0666);

// Write data to queue
// write_command($messagequeue,$type,$offset,$bytes,$data);

write_command($messagequeue,"log_1",0,0,0);	//syslog


//write_command($messagequeue,"log_2",0,0,0);	//debug
//write_command($messagequeue,"log_3",0,0,0);	//info

?>
