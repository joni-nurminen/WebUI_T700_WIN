<?php
include "defines.php";
include 'sync/sync_server_functions.php';

// get method post or get
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

global $config_file_name;
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';
// Open queue
//global $messagequeue;
//$messagequeue = msg_get_queue($mqueue_key,0666);
// Open memory for reading
$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );
if($shm_id == FALSE)
{
    $json['error']="Cant open shared memory";
}

switch ($request_method)
{
case 'post':
    $update = json_decode(file_get_contents('php://input'), true);
    $lang = $update['lang'];
    mysqli_query($link2,"UPDATE Lang SET language='$lang'"); // save selected lang to database
    break;

case 'get':
    $result = mysqli_query($link2,"SELECT language FROM Lang");
    $row = mysqli_fetch_array( $result );
    $lang = $row['language'];
    $json['lang'] = $lang;
    echo json_encode($json), "\n";
    break;
}

?>
