<?php
$selected_lang = $_POST['selected_lang'];
if($selected_lang == "" || $selected_lang == null)
	$selected_lang = "English";

$allowedExts = array("pdf");
$extension = end(explode(".", $_FILES["uploadedpdf"]["name"]));
$path="lib/css/pdf/".$selected_lang."/";

  if(in_array($extension, $allowedExts)) // if extension is ok
  {

				if ($_FILES["uploadedpdf"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["uploadedpdf"]["error"] . "<br>";
				}
				else
				{
					echo "Upload: " . $_FILES["uploadedpdf"]["name"] . "<br>";
					echo "Type: " . $_FILES["uploadedpdf"]["type"] . "<br>";
					echo "Size: " . ($_FILES["uploadedpdf"]["size"] / 1024) . " kB<br>";
					//echo "Temp file: " . $_FILES["uploadedpdf"]["tmp_name"] . "<br>";


					  move_uploaded_file($_FILES["uploadedpdf"]["tmp_name"],
					  $path . $_FILES["uploadedpdf"]["name"]);
					  echo "Language folder: <b>" . $selected_lang. "</b><br>";
					  echo "File Stored in: " . $path . $_FILES["uploadedpdf"]["name"];
					  $PdfFilename = $path."".$_FILES["uploadedpdf"]["name"];
					  echo "<br><br><a href='main_page.php'>Back</a>";

				}			
  }
  else
  {
	echo "<span style='color:red'>Invalid file type(".$extension."). Must be pdf<br><br></span>";
	echo "<br><br><a href='main_page.php'>Back</a>";
 
  }

?> 
