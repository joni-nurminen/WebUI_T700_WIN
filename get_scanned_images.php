<?php
$array2 = array();
$limit = 100;
$i = 0;
$files = glob('C:\xampp\htdocs\lib\css\images\ScannedImage\old\*.{jpg,png,gif}', GLOB_BRACE);

foreach($files as $file) 
{
	$array2[] = array("time" => filemtime($file), "name" => basename($file));  
}

sort($array2);

foreach($array2 as $a)
{
	$names[] =  $a['name'];
}
$arr = array_reverse($names);

foreach($arr as $file) 
{
   if($i >= $limit)
	  break;
  
  $images[] = basename($file);
  $i++;
}
echo json_encode($images);
?>