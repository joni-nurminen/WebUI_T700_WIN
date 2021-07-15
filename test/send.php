<?php
	$offset = 31324;
	$ramp = 1;
	$bytes = 1;
	$cmd = 5;
		
	$query = json_encode(array($offset,$ramp,$bytes,$cmd));
	$host = "10.3.136.202";
	$port = 80;
	$path = "/receive_messages.php";

	 $fp = fsockopen($host, $port, $errno, $errstr, 30);
	 if (!$fp) {
		 return $query;
	 }
	 $head = 'POST ' . $path . " HTTP/1.0\r\n";
	 $head .= 'Host: ' . $host . "\r\n";
	 $head .= 'Referer: http://' . $host . $path . "\r\n";
	 $head .= "Content-type: application/json\r\n";
	 $head .= 'Content-Length: ' . strlen(trim($query)) . "\r\n";
	 $head .= "\r\n";
	 $head .= trim($query);
	 $write = fwrite($fp, $head);
	 $header = '';
	 while ($str = trim(fgets($fp, 4096))) {
		 $header .= $str;
	 }
	 echo $header;
	 /*
	 while (!feof($fp)) {
		 $data .= fgets($fp, 4096);
	 }
	 echo $data;
	 */
?>