<?php
$data = 'juhuuu';
$host = "192.168.0.182";
$port = 8012;
$path = "/sync/sync_server.php";

 $fp = fsockopen($host, $port, $errno, $errstr, 30);
 if (!$fp) {
	 return $data;
 }
 $head = 'POST ' . $path . " HTTP/1.0\r\n";
 $head .= 'Host: ' . $host . "\r\n";
 $head .= 'Referer: http://' . $host . $path . "\r\n";
 $head .= "Content-type: application/x-www-form-urlencoded\r\n";
 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
 $head .= "\r\n";
 $head .= trim($query);
 $write = fwrite($fp, $head);
 $header = '';
 while ($str = trim(fgets($fp, 4096))) {
	 $header .= $str;
 }
 while (!feof($fp)) {
	 $data .= fgets($fp, 4096);
 }
 echo $data;
?>