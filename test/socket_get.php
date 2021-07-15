<?php
   $connection = fsockopen("192.168.0.182", 8012, $errno, $errstr, 30);
   
   if (!$connection) {
      echo "$errstr ($errno)
      \n";
   }else {
      $out = "GET / HTTP/1.1\r\n";
      $out .= "Host: 192.168.0.182\r\n";
      $out .= "Connection: Close\r\n\r\n";
      
      fwrite($connection, $out);
      
      while (!feof($connection)) {
         echo fgets($connection, 128);
      }
      fclose($connection);
   }
?>