<?php
$setNumber = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
//include 'mysql_connect.php';
//include 'mysql_connect_data.php';
include 'select_shared_mem.php';

//ENTER THE RELEVANT INFO BELOW
$mysqlDatabaseName ='t700';
$mysqlDatabaseName2 ='t700_data';
$mysqlDatabaseName3 ='wash_counters_t700';
$mysqlDatabaseName4 ='Ifsf';
$mysqlTableName ='SavedPrograms';
$mysqlUserName ='root';
$mysqlPassword ='rootxx';
$mysqlHostName ='localhost';
$path ='lib/Database/';
$path_to_mysql = "C:/xampp/mysql/bin/";

$p =  getcwd();
$path = $p."/".$path;

//DONT EDIT BELOW THIS LINE
//Export the database and output the status to the page


if($setNumber != null)// if set number is set export only washing programs
{
			
	if($selected_machine == 1)		
	{
		$mysqlTableName ='SavedPrograms';
		$filename = "t700_set_".$setNumber.".sql";
	}
	else if ($selected_machine == 2)
	{
		$mysqlTableName ='SavedPrograms2';
		$filename = "t700_set_".$setNumber."_".$selected_machine.".sql";
	}
	else
	{
		$mysqlTableName ='SavedPrograms';
		$filename = "t700_set_".$setNumber.".sql";
	}
			
	//$filename = "t700_set_".$selected_machine."_".$setNumber.".sql";
	$mysqlExportPath = $path."".$filename;

	$command='mysqldump --opt -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword.' '.$mysqlDatabaseName.' '.$mysqlTableName .' > ' .$mysqlExportPath; // export t700

}
else // export everything
{
	$date = date("Y-m-d");
	$filename = "t700_".$date.".sql";
	$mysqlExportPath = $path."".$filename;
	$mysqlExportPath2 = $path."".$mysqlDatabaseName2.".sql";
	$mysqlExportPath3 = $path."".$mysqlDatabaseName3.".sql";
	$mysqlExportPath4 = $path."".$mysqlDatabaseName4.".sql";
	
	$command='mysqldump --opt -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath; // export t700

	$command2='mysqldump --opt -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName2 .' > ' .$mysqlExportPath2; // export t700_data

	$command3='mysqldump --opt -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName3 .' > ' .$mysqlExportPath3; // export wash_counters

    $command4='mysqldump --opt -h ' .$mysqlHostName .' -u ' .$mysqlUserName .' --password=' .$mysqlPassword .' ' .$mysqlDatabaseName4 .' > ' .$mysqlExportPath4; // export Ifsf
}

exec($path_to_mysql.$command,$output=array(),$worked);
exec($path_to_mysql.$command2,$output=array(),$worked);
exec($path_to_mysql.$command3,$output=array(),$worked);
exec($path_to_mysql.$command4,$output=array(),$worked);
switch($worked)
{
    case 0:
        echo '<span style="color:green"><br><br>Database <b>' .$mysqlDatabaseName .'</b> successfully exported to <b>/' .$mysqlExportPath .'</b></span>';
		 echo '<span style="color:green"><br><br>Database <b>' .$mysqlDatabaseName2 .'</b> successfully exported to <b>/' .$mysqlExportPath2 .'</b></span>';
		  echo '<span style="color:green"><br><br>Database <b>' .$mysqlDatabaseName3 .'</b> successfully exported to <b>/' .$mysqlExportPath3 .'</b></span>';
		   echo '<span style="color:green"><br><br>Database <b>' .$mysqlDatabaseName4 .'</b> successfully exported to <b>/' .$mysqlExportPath4 .'</b></span>';
        break;
    case 1:
        echo '<span style="color:red"><br><br>There was a warning during the export of <b>' .$mysqlDatabaseName .'</b> to <b>/' .$mysqlExportPath .'</b></span>';
		 echo '<span style="color:red"><br><br>There was a warning during the export of <b>' .$mysqlDatabaseName2 .'</b> to <b>/' .$mysqlExportPath2 .'</b></span>';
		  echo '<span style="color:red"><br><br>There was a warning during the export of <b>' .$mysqlDatabaseName3 .'</b> to <b>/' .$mysqlExportPath3 .'</b></span>';
		   echo '<span style="color:red"><br><br>There was a warning during the export of <b>' .$mysqlDatabaseName4 .'</b> to <b>/' .$mysqlExportPath4 .'</b></span>';
        break;
    case 2:
        echo '<span style="color:red"><br><br>There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>Path:</td><td><b>'.$mysqlExportPath .'</b></td></tr></table></span>';
        break;
}
 echo "<br><br><a href='main_page.php'>Back</a>";

?> 