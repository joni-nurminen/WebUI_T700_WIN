<?php

$FilePath = "lib/css/pdf/"; // directtory for lang folders


    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($FilePath);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) 
	{

      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") 
	  {
        $results[] = array("name" => $file);
      }

    }

    // tidy up: close the handler
    closedir($handler);

    // done!

    echo json_encode($results);
?>