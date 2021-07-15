<?php
$theArray = array();

$sql = "SELECT * FROM Washlog";

$conn=odbc_connect('test','','');

if (!$conn)
  {exit("Connection Failed: " . $conn);}

//echo "Query: ".$sql."<br>";

$result=odbc_exec($conn,$sql);
if (!$result)
{
	echo 'Exec error: ' . odbc_errormsg();
}
else
{
	while ( ($row = odbc_fetch_array($result)) )
	{
		//print_r($row);
		array_push($theArray, $row);
	}

	$header = array('Time', 'Day_Id', 'Prog_nr', 'Washing_mode', 'Shift_nr', 'Status', 'Entry_time', 'Wash_time', 'Ccalc_prewash1',
	'Ccalc_prewash2', 'Ccalc_foam', 'Ccalc_shampoo', 'Ccalc_wax', 'Ccalc_rinse_aid', 'Ccalc_polish_wax',
	'Wcalc_brush_wash', 'Wcalc_HP_wash', 'Wcalc_rinse', 'Wcalc_RO_water', 'Wcalc_extra', 'Ecalc_inverterU4', 'Ecalc_inverterU6',
	'Ecalc_brushes', 'Ecalc_drying', 'Ecalc_HP_wash', 'Ecalc_booster1', 'Ecalc_booster2', 'Epar_HP_rinse',
	'Epar_RO_water', 'Epar_extra', 'Ccalc_wheelprewash', 'Ccalc_dip', 'Ccalc_tireshine', 'Ccalc_shinelux',
	'Ccalc_rainlux', 'Ccalc_lavafoam', 'Ccalc_insect', 'Ccalc_airwax');

	$fp = fopen('array.csv', 'wa+');

	fputcsv($fp, $header);

	foreach ($theArray as $lines) 
	{
		fputcsv($fp, $lines);
	}

	odbc_free_result($result);
	
}
	
odbc_close($conn);

?>



