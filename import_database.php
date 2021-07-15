<?php
$setNumber = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
include 'select_shared_mem.php';

$allowedExts = array("sql");
$extension = end(explode(".", $_FILES["uploadedfile2"]["name"]));
$path ='lib/Database/';
$path_to_mysql = "C:/xampp/mysql/bin/";
$path_to_defaults = "lib/Database/defaults/"; // path to default sets
$mysqlTableName ='SavedPrograms';


$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype	
if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
{
	if($selected_machine == 1)		
	{
		$mysqlTableName ='SavedPrograms';
		$filename = "t700_set_".$setNumber.".sql";
		$loadedset = "LoadedSet";
	}
	else if ($selected_machine == 2)
	{
		$mysqlTableName ='SavedPrograms2';
		$filename = "t700_set_".$setNumber."_".$selected_machine.".sql";
		$loadedset = "LoadedSet2";
	}
}
else
{
	$mysqlTableName ='SavedPrograms';
	$filename = "t700_set_".$setNumber.".sql";
	$loadedset = "LoadedSet";
}
	
  if(in_array($extension, $allowedExts) || $setNumber != null)
  {
		if($setNumber != null) // if set number is given import only washing programs
		{
				$mysqlImportPath = $path."".$filename;
				
				//$mysqlImportPath="lib/Database/t700_set_".$selected_machine."_".$setNumber.".sql"; // path to imported file
				$mysqlDatabaseName = "t700";
				
				if(!file_exists($mysqlImportPath)) // if file does not exist
					$mysqlImportPath = $path_to_defaults."".$filename; // use default files
				
				$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword.' '.$mysqlDatabaseName.' < ' .$mysqlImportPath;
				
			//	mysql_query("DELETE FROM LoadedSet"); // delete table
				mysqli_query($link2,"UPDATE $loadedset SET set_number='$setNumber'"); // save loaded setnumber 
			//	mysql_query("INSERT INTO LoadedSet (set_number) VALUES ('$setNumber')"); // save loaded setnumber 
				
				//echo $command;
		}
		else if($setNumber == "get")
		{
				$mysqlImportPath = $path."".$filename;
			//	$mysqlImportPath="lib/Database/t700_set_".$selected_machine."_".$setNumber.".sql";// path to imported file
				$mysqlDatabaseName = "t700";
				
				if(!file_exists($mysqlImportPath)) // if file does not exist
					$mysqlImportPath = $path_to_defaults."".$filename; // use default files
				
				$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword.' '.$mysqlDatabaseName.' < ' .$mysqlImportPath;
				
			//	mysql_query("DELETE FROM LoadedSet"); // delete table
				mysqli_query($link2,"UPDATE $loadedset SET set_number='$setNumber'"); // save loaded setnumber 
			//	mysql_query("INSERT INTO LoadedSet (set_number) VALUES ('$setNumber')"); // save loaded setnumber 
				
				//echo $command;
		}
		else
		{
				if ($_FILES["uploadedfile2"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["uploadedfile2"]["error"] . "<br>";
				}
				else
				{
					echo "Upload: " . $_FILES["uploadedfile2"]["name"] . "<br>";
					echo "Type: " . $_FILES["uploadedfile2"]["type"] . "<br>";
					echo "Size: " . ($_FILES["uploadedfile2"]["size"] / 1024) . " kB<br>";
					echo "Temp file: " . $_FILES["uploadedfile2"]["tmp_name"] . "<br>";


					  move_uploaded_file($_FILES["uploadedfile2"]["tmp_name"],
					  $path . $_FILES["uploadedfile2"]["name"]);
					  echo "File Stored in: " . $path . $_FILES["uploadedfile2"]["name"];
					  $mysqlImportFilename = $path."".$_FILES["uploadedfile2"]["name"];
					  
					  //DONT EDIT BELOW THIS LINE
					//Export the database and output the status to the page
					// Execute query
					
			
						if($_FILES["uploadedfile2"]["name"] == "WashCounters.sql")
						{
						$link = mysqli_connect('localhost', 'root', 'rootxx');
						if(!$link)
						{
						  echo("Error description: " . mysqli_error($link));
						}
						echo 'Connected successfully';
							
							$result = mysqli_query($link,'CREATE DATABASE wash_counters_t700'); // CREATE DATABASE
							if($result)
							{
								$mysqlDatabaseName = "wash_counters_t700";
								
								echo '<br><span style="color:green">Database wash_counters_t700 was successfully created</span>';
								$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
							}
							 else 
							 {
								echo '<br><span style="color:red">Error creating wash_counters_t700 database:</span> ' . mysqli_error($link) . "\n";
								return;
							}
						}
						else if($_FILES["uploadedfile2"]["name"] == "t700_data_update.sql")
						{
						$link = mysqli_connect('localhost', 'root', 'rootxx');
							if (!$link) 
							{
								die('Could not connect: ' . mysqli_error($link));
							}
							echo 'Connected successfully';
							
								$mysqlDatabaseName = "t700_data";
								
								echo '<br><span style="color:green">Adding tables to t700_data database</span>';
								$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;

						}
						else if($_FILES["uploadedfile2"]["name"] == "t700_update.sql")
						{
						$link = mysqli_connect('localhost', 'root', 'rootxx');
							if (!$link) 
							{
								die('Could not connect: ' . mysqli_error($link));
							}
							echo 'Connected successfully';
							
								$mysqlDatabaseName = "t700";
								
								echo '<br><span style="color:green">Adding tables to t700 databse</span>';
								$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;

						}
						else if($_FILES["uploadedfile2"]["name"] == "t700.sql")
						{
							$result = mysql_query('DROP DATABASE t700'); // DELETE DATABASE
							$mysqlDatabaseName = "t700";
							
							if($result)
								echo '<br><span style="color:green">Database t700 was successfully dropped</span>';
							 else 
								echo '<br><span style="color:red">Error dropping database:</span> ' . mysqli_error($result) . "\n";
							

							$result = mysqli_query('CREATE DATABASE t700'); // CREATE DATABASE
							if($result)
								echo '<br><span style="color:green">Database t700 was successfully created</span>';
							 else 
								echo '<br><span style="color:red">Error creating database:</span> ' . mysqli_error($result) . "\n";
								
							$command='mysql -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
						}
						else
						{
							$f = $_FILES["uploadedfile2"]["name"];
							echo '<br><span style="color:red">'.$f.' is not supported</span>';
							echo "<br><br><a href='main_page.php'>Back</a>";
							return;
							
						}
						
						
				}

		}
		
			exec($path_to_mysql.$command,$output=array(),$worked);

			switch($worked)
			{
				case 0:
					echo '<span style="color:green"><br><br>Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b></span>';
					break;
				case 1:
					echo '<span style="color:red"><br><br>There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table></span>';
					break;
			}
			 echo "<br><br><a href='main_page.php'>Back</a>";
		
			
  }
  else
  {
 echo "<span style='color:red'>Invalid file type (".$extension.")<br><br></span>";
 echo "<br><br><a href='main_page.php'>Back</a>";
 
  }

?> 