<?php
$mysqlUserName ='root';
$mysqlPassword ='rootxx';
$mysqlHostName ='localhost';
$mysqlDb ='wash_counters_t700';

$link = mysqli_connect($mysqlHostName, $mysqlUserName, $mysqlPassword, $mysqlDb);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>