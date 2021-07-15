<style>
body
{
	
}
table,h3
{
	width: auto;
	background-color:#F0F8FF;
	margin-left: auto;
	margin-right: auto;
	text-align:center;
}
td,tr
{
	padding: 5px;
	text-align:center;
}
</style>
<?php

global $PROGRAMS;
$PROGRAMS = array(
   	0 => "        ",
   	1 => "ESIPESU1",
	2 => "ESIPESU2",
	3 => "VAAHTO",
	4 => "VAIKUTUS", 
	5 => "ALUSTA",
	6 => "PYORAT",
	7 => "SIVUKP",
   	8 => "KATTOKP",
	9 => "HARJAT", 
	10 => "VESIHUUHTELU",
	11 => "KPHUUHTELU",
	12 => "OSMOOSIVESI",
	13 => "VAHA",
	14 => "KUIVAUSVAHA", 
	15 => "HARJAVAHA",
	16 => "KIILLOTUS",
	17 => "KUIVAUS",
	18 => "PAKU",
	19 => "AIRWAX",
	20 => "PYORAESIPESU",
	21 => "SISAANESIPESU",
	22 => "RENGASKIILLOTIN",
	23 => "LOISTOVAHA",
	24 => "RAINXVAHA",
	25 => "SKANNAUS",
    26 => "LAAVAVAAHTO",
    27 => "ITIKKAEP",
	/*
	27 => "MAXMODULI",
	5 => "MAXRINMODULI",
	16 => "MAX_PGM_LINE_SIZE",
	32 => "MAX_PGM_LINES",
	512 => "MAX_PGM_SIZE",
	*/
);

global $PASS_STYLES;
$PASS_STYLES = array
(
	0  => " ",
	1 => "FC",
   	2 => "FO",
	4 => "SB",
	8 => "PU",
   	16 => "FS",
	32 => "RS",
	64 => "NF",
);

	$file_handle = fopen("config.cfg", "r") or exit("Unable to open file!");

	$data = array();
	$hex_array = array();
		
	while (!feof($file_handle)) 
	{
	   $char = fgetc($file_handle);
	   $char_hex =  bin2hex ( $char ); 
	   $hex_array[] = $char_hex;
	   $int_array[] = hexdec($char_hex);
	}
	fclose($file_handle);
	
	echo "<h3>config-ram.cfg parser</h3>";
	echo "<table border=1 padding=5>";
	echo "<th>Rivi</th><th>Ohjelma</th><th>Paatoiminto</th><th>Speed</th><th>__Cmr__</th><th>Rinnakkais1</th><th>__Cmr__</th><th>Rinnakkais2</th><th>__Cmr__</th><th>Rinnakkais3</th><th>__Cmr__</th><th>Rinnakkais4</th><th>__Cmr__</th><th>Rinnakkais5</th><th>__Cmr__</th><th>Ylitys</th>";
	
	$c = 0;
    $endofprog = 0;
	for($i=0;$i<1024;$i++)
	{
		$mainprog = 	$PROGRAMS[$int_array[0+$c]];
		$pass_style = 	$PASS_STYLES[$int_array[1+$c]];
		$speed_main = 	$int_array[2+$c];
		$cmr_main = 	$int_array[3+$c];
		$empty =  	    $hex_array[4+$c];
		$empty = 	    $hex_array[5+$c];
		$side1 = 	    $PROGRAMS[$int_array[6+$c]];
		$cmr_side1 = 	$int_array[7+$c];
		$side2 = 	    $PROGRAMS[$int_array[8+$c]];
		$cmr_side2 = 	$int_array[9+$c];
		$side3 = 	    $PROGRAMS[$int_array[10+$c]];
		$cmr_side3 = 	$int_array[11+$c];
		$side4 = 	    $PROGRAMS[$int_array[12+$c]];
		$cmr_side4 = 	$int_array[13+$c];
		$side5 = 	    $PROGRAMS[$int_array[14+$c]];
		$cmr_side5 = 	$int_array[15+$c];
		
		
		if($speed_main == 0)
			$speed_main= "";
		if($cmr_main == 0)
			$cmr_main= "";
		else
			$cmr_main = $cmr_main." %";
		if($cmr_side1 == 0)
			$cmr_side1= "";
		else
			$cmr_side1 = $cmr_side1." %";
		if($cmr_side2 == 0)
			$cmr_side2= "";
		else
			$cmr_side2 = $cmr_side2." %";
		if($cmr_side3 == 0)
			$cmr_side3= "";
		else
			$cmr_side3 = $cmr_side3." %";
		if($cmr_side4 == 0)
			$cmr_side4= "";
		else
			$cmr_side4 = $cmr_side4." %";
		if($cmr_side5 == 0)
			$cmr_side5= "";
		else
			$cmr_side5 = $cmr_side5." %";
			
		$row = $i+1;
        $prog = intval($i/32)+1;
		
        if($int_array[0+$c] != 0) 
        {
            echo "<tr><td>".$row."</td><td>".$prog."</td><td>".$mainprog ."</td><td> ".$speed_main ."</td><td> ".$cmr_main ."</td><td> ".$side1."</td><td> ".$cmr_side1."</td><td> ".$side2."</td><td> ".$cmr_side2."</td><td> ".$side3."</td><td> ".$cmr_side3."</td><td> ".$side4."</td><td> ".$cmr_side4."</td><td> ".$side5."</td><td> ".$cmr_side5."</td><td> ".$pass_style."</td></tr>";
            $endofprog = 0;
        } 
		$c += 16;	
        if($int_array[0+$c] == 0) 
            if($endofprog == 0)
            {
                $endofprog = 1;
                echo "<tr><td> ... </td></tr>";
            }
	}

	echo "</table>";
?>
