<?php
/* create connection */
include 'mysql_connect.php';
include 'mysql_connect_data.php';
include 'mysql_connect_ifsf.php';


$result = mysqli_query($link2, "SELECT number FROM SelectedMachine");  // get selected machine number
if(!$result)
{
  echo("Error description: " . mysqli_error($link2));
}

$row = mysqli_fetch_array( $result );
$selected_machine = $row['number']; // selected machine


// Set variables
if($selected_machine == 1 || $selected_machine == null)
{
	$mqueue_key = $config["t700-1"]["Messagequeue-key"];
	$shm_key  = $config["t700-1"]["Sharedmemory-key"];
	$shm_mode  = $config["t700-1"]["Sharedmemory-mode"];
	$shm_size  = $config["t700-1"]["Sharedmemory-size"];

}
if($selected_machine == 2)
{
	$mqueue_key = $config["t700-2"]["Messagequeue-key"];
	$shm_key  = $config["t700-2"]["Sharedmemory-key"];
	$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
	$shm_size  = $config["t700-2"]["Sharedmemory-size"];

}

?>