<?php
include 'select_shared_mem.php';

$result = mysqli_query($link2,"SELECT set_number,synced_set FROM LoadedSet");
$row = mysqli_fetch_array( $result );
$setNumber = $row['set_number'];    // get used set number from database
$synced_set = $row['synced_set'];   // get synced number from databse

//
// Update loaded set to synced one
//
$path_to_defaults   = "lib/Database/defaults/";                             // path to default sets
$mysqlDatabaseName  = "t700";
$mysqlImportPath    = "lib/Database/t700_set_".$synced_set.".sql";          // path to synced file
$path_to_mysql = "C:/xampp/mysql/bin/";

if(!file_exists($mysqlImportPath))                                          // if file does not exist
{
    echo '<span style="color:green"><br><br>Import file <b>' .$mysqlImportPath .'</b> not found? Using default!!  <b></b></span><br><br>';
    $mysqlImportPath = $path_to_defaults."t700_set_".$synced_set.".sql";    // use default files
}
$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword.' '.$mysqlDatabaseName.' < ' .$mysqlImportPath;    // There is only 'SavedPrograms' for T1. 'SavedPrograms2' for T2 missing!!!
$output = exec($path_to_mysql.$command,$output=array(),$worked);
mysqli_query($link2,"UPDATE LoadedSet SET set_number='$synced_set'");        // save loaded setnumber T1
// mysql_query("UPDATE LoadedSet2 SET set_number='$synced_set'",$link2);       // save loaded setnumber T2
switch($worked)
{
    case 0:
        echo '<span style="color:green"><br><br>Import file <b>' .$mysqlImportPath .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b></span><br><br>';
        break;
    case 1:
        echo '<span style="color:red"><br><br>There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table></span><br><br>';
        break;
}


$e = $_SERVER['SCRIPT_FILENAME'];
$pieces = explode("/", $e);
$count = count($pieces);

for($i=0;$i<$count-1;$i++)
{
	$pa .= $pieces[$i];
	$pa .= "/";
}

$myFile = "/tmp/t700_root.txt";
$fh = fopen($myFile, 'w') or die("Can't open /tmp/t700_root.txt");
$stringData = $pa;
fwrite($fh, $stringData);
fclose($fh);


$path="/tmp/";
$extractPath = "/tmp/";

function bytesToSize1024($bytes, $precision = 2)
{
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

$sFileName = $_FILES['image_file']['name'];
$sFileType = $_FILES['image_file']['type'];
$sFileSize = bytesToSize1024($_FILES['image_file']['size'], 1);
$sStoredIn = $_FILES["image_file"]["tmp_name"];

move_uploaded_file($_FILES["image_file"]["tmp_name"],$path ."". $_FILES["image_file"]["name"]);
$file =  $path . $_FILES["image_file"]["name"];

echo <<<EOF
<p>Your file: {$sFileName} has been successfully received.</p>
<p>Type: {$sFileType}</p>
<p>Size: {$sFileSize}</p>
<p>File Stored in: {$file}</p>
EOF;

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE)
{
  $zip->extractTo($extractPath);
  $zip->close();
  echo '<br><span class="green_text">File is uncompressed successfully!</span><br><br>';
}
else
{
  echo '<br><span class="red_text">Uncompressing failed! Something went terribly wrong..</span><br><br>';
}
$name = explode(".", $sFileName);
$name = $name[0];

chdir($extractPath.$name);
$output = shell_exec('/bin/ls -lart .');
$location =  shell_exec('/bin/pwd');
echo "<pre>home: $location</pre>";
echo "<pre>files: $output</pre>";

# Set file permissions
$output = shell_exec('/bin/chmod -R 0777 .');
#$output = shell_exec('/bin/chmod -R 0775 /var/www/html');
$output = shell_exec('/bin/chmod -R 0775 /var/www');
# Convert Dos to Unix
$output = shell_exec('/usr/bin/dos2unix update.sh');
$output = shell_exec('/usr/bin/dos2unix update_files/run.sh');
$output = shell_exec('/usr/bin/dos2unix update_files/root/Install/init.sh');
$output = shell_exec('/usr/bin/dos2unix update_files/root/Install/t700_env.txt');

chmod('update.sh', 0777);
chmod('update_files/run.sh', 0777);
$output = shell_exec('/bin/sh update.sh');
echo "<br><pre>$output</pre>";

echo "<br>";
echo "Remove folder: " . $extractPath.$name;
echo "<br>";
echo "Remove file: " . $extractPath.$sFileName;
$output = shell_exec('/bin/rm -rf "'.$extractPath.$name.'"');
$output = shell_exec('/bin/rm -rf "'.$extractPath.$sFileName.'"');

/*
$log = shell_exec('tail /var/log/apache2/error.log');
echo "<pre>Log: $log</pre>";
*/

if((file_exists("/tmp/".$sFileName)) or (file_exists($extractPath."/".$name))        )
	{
	echo '<br><span class="red_text">Cant remove update zip or directory</span><br><br>';
	}
else
	{
	echo '<br><span class="green_text">Update directory and zip-file removed.</span><br><br>';
	}


echo "<pre>$output</pre>";



?>
