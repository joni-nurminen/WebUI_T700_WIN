<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
body{
	font-size: 12px;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  width:auto;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
</head>

<script>
$(document).ready(function()
{
 $('.dateFilter').datepicker({
	dateFormat: "yy-mm-dd"
 });
});
</script>
<body>


<!-- Search filter -->
<form method='post' action=''>
Start Date <input type='text' class='dateFilter' name='fromDate' value='<?php if(isset($_POST['fromDate'])) echo $_POST['fromDate']; ?>'>
End Date <input type='text' class='dateFilter' name='endDate' value='<?php if(isset($_POST['endDate'])) echo $_POST['endDate']; ?>'>
<input type='submit' name='but_search' value='Search'>
</form>
<br>


<?php

// Date filter
if(isset($_POST['but_search']))
{
  $fromDate = $_POST['fromDate'];
  $endDate = $_POST['endDate'];

  $sql = "SELECT * FROM Washlog";
  
  if(!empty($fromDate) && !empty($endDate))
  {
	$sql .= " WHERE Time BETWEEN #".$fromDate."# and #".$endDate."# ORDER BY Time DESC";
  }

}

$from = $fromDate;
$to = $endDate;

$conn=odbc_connect('carwash','','');
if (!$conn)
  {exit("Connection Failed: " . $conn);}

echo "Query: ".$sql."<br>";
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}

echo "<div>";
echo "<table style='border: 1px solid gray'><tr>";
echo "<th>Time_______________</th>";
echo "<th>Day_Id</th>";
echo "<th>Prog_nr</th>";
echo "<th>Washing_mode</th>";
echo "<th>Shift_nr</th>";
echo "<th>Status</th>";
echo "<th>Entry_time</th>";
echo "<th>Wash_time</th>";
echo "<th>Ccalc_prewash1</th>";
echo "<th>Ccalc_prewash2</th>";
echo "<th>Ccalc_foam</th>";
echo "<th>Ccalc_shampoo</th>";
echo "<th>Ccalc_wax</th>";
echo "<th>Ccalc_rinse_aid</th>";
echo "<th>Ccalc_polish_wax</th>";
echo "<th>Wcalc_brush_wash</th>";
echo "<th>Wcalc_HP_wash</th>";
echo "<th>Wcalc_rinse</th>";
echo "<th>Wcalc_RO_water</th>";
echo "<th>Wcalc_extra</th>";
echo "<th>Ecalc_inverterU4</th>";
echo "<th>Ecalc_inverterU6</th>";
echo "<th>Ecalc_brushes</th>";
echo "<th>Ecalc_drying</th>";
echo "<th>Ecalc_HP_wash</th>";
echo "<th>Ecalc_booster1</th>";
echo "<th>Ecalc_booster2</th>";
echo "<th>Epar_HP_rinse</th>";
echo "<th>Epar_RO_water</th>";
echo "<th>Epar_extra</th>";
echo "<th>Ccalc_wheelprewash</th>";
echo "</tr>";
echo "</div>";

while (odbc_fetch_row($rs))
{
  $Time=odbc_result($rs,"Time");
  $Day_Id=odbc_result($rs,"Day_Id");
  $Prog_nr=odbc_result($rs,"Prog_nr");
  $Washing_mode=odbc_result($rs,"Washing_mode");
  $Shift_nr=odbc_result($rs,"Shift_nr");
  $Status=odbc_result($rs,"Status");
  $Entry_time=odbc_result($rs,"Entry_time");
  $Wash_time=odbc_result($rs,"Wash_time");
  $Ccalc_prewash1=odbc_result($rs,"Ccalc_prewash1");
  $Ccalc_prewash2=odbc_result($rs,"Ccalc_prewash2");
  $Ccalc_foam=odbc_result($rs,"Ccalc_foam");
  $Ccalc_shampoo=odbc_result($rs,"Ccalc_shampoo");
  $Ccalc_wax=odbc_result($rs,"Ccalc_wax");
  $Ccalc_rinse_aid=odbc_result($rs,"Ccalc_rinse_aid");
  $Ccalc_polish_wax=odbc_result($rs,"Ccalc_polish_wax");
  $Wcalc_brush_wash=odbc_result($rs,"Wcalc_brush_wash");
  $Wcalc_HP_wash=odbc_result($rs,"Wcalc_HP_wash");
  $Wcalc_rinse=odbc_result($rs,"Wcalc_rinse");
  $Wcalc_RO_water=odbc_result($rs,"Wcalc_RO_water");
  $Wcalc_extra=odbc_result($rs,"Wcalc_extra");
  $Ecalc_inverterU4=odbc_result($rs,"Ecalc_inverterU4");
  $Ecalc_inverterU6=odbc_result($rs,"Ecalc_inverterU6");
  $Ecalc_brushes=odbc_result($rs,"Ecalc_brushes");
  $Ecalc_drying=odbc_result($rs,"Ecalc_drying");
  $Ecalc_HP_wash=odbc_result($rs,"Ecalc_HP_wash");
  $Ecalc_booster1=odbc_result($rs,"Ecalc_booster1");
  $Ecalc_booster2=odbc_result($rs,"Ecalc_booster2");
  $Epar_HP_rinse=odbc_result($rs,"Epar_HP_rinse");
  $Epar_RO_water=odbc_result($rs,"Epar_RO_water");
  $Epar_extra=odbc_result($rs,"Epar_extra");
  $Ccalc_wheelprewash=odbc_result($rs,"Ccalc_wheelprewash");
  echo "<td>$Time</td>";
  echo "<td>$Day_Id</td>";
  echo "<td>$Prog_nr</td>"; 
  echo "<td>$Washing_mode</td>";
  echo "<td>$Shift_nr</td>";
  echo "<td>$Status</td>";
  echo "<td>$Entry_time</td>";
  echo "<td>$Wash_time</td>";
  echo "<td>$Ccalc_prewash1</td>";
  echo "<td>$Ccalc_prewash2</td>";
  echo "<td>$Ccalc_foam</td>"; 
  echo "<td>$Ccalc_shampoo</td>";
  echo "<td>$Ccalc_wax</td>";
  echo "<td>$Ccalc_rinse_aid</td>";
  echo "<td>$Ccalc_polish_wax</td>";
  echo "<td>$Wcalc_brush_wash</td>";
  echo "<td>$Wcalc_HP_wash</td>";
  echo "<td>$Wcalc_rinse</td>";
  echo "<td>$Wcalc_RO_water</td>";
  echo "<td>$Wcalc_extra</td>";
  echo "<td>$Ecalc_inverterU4</td>"; 
  echo "<td>$Ecalc_inverterU6</td>";
  echo "<td>$Ecalc_brushes</td>";
  echo "<td>$Ecalc_drying</td>";
  echo "<td>$Ecalc_HP_wash</td>";
  echo "<td>$Ecalc_booster1</td>";
  echo "<td>$Ecalc_booster2</td>";
  echo "<td>$Epar_HP_rinse</td>";
  echo "<td>$Epar_RO_water</td>";
  echo "<td>$Epar_extra</td>";
  echo "<td>$Ccalc_wheelprewash</td>";   
  echo "</tr>";
}
odbc_close($conn);
echo "</table>";
?>
</body>
</html>


