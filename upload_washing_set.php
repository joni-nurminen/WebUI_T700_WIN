<?php
$allowedExts = array("sql");
$extension = end(explode(".", $_FILES["uploadedset"]["name"]));
$path ='lib/Database/';

  if(in_array($extension, $allowedExts)) // if extension is ok
  {

				if ($_FILES["uploadedset"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["uploadedset"]["error"] . "<br>";
				}
				else
				{
					echo "Upload: " . $_FILES["uploadedset"]["name"] . "<br>";
					echo "Type: " . $_FILES["uploadedset"]["type"] . "<br>";
					echo "Size: " . ($_FILES["uploadedset"]["size"] / 1024) . " kB<br>";
					//echo "Temp file: " . $_FILES["uploadedpdf"]["tmp_name"] . "<br>";


					  move_uploaded_file($_FILES["uploadedset"]["tmp_name"],
					  $path . $_FILES["uploadedset"]["name"]);
					  echo "File Stored in: " . $path . $_FILES["uploadedset"]["name"];
					  $PdfFilename = $path."".$_FILES["uploadedset"]["name"];
					  echo "<br><br><a href='main_page.php'>Back</a>";

				}			
  }
  else
  {
	echo "<span style='color:red'>Invalid file type(".$extension."). Must be sql<br><br></span>";
	echo "<br><br><a href='main_page.php'>Back</a>";
 
  }

?> 