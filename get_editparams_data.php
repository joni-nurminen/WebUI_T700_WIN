<?php 
$id = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
/* Include functions */
include 'sync/sync_server_functions.php';
/* Include defines */
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
// Get queue key from config
include 'select_shared_mem.php';
//$messagequeue = msg_get_queue($mqueue_key,0666);

$param = $_GET['key1'];

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shid);
	}
	
$shm_param_lkm = ord(shmop_read($shid, (2252+19712), 1)); // parametrien lukumäärä, updKHu v4.7

//$shm_param = shmop_read($shid, (2252+16384), (135+135));  // two chars => 16bit
$shm_param = shmop_read($shid, (2252+16384), ($shm_param_lkm+$shm_param_lkm));  // two chars => 16bit
//$shm_param_default = shmop_read($shid, (2252+19714), (135+135));  // two chars => 16bit
$shm_param_default = shmop_read($shid, (2252+19714), ($shm_param_lkm+$shm_param_lkm));  // two chars => 16bit


	shmop_close($shid);
	usleep(10000);  			// sleep 10ms

//	for($i=0; $i < 135; $i++) // updKHu
	for($i=0; $i < $shm_param_lkm; $i++)
	{
		$byte_L = (ord( substr($shm_param, ($i+$i), 1)));
		$byte_H = (ord( substr($shm_param, ($i+$i+1), 1)));
		$word16b = ($byte_H << 8) + $byte_L;
		
		$byte_L_default = (ord( substr($shm_param_default, ($i+$i), 1)));
		$byte_H_default = (ord( substr($shm_param_default, ($i+$i+1), 1)));
		$word16b_default = ($byte_H_default << 8) + $byte_L_default;

		$values[$i+1] = $word16b;
		$values_default[$i+1] = $word16b_default;
		
		if($values[$i+1] != $values_default[$i+1])
			$is_changed[$i+1] = 1;
		else
			$is_changed[$i+1] = 0;
	}			
	//	print_r($values);

	$values[0] = $shm_param_lkm; // updKHu v4.7
	$values_default[0] = $shm_param_lkm; // updKHu v4.7

 $parameters =  
			array(1 => array( // Gategoria: Sekalaiset päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Speed of indexing motion", "default_value" =>$values_default[1], "value" =>$values[1], "langid" =>1),
			array("param" => "Floor washing cycle speed", "default_value" =>$values_default[7], "value" =>$values[7], "langid" =>7),
			array("param" => "Travel speed during start movements", "default_value" =>$values_default[8], "value" =>$values[8], "langid" =>8),
			array("param" => "Override speed", "default_value" =>$values_default[9], "value" =>$values[9], "langid" =>9),
			array("param" => "Rotary head: high ascending speed", "default_value" =>$values_default[15], "value" =>$values[15], "langid" =>15),
			array("param" => "Top brush: high ascending speed", "default_value" =>$values_default[19], "value" =>$values[19], "langid" =>19),
			array("param" => "Top brush: low ascending speed", "default_value" =>$values_default[20], "value" =>$values[20], "langid" =>20),
			array("param" => "Length of indexing motion", "default_value" =>$values_default[25], "value" =>$values[25], "langid" =>25),
		    array("param" => "Exit time", "default_value" =>$values_default[32], "value" =>$values[32], "langid" =>32),
			array("param" => "Lift distance of override control", "default_value" =>$values_default[48], "value" =>$values[48], "langid" =>48),
			array("param" => "Horizontal travel distance of override control", "default_value" =>$values_default[49], "value" =>$values[49], "langid" =>49),
			array("param" => "Telco Ligth Scanner gain 0…255", "default_value" =>$values_default[72], "value" =>$values[72], "langid" =>72), // 75 -> 72 updKHu
			array("param" => "Wash cycle: start delay", "default_value" =>$values_default[76], "value" =>$values[76], "langid" =>76),
			array("param" => "DUO distance between home limits", "default_value" =>$values_default[79], "value" =>$values[79], "langid" =>79),
		    array("param" => "Standing delay (s) until pipeline clearance (Biojet)", "default_value" =>$values_default[83], "value" =>$values[83], "langid" =>83),
			array("param" => "Scanner: nozzle normal offset, cm", "default_value" =>$values_default[89], "value" =>$values[89], "langid" =>89),
			array("param" => "Token queue ON:OFF", "default_value" =>$values_default[91], "value" =>$values[91], "langid" =>91), // updKHu
			array("param" => "Scanner: random pixel filter ON:OFF", "default_value" =>$values_default[93], "value" =>$values[93], "langid" =>93), // updKHu
			array("param" => "Scanner: masking upper cells of the light curtain", "default_value" =>$values_default[94], "value" =>$values[94], "langid" =>94), // updKHu
			array("param" => "Top brush: parking ON:OFF", "default_value" =>$values_default[100], "value" =>$values[100], "langid" =>100), // updKHu
			array("param" => "Defrost, draining time", "default_value" =>$values_default[108], "value" =>$values[108], "langid" =>108),
//			array("param" => "Liftgears ratio", "default_value" =>$values_default[109], "value" =>$values[109], "langid" =>109), // updKHu
			array("param" => "Scanner: light curtain height from the floor", "default_value" =>$values_default[110], "value" =>$values[110], "langid" =>110),
			array("param" => "Scanner: light curtain operation allowed", "default_value" =>$values_default[111], "value" =>$values[111], "langid" =>111),
		    array("param" => "Continuous wash ON:OFF", "default_value" =>$values_default[112], "value" =>$values[112], "langid" =>112),
			array("param" => "The maximum wait time of the customer for washing", "default_value" =>$values_default[137], "value" =>$values[137], "langid" =>137)), // updKHu
		
			2 => array( // Gategoria: Muutetut parametrit
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Speed of indexing motion", "default_value" =>$values_default[1], "value" =>$values[1], "langid" =>1, "ischanged" => $is_changed[1]),
		    array("param" => "Prewash (FO mode) and foam applications: full speed reference", "default_value" =>$values_default[2], "value" =>$values[2], "langid" =>2, "ischanged" => $is_changed[2]),
		    array("param" => "Prewash: travel speed  at rear", "default_value" =>$values_default[3],"value" =>$values[3], "langid" =>3, "ischanged" => $is_changed[3]),
		    array("param" => "Drying cycle: full speed reference", "default_value" =>$values_default[4], "value" =>$values[4], "langid" =>4, "ischanged" => $is_changed[4]),
			array("param" => "Prewash (FC mode) at roof: full speed reference", "default_value" =>$values_default[5], "value" =>$values[5], "langid" =>5, "ischanged" => $is_changed[5]),
			array("param" => "Waxing, rinsing and RO water application: full speed reference", "default_value" =>$values_default[6], "value" =>$values[6], "langid" =>6, "ischanged" => $is_changed[6]),
			array("param" => "Floor washing cycle speed", "default_value" =>$values_default[7], "value" =>$values[7], "langid" =>7, "ischanged" => $is_changed[7]),
			array("param" => "Travel speed during start movements", "default_value" =>$values_default[8], "value" =>$values[8], "langid" =>8, "ischanged" => $is_changed[8]),
			array("param" => "Override speed", "default_value" =>$values_default[9], "value" =>$values[9], "langid" =>9, "ischanged" => $is_changed[9]),
			array("param" => "Chassis wash: full speed reference", "default_value" =>$values_default[10], "value" =>$values[10], "langid" =>10, "ischanged" => $is_changed[10]),
			
			array("param" => "Wheel wash: full speed reference", "default_value" =>$values_default[11], "value" =>$values[11], "langid" =>11, "ischanged" => $is_changed[11]),
		    array("param" => "HP top wash and prewash (FC mode): full speed reference", "default_value" =>$values_default[12], "value" =>$values[12], "langid" =>12, "ischanged" => $is_changed[12]),
		    array("param" => "HP side wash: full speed reference", "default_value" =>$values_default[13], "value" =>$values[13], "langid" =>13, "ischanged" => $is_changed[13]),
		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14], "value" =>$values[14], "langid" =>14, "ischanged" => $is_changed[14]),
			array("param" => "Rotary head: high ascending speed", "default_value" =>$values_default[15], "value" =>$values[15], "langid" =>15, "ischanged" => $is_changed[15]),
			array("param" => "Brush wash: low speed", "default_value" =>$values_default[16], "value" =>$values[16], "langid" =>16, "ischanged" => $is_changed[16]),
			array("param" => "Travel speed during cross over wash", "default_value" =>$values_default[17], "value" =>$values[17], "langid" =>17, "ischanged" => $is_changed[17]),
			array("param" => "Brush wash: corner bypass travel speed", "default_value" =>$values_default[18], "value" =>$values[18], "langid" =>18, "ischanged" => $is_changed[18]),
			array("param" => "Top brush: high ascending speed", "default_value" =>$values_default[19], "value" =>$values[19], "langid" =>19, "ischanged" => $is_changed[19]),
			array("param" => "Top brush: low ascending speed", "default_value" =>$values_default[20], "value" =>$values[20], "langid" =>20, "ischanged" => $is_changed[20]),
	
			array("param" => "Brush wash: back off speed at front and rear", "default_value" =>$values_default[21], "value" =>$values[21], "langid" =>21, "ischanged" => $is_changed[21]),
		    array("param" => "Brush wash: travel speed on sides", "default_value" =>$values_default[22], "value" =>$values[22], "langid" =>22, "ischanged" => $is_changed[22]),
		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23], "value" =>$values[23], "langid" =>23, "ischanged" => $is_changed[23]),
		    array("param" => "Tire shining speed", "default_value" =>$values_default[24], "value" =>$values[24], "langid" =>24, "ischanged" => $is_changed[24]),
			array("param" => "Length of indexing motion", "default_value" =>$values_default[25], "value" =>$values[25], "langid" =>25, "ischanged" => $is_changed[25]),
			array("param" => "Foam application: over travel at rear", "default_value" =>$values_default[26], "value" =>$values[26], "langid" =>26, "ischanged" => $is_changed[26]),
			array("param" => "Foam application: over travel at front", "default_value" =>$values_default[27], "value" =>$values[27], "langid" =>27, "ischanged" => $is_changed[27]),
			array("param" => "Prewash: over travel at rear", "default_value" =>$values_default[28], "value" =>$values[28], "langid" =>28, "ischanged" => $is_changed[28]),
			array("param" => "Van nozzles: automatic mode ON:OFF", "default_value" =>$values_default[29], "value" =>$values[29], "langid" =>29, "ischanged" => $is_changed[29]),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30], "value" =>$values[30], "langid" =>30, "ischanged" => $is_changed[30]),
			
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31], "value" =>$values[31], "langid" =>31, "ischanged" => $is_changed[31]),
		    array("param" => "Exit time", "default_value" =>$values_default[32], "value" =>$values[32], "langid" =>32, "ischanged" => $is_changed[32]),
		    array("param" => "Prewash forwards: swing frame turning point", "default_value" =>$values_default[33], "value" =>$values[33], "langid" =>33, "ischanged" => $is_changed[33]),
		    array("param" => "HP wash forwards: swing frame turning point", "default_value" =>$values_default[34], "value" =>$values[34], "langid" =>34, "ischanged" => $is_changed[34]),
			array("param" => "Chassis wash: reverse travel initiation distance from rear wheel", "default_value" =>$values_default[35], "value" =>$values[35], "langid" =>35, "ischanged" => $is_changed[35]),
			array("param" => "Wheel wash (parallel with side HP): front wheel distance adjustment", "default_value" =>$values_default[36], "value" =>$values[36], "langid" =>36, "ischanged" => $is_changed[36]),
			array("param" => "Wheel wash (parallel with side HP): rear wheel distance adjustment", "default_value" =>$values_default[37], "value" =>$values[37], "langid" =>37, "ischanged" => $is_changed[37]),
			array("param" => "Wheelprewash spraying time", "default_value" =>$values_default[38], "value" =>$values[38], "langid" =>38, "ischanged" => $is_changed[38]),
			array("param" => "Wheel wash: minimum wheel size", "default_value" =>$values_default[39], "value" =>$values[39], "langid" =>39, "ischanged" => $is_changed[39]),
			array("param" => "Wheel wash: maximum wheel size", "default_value" =>$values_default[40], "value" =>$values[40], "langid" =>40, "ischanged" => $is_changed[40]),
			
			array("param" => "Prewash forwards from sides (FC mode): start point", "default_value" =>$values_default[41], "value" =>$values[41], "langid" =>41, "ischanged" => $is_changed[41]),
		    array("param" => "Prewash backwards from sides (FC mode): start point", "default_value" =>$values_default[42], "value" =>$values[42], "langid" =>42, "ischanged" => $is_changed[42]),
		    array("param" => "Prewash forwards from sides (FC mode): switch off point", "default_value" =>$values_default[43], "value" =>$values[43], "langid" =>43, "ischanged" => $is_changed[43]),
		    array("param" => "Wheel wash: start point at rear", "default_value" =>$values_default[44], "value" =>$values[44], "langid" =>44, "ischanged" => $is_changed[44]),
			array("param" => "Wheel wash: minimum wheelbase", "default_value" =>$values_default[45], "value" =>$values[45], "langid" =>45, "ischanged" => $is_changed[45]),
			array("param" => "Wheel wash: over travel distance", "default_value" =>$values_default[46], "value" =>$values[46], "langid" =>46, "ischanged" => $is_changed[46]),
			array("param" => "Wheel wash: start distance adjustment", "default_value" =>$values_default[47], "value" =>$values[47], "langid" =>47, "ischanged" => $is_changed[47]),
			array("param" => "Lift distance of override control", "default_value" =>$values_default[48], "value" =>$values[48], "langid" =>48, "ischanged" => $is_changed[48]),
			array("param" => "Horizontal travel distance of override control", "default_value" =>$values_default[49], "value" =>$values[49], "langid" =>49, "ischanged" => $is_changed[49]),
			array("param" => "Drying cycle: switch off point at car front", "default_value" =>$values_default[50], "value" =>$values[50], "langid" =>50, "ischanged" => $is_changed[50]),
					
			array("param" => "Drying cycle: over travel at rear", "default_value" =>$values_default[51], "value" =>$values[51], "langid" =>51, "ischanged" => $is_changed[51]),
		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52], "value" =>$values[52], "langid" =>52, "ischanged" => $is_changed[52]),
		    array("param" => "HP top wash, rotary head: vertical over travel distance upwards", "default_value" =>$values_default[53], "value" =>$values[53], "langid" =>53, "ischanged" => $is_changed[53]),
		    array("param" => "HP top wash, rotary head: horizontal over travel distance", "default_value" =>$values_default[54], "value" =>$values[54], "langid" =>54, "ischanged" => $is_changed[54]),
			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55], "value" =>$values[55], "langid" =>55, "ischanged" => $is_changed[55]),
			array("param" => "Wheelprewash alignment", "default_value" =>$values_default[56], "value" =>$values[56], "langid" =>56, "ischanged" => $is_changed[56]),
			array("param" => "Waxing and rinsing applications: over travel at rear", "default_value" =>$values_default[57], "value" =>$values[57], "langid" =>57, "ischanged" => $is_changed[57]),
			array("param" => "M:C roof frame drying with top blower ON:OFF", "default_value" =>$values_default[58], "value" =>$values[58], "langid" =>58, "ischanged" => $is_changed[58]),
			array("param" => "Blowers start interval", "default_value" =>$values_default[59], "value" =>$values[59], "langid" =>59, "ischanged" => $is_changed[59]),
			array("param" => "Drying cycle: end height at rear", "default_value" =>$values_default[60], "value" =>$values[60], "langid" =>60, "ischanged" => $is_changed[60]),
			
			array("param" => "Prewash (FO) van nozzles override control ON:OFF", "default_value" =>$values_default[61], "value" =>$values[61], "langid" =>61, "ischanged" => $is_changed[61]),
		    array("param" => "Prewash (FC) roof spraing ON:OFF", "default_value" =>$values_default[62], "value" =>$values[62], "langid" =>62, "ischanged" => $is_changed[62]),
		    array("param" => "Van identification height for extra side nozzles", "default_value" =>$values_default[63], "value" =>$values[63], "langid" =>63, "ischanged" => $is_changed[63]),
		    array("param" => "Drying cycle, rotary head:  vertical over travel upwards", "default_value" =>$values_default[64], "value" =>$values[64], "langid" =>64, "ischanged" => $is_changed[64]),
			array("param" => "Drying cycle, rotary head: horizontal over travel", "default_value" =>$values_default[65], "value" =>$values[65], "langid" =>65, "ischanged" => $is_changed[65]),
			array("param" => "Drying cycle: start point at front", "default_value" =>$values_default[66], "value" =>$values[66], "langid" =>66, "ischanged" => $is_changed[66]),
			array("param" => "Drying cycle: start point at rear if height not measured", "default_value" =>$values_default[67], "value" =>$values[67], "langid" =>67, "ischanged" => $is_changed[67]),
			array("param" => "Top HP application: over travel at rear", "default_value" =>$values_default[68], "value" =>$values[68], "langid" =>68, "ischanged" => $is_changed[68]),
			array("param" => "Top HP application: spraying time at rear", "default_value" =>$values_default[69], "value" =>$values[69], "langid" =>69, "ischanged" => $is_changed[69]),
			array("param" => "Wheel brush, rotationing time direction", "default_value" =>$values_default[70], "value" =>$values[70], "langid" =>70, "ischanged" => $is_changed[70]),
			
			array("param" => "Wheel wash and sill wash ON:OFF", "default_value" =>$values_default[71], "value" =>$values[71], "langid" =>71, "ischanged" => $is_changed[71]),
		    array("param" => "Change RO water to 'bug arc'", "default_value" =>$values_default[72], "value" =>$values[72], "langid" =>72, "ischanged" => $is_changed[72]),
		    array("param" => "Top HP application: spraying upward at rear", "default_value" =>$values_default[73], "value" =>$values[73], "langid" =>73, "ischanged" => $is_changed[73]),
		    array("param" => "Side HP application backwards: swing frame turning point", "default_value" =>$values_default[74], "value" =>$values[74], "langid" =>74, "ischanged" => $is_changed[74]),
			array("param" => "Manual start code", "default_value" =>$values_default[75], "value" =>$values[75], "langid" =>75, "ischanged" => $is_changed[75]),
			array("param" => "Wash cycle: start delay", "default_value" =>$values_default[76], "value" =>$values[76], "langid" =>76, "ischanged" => $is_changed[76]),
			array("param" => "Dwell time as parallel function", "default_value" =>$values_default[77], "value" =>$values[77], "langid" =>77, "ischanged" => $is_changed[77]),
			array("param" => "Chassis wash: start point at rear", "default_value" =>$values_default[78], "value" =>$values[78], "langid" =>78, "ischanged" => $is_changed[78]),
			array("param" => "DUO distance between home limits", "default_value" =>$values_default[79], "value" =>$values[79], "langid" =>79, "ischanged" => $is_changed[79]),
			array("param" => "Chassis wash: start advance", "default_value" =>$values_default[80], "value" =>$values[80], "langid" =>80, "ischanged" => $is_changed[80]),
			
			array("param" => "Chassis wash: maximum rear wheel recognition distance", "default_value" =>$values_default[81], "value" =>$values[81], "langid" =>81, "ischanged" => $is_changed[81]),
		    array("param" => "Chassis wash: switch off delay", "default_value" =>$values_default[82], "value" =>$values[82], "langid" =>82, "ischanged" => $is_changed[82]),
		    array("param" => "Standing delay (s) until pipeline clearance (Biojet)", "default_value" =>$values_default[83], "value" =>$values[83], "langid" =>83, "ischanged" => $is_changed[83]),
		    array("param" => "Drying cycle, rotary head: vertical over travel upwards at back", "default_value" =>$values_default[84], "value" =>$values[84], "langid" =>84, "ischanged" => $is_changed[84]),
			array("param" => "Side HP wash: over travel at rear", "default_value" =>$values_default[85], "value" =>$values[85], "langid" =>85, "ischanged" => $is_changed[85]),
			array("param" => "Wheel brush alignment", "default_value" =>$values_default[86], "value" =>$values[86], "langid" =>86, "ischanged" => $is_changed[86]),
			array("param" => "Top HP wash: start point at front", "default_value" =>$values_default[87], "value" =>$values[87], "langid" =>87, "ischanged" => $is_changed[87]),
			array("param" => "Top HP wash: start point at rear", "default_value" =>$values_default[88], "value" =>$values[88], "langid" =>88, "ischanged" => $is_changed[88]),
			array("param" => "Scanner: nozzle normal offset, cm", "default_value" =>$values_default[89], "value" =>$values[89], "langid" =>89, "ischanged" => $is_changed[89]),
			array("param" => "Brush wash: Side HP ON:OFF on front", "default_value" =>$values_default[90], "value" =>$values[90], "langid" =>90, "ischanged" => $is_changed[90]),
			
			array("param" => "Token queue ON:OFF", "default_value" =>$values_default[91], "value" =>$values[91], "langid" =>91, "ischanged" => $is_changed[91]),
		    array("param" => "Wheel prewash and sill wash without stopping ON:OFF", "default_value" =>$values_default[92], "value" =>$values[92], "langid" =>92, "ischanged" => $is_changed[92]),
		    array("param" => "Scanner: random pixel filter ON:OFF", "default_value" =>$values_default[93], "value" =>$values[93], "langid" =>93, "ischanged" => $is_changed[93]),
		    array("param" => "Scanner: masking upper cells of the light curtain", "default_value" =>$values_default[94], "value" =>$values[94], "langid" =>94, "ischanged" => $is_changed[94]),
			array("param" => "Chassis wash: back up travel distance of chassis wash", "default_value" =>$values_default[95], "value" =>$values[95], "langid" =>95, "ischanged" => $is_changed[95]),
			array("param" => "RO water application: over travel at rear", "default_value" =>$values_default[96], "value" =>$values[96], "langid" =>96, "ischanged" => $is_changed[96]),
			array("param" => "DIP: delay for rear spraying", "default_value" =>$values_default[97], "value" =>$values[97], "langid" =>97, "ischanged" => $is_changed[97]),
			array("param" => "DIP: max on time", "default_value" =>$values_default[98], "value" =>$values[98], "langid" =>98, "ischanged" => $is_changed[98]),
			array("param" => "DIP: upwards spraying time", "default_value" =>$values_default[99], "value" =>$values[99], "langid" =>99, "ischanged" => $is_changed[99]),
			array("param" => "Top brush: parking ON:OFF", "default_value" =>$values_default[100], "value" =>$values[100], "langid" =>100, "ischanged" => $is_changed[100]),
		
			array("param" => "Use of 30 token ON:OFF", "default_value" =>$values_default[101], "value" =>$values[101], "langid" =>101, "ischanged" => $is_changed[101]),
		    array("param" => "Wax and rinse applications: nozzle distance from the roof", "default_value" =>$values_default[102], "value" =>$values[102], "langid" =>102, "ischanged" => $is_changed[102]),
		    array("param" => "Wax and rinse applications: over travel at front", "default_value" =>$values_default[103], "value" =>$values[103], "langid" =>103, "ischanged" => $is_changed[103]),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104], "value" =>$values[104], "langid" =>104, "ischanged" => $is_changed[104]),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105], "value" =>$values[105], "langid" =>105, "ischanged" => $is_changed[105]),
			array("param" => "Drying agent: automatic spreading at brush wash ON:OFF", "default_value" =>$values_default[106], "value" =>$values[106], "langid" =>106, "ischanged" => $is_changed[106]),
			array("param" => "Side brushes: rotation direction change ON:OFF", "default_value" =>$values_default[107], "value" =>$values[107], "langid" =>107, "ischanged" => $is_changed[107]),
			array("param" => "Defrost, draining time", "default_value" =>$values_default[108], "value" =>$values[108], "langid" =>108, "ischanged" => $is_changed[108]),
			array("param" => "Liftgears ratio", "default_value" =>$values_default[109], "value" =>$values[109], "langid" =>109, "ischanged" => $is_changed[109]),
			array("param" => "Scanner: light curtain height from the floor", "default_value" =>$values_default[110], "value" =>$values[110], "langid" =>110, "ischanged" => $is_changed[110]),
				
			array("param" => "Scanner: light curtain operation allowed", "default_value" =>$values_default[111], "value" =>$values[111], "langid" =>111, "ischanged" => $is_changed[111]),
		    array("param" => "Continuous wash ON:OFF", "default_value" =>$values_default[112], "value" =>$values[112], "langid" =>112, "ischanged" => $is_changed[112]),
		    array("param" => "Side brushes Ia", "default_value" =>$values_default[113], "value" =>$values[113], "langid" =>113, "ischanged" => $is_changed[113]),
		    array("param" => "Side brushes: 1:3 dI%", "default_value" =>$values_default[114], "value" =>$values[114], "langid" =>114, "ischanged" => $is_changed[114]),
			array("param" => "Side brushes: 2:3 dI%", "default_value" =>$values_default[115], "value" =>$values[115], "langid" =>115, "ischanged" => $is_changed[115]),
			array("param" => "Side brushes dI", "default_value" =>$values_default[116], "value" =>$values[116], "langid" =>116, "ischanged" => $is_changed[116]),
			array("param" => "Top brush Ia", "default_value" =>$values_default[117], "value" =>$values[117], "langid" =>117, "ischanged" => $is_changed[117]),
			array("param" => "Top brush 1:3 dI%", "default_value" =>$values_default[118], "value" =>$values[118], "langid" =>118, "ischanged" => $is_changed[118]),
			array("param" => "Top brush 2:3 dI%", "default_value" =>$values_default[119], "value" =>$values[119], "langid" =>119, "ischanged" => $is_changed[119]),
			array("param" => "Top brush dI", "default_value" =>$values_default[120], "value" =>$values[120], "langid" =>120, "ischanged" => $is_changed[120]),
				
			array("param" => "Side brushes: over travel at rear", "default_value" =>$values_default[121], "value" =>$values[121], "langid" =>121, "ischanged" => $is_changed[121]),
		    array("param" => "Side brushes: over travel at front", "default_value" =>$values_default[122], "value" =>$values[122], "langid" =>122, "ischanged" => $is_changed[122]),
		    array("param" => "Side brushes crossover wash: traverse distance", "value" =>$values[123], "default_value" =>$values_default[123], "langid" =>123, "ischanged" => $is_changed[123]),
		    array("param" => "Side brushes: corner override distance", "default_value" =>$values_default[124], "value" =>$values[124], "langid" =>124, "ischanged" => $is_changed[124]),
			array("param" => "Side brushes: brushes extended distance", "default_value" =>$values_default[125], "value" =>$values[125], "langid" =>125, "ischanged" => $is_changed[125]),
			array("param" => "Side brushes: tilting point", "default_value" =>$values_default[126], "value" =>$values[126], "langid" =>126, "ischanged" => $is_changed[126]),
			array("param" => "Brush wash forwards: middle car point", "default_value" =>$values_default[127], "value" =>$values[127],"langid" =>127, "ischanged" => $is_changed[127]),
			array("param" => "Brush wash backwards: middle car point", "default_value" =>$values_default[128], "value" =>$values[128], "langid" =>128, "ischanged" => $is_changed[128]),
			array("param" => "Top brush: descending distance to trigger top brush reversing", "default_value" =>$values_default[129], "value" =>$values[129],"langid" =>129, "ischanged" => $is_changed[129]),
			array("param" => "Top brush: back off feature enable distance at front", "default_value" =>$values_default[130], "value" =>$values[130], "langid" =>130, "ischanged" => $is_changed[130]),

			array("param" => "Top brush: back off feature enable distance at rear", "default_value" =>$values_default[131], "value" =>$values[131], "langid" =>131, "ischanged" => $is_changed[131]),
		    array("param" => "Top brush reversing: prior override distance", "default_value" =>$values_default[132], "value" =>$values[132], "langid" =>132, "ischanged" => $is_changed[132]),
		    array("param" => "Side brushes: van identification height for tilting", "default_value" =>$values_default[133], "value" =>$values[133], "langid" =>133, "ischanged" => $is_changed[133]),
		    array("param" => "Side brushes: Ia value at sill wash (tilting outwards)", "default_value" =>$values_default[134], "value" =>$values[134], "langid" =>134, "ischanged" => $is_changed[134]),
			array("param" => "Side brushes: dI value at sill wash (tilting outwards)", "default_value" =>$values_default[135], "value" =>$values[135], "langid" =>135, "ischanged" => $is_changed[135]),
			array("param" => "Lava Foam: spraying time at front", "default_value" =>$values_default[136], "value" =>$values[136], "langid" =>136, "ischanged" => $is_changed[136]),  // Tuki 150:lle parametrille v4.7, updKHu
			array("param" => "The maximum wait time of the customer for washing", "default_value" =>$values_default[137], "value" =>$values[137], "langid" =>137, "ischanged" => $is_changed[137]),
			array("param" => "Reserve1", "default_value" =>$values_default[138], "value" =>$values[138], "langid" =>138, "ischanged" => $is_changed[138]),
			array("param" => "Reserve2", "default_value" =>$values_default[139], "value" =>$values[139], "langid" =>139, "ischanged" => $is_changed[139]),
			array("param" => "Reserve3", "default_value" =>$values_default[140], "value" =>$values[140], "langid" =>140, "ischanged" => $is_changed[140]),

			array("param" => "Reserve4", "default_value" =>$values_default[141], "value" =>$values[141], "langid" =>141, "ischanged" => $is_changed[141]),
			array("param" => "Reserve5", "default_value" =>$values_default[142], "value" =>$values[142], "langid" =>142, "ischanged" => $is_changed[142]),
			array("param" => "Reserve6", "default_value" =>$values_default[143], "value" =>$values[143], "langid" =>143, "ischanged" => $is_changed[143]),
			array("param" => "Reserve7", "default_value" =>$values_default[144], "value" =>$values[144], "langid" =>144, "ischanged" => $is_changed[144]),
			array("param" => "Reserve8", "default_value" =>$values_default[145], "value" =>$values[145], "langid" =>145, "ischanged" => $is_changed[145]),
			array("param" => "Reserve9", "default_value" =>$values_default[146], "value" =>$values[146], "langid" =>146, "ischanged" => $is_changed[146]),
			array("param" => "Reserve10", "default_value" =>$values_default[147], "value" =>$values[147], "langid" =>147, "ischanged" => $is_changed[147]),
			array("param" => "Reserve11", "default_value" =>$values_default[148], "value" =>$values[148], "langid" =>148, "ischanged" => $is_changed[148]),
			array("param" => "Reserve12", "default_value" =>$values_default[149], "value" =>$values[149], "langid" =>149, "ischanged" => $is_changed[149]),
			array("param" => "Reserve13", "default_value" =>$values_default[150], "value" =>$values[150], "langid" =>150, "ischanged" => $is_changed[150])),
			
			3 => array( // Gategoria: Esipesu1 päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Prewash (FO mode) and foam applications: full speed reference", "default_value" =>$values_default[2], "value" =>$values[2],  "langid" =>2),
		    array("param" => "Prewash: travel speed  at rear", "default_value" =>$values_default[3],  "value" =>$values[3], "langid" =>3),
			array("param" => "Prewash (FC mode) at roof: full-speed reference", "default_value" =>$values_default[5],  "value" =>$values[5], "langid" =>5),
		    array("param" => "HP top wash and prewash (FC mode): full-speed reference", "default_value" =>$values_default[12],  "value" =>$values[12], "langid" =>12),
		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14],  "value" =>$values[14], "langid" =>14),
		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23],  "value" =>$values[23], "langid" =>23),
			array("param" => "Prewash: over-travel at rear", "default_value" =>$values_default[28],  "value" =>$values[28], "langid" =>28),
			array("param" => "Van nozzles: automatic mode ON:OFF", "default_value" =>$values_default[29],  "value" =>$values[29], "langid" =>29),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30],  "value" =>$values[30], "langid" =>30),
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31],  "value" =>$values[31], "langid" =>31),
		    array("param" => "Prewash forwards: swing frame turning point", "default_value" =>$values_default[33],  "value" =>$values[33], "langid" =>33),
			array("param" => "Prewash forwards from sides (FC mode): start point", "default_value" =>$values_default[41],  "value" =>$values[41], "langid" =>41),
		    array("param" => "Prewash backwards from sides (FC mode): start point", "default_value" =>$values_default[42],  "value" =>$values[42], "langid" =>42),
		    array("param" => "Prewash forwards from sides (FC mode): switch-off point", "default_value" =>$values_default[43],  "value" =>$values[43], "langid" =>43),
		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52],  "value" =>$values[52], "langid" =>52),
			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55],  "value" =>$values[55], "langid" =>55),
			array("param" => "Prewash (FO) van nozzles override control ON:OFF", "default_value" =>$values_default[61],  "value" =>$values[61], "langid" =>61),
		    array("param" => "Prewash (FC) roof spraing ON:OFF", "default_value" =>$values_default[62],  "value" =>$values[62], "langid" =>62),
		    array("param" => "Van identification height for extra side nozzles", "default_value" =>$values_default[63],  "value" =>$values[63], "langid" =>63),
		    array("param" => "Wheel prewash + sill wash without stopping ON/OFF", "default_value" =>$values_default[92],  "value" =>$values[92], "langid" =>92), // updKHu
		    array("param" => "DIP: delay for rear spraying", "default_value" =>$values_default[97],  "value" =>$values[97], "langid" =>97), // updKHu
		    array("param" => "DIP: max on time", "default_value" =>$values_default[98],  "value" =>$values[98], "langid" =>98), // updKHu
		    array("param" => "DIP: upwards spraying time", "default_value" =>$values_default[99],  "value" =>$values[99], "langid" =>99)), // updKHu
			
			4 => array( // Gategoria: Esipesu2 päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Prewash (FO mode) and foam applications: full-speed reference", "default_value" =>$values_default[2],  "value" =>$values[2], "langid" =>2),
		    array("param" => "Prewash: travel speed  at rear", "default_value" =>$values_default[3],  "value" =>$values[3], "langid" =>3),
//			array("param" => "Prewash (FC mode) at roof: full-speed reference", "default_value" =>$values_default[5],  "value" =>$values[5], "langid" =>5), // updKHu
//		    array("param" => "HP top wash and prewash (FC mode): full-speed reference", "default_value" =>$values_default[12],  "value" =>$values[12], "langid" =>12), // updKHu
//		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14],  "value" =>$values[14], "langid" =>14), // updKHu
//		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23],  "value" =>$values[23], "langid" =>23), // updKHu
			array("param" => "Prewash: over-travel at rear", "default_value" =>$values_default[28],  "value" =>$values[28], "langid" =>28),
			array("param" => "Van nozzles: automatic mode ON:OFF", "default_value" =>$values_default[29],  "value" =>$values[29], "langid" =>29),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30],  "value" =>$values[30], "langid" =>30),
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31],  "value" =>$values[31], "langid" =>31),
		    array("param" => "Prewash forwards: swing frame turning point", "default_value" =>$values_default[33],  "value" =>$values[33], "langid" =>33),
//			array("param" => "Prewash forwards from sides (FC mode): start point", "default_value" =>$values_default[41],  "value" =>$values[41], "langid" =>41), // updKHu
//		    array("param" => "Prewash backwards from sides (FC mode): start point", "default_value" =>$values_default[42],  "value" =>$values[42], "langid" =>42), // updKHu
//		    array("param" => "Prewash forwards from sides (FC mode): switch-off point", "default_value" =>$values_default[43],  "value" =>$values[43], "langid" =>43), // updKHu
//		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52],  "value" =>$values[52], "langid" =>52), // updKHu
//			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55],  "value" =>$values[55], "langid" =>55), // updKHu
			array("param" => "Prewash (FO) van nozzles override control ON:OFF", "default_value" =>$values_default[61],  "value" =>$values[61], "langid" =>61),
//		    array("param" => "Prewash (FC) roof spraing ON:OFF", "default_value" =>$values_default[62],  "value" =>$values[62], "langid" =>62), // updKHu
		    array("param" => "Van identification height for extra side nozzles", "default_value" =>$values_default[63],  "value" =>$values[63], "langid" =>63)),
			
			5 => array( // Gategoria: Vaahto päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Prewash (FO mode) and foam applications: full-speed reference", "default_value" =>$values_default[2],  "value" =>$values[2], "langid" =>2),
			array("param" => "Foam application: overtravel at rear", "default_value" =>$values_default[26],  "value" =>$values[26], "langid" =>26),
			array("param" => "Foam application: over-travel at front", "default_value" =>$values_default[27],  "value" =>$values[27], "langid" =>27),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30],  "value" =>$values[30], "langid" =>30),
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31],  "value" =>$values[31], "langid" =>31),
			array("param" => "Lavafoam flow angle", "default_value" =>$values_default[75], "value" =>$values[75], "langid" =>75), // updKHu
			array("param" => "Lava Foam: spraying time at front", "default_value" =>$values_default[136], "value" =>$values[136], "langid" =>136)), // updKHu
			
			6 => array( // Gategoria: Vaikutusaika
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Dwell time as parallel function", "default_value" =>$values_default[77],  "value" =>$values[77], "langid" =>77)),

			7 => array( // Gategoria: Alustanpesu
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Chassis wash: full-speed reference", "default_value" =>$values_default[10],  "value" =>$values[10], "langid" =>10),
			array("param" => "Chassis wash: reverse travel initiation distance from rear wheel", "default_value" =>$values_default[35],  "value" =>$values[35], "langid" =>35),
			array("param" => "Chassis wash: start point at rear", "default_value" =>$values_default[78],  "value" =>$values[78], "langid" =>78),
			array("param" => "Chassis wash: start advance", "default_value" =>$values_default[80],  "value" =>$values[80], "langid" =>80),
			array("param" => "Chassis wash: maximum rear wheel recognition distance", "default_value" =>$values_default[81],  "value" =>$values[81], "langid" =>81),
		    array("param" => "Chassis wash: switch-off delay", "default_value" =>$values_default[82],  "value" =>$values[82], "langid" =>82),
			array("param" => "Chassis wash: back-up travel distance of chassis wash", "default_value" =>$values_default[95],  "value" =>$values[95], "langid" =>95)),
			
			8 => array( // Gategoria: Pyöräpesu KP
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Wheel wash: full-speed reference", "default_value" =>$values_default[11],  "value" =>$values[11], "langid" =>11),
			array("param" => "Wheel wash (parallel with side HP): front wheel distance adjustment", "default_value" =>$values_default[36],  "value" =>$values[36], "langid" =>36),
			array("param" => "Wheel wash (parallel with side HP): rear wheel distance adjustment", "default_value" =>$values_default[37],  "value" =>$values[37], "langid" =>37),
			array("param" => "Wheelprewash spraying time", "default_value" =>$values_default[38],  "value" =>$values[38], "langid" =>38),
			array("param" => "Wheel wash: minimum wheel size", "default_value" =>$values_default[39],  "value" =>$values[39], "langid" =>39),
			array("param" => "Wheel wash: maximum wheel size", "default_value" =>$values_default[40],  "value" =>$values[40], "langid" =>40),
		    array("param" => "Wheel wash: start point at rear", "default_value" =>$values_default[44],  "value" =>$values[44], "langid" =>44),
			array("param" => "Wheel wash: minimum wheelbase", "default_value" =>$values_default[45],  "value" =>$values[45], "langid" =>45),
			array("param" => "Wheel wash: over-travel distance", "default_value" =>$values_default[46],  "value" =>$values[46], "langid" =>46),
			array("param" => "Wheel wash: start distance adjustment", "default_value" =>$values_default[47],  "value" =>$values[47], "langid" =>47),
			array("param" => "Wheelprewash alignment", "default_value" =>$values_default[56],  "value" =>$values[56], "langid" =>56)),
			
			9 => array( // Gategoria: Sivu KP
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "HP side wash: full-speed reference", "default_value" =>$values_default[13],  "value" =>$values[13], "langid" =>13),
			array("param" => "Van nozzles: automatic mode ON:OFF", "default_value" =>$values_default[29],  "value" =>$values[29], "langid" =>29),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30],  "value" =>$values[30], "langid" =>30),
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31],  "value" =>$values[31], "langid" =>31),
		    array("param" => "HP wash forwards: swing frame turning point", "default_value" =>$values_default[34],  "value" =>$values[34], "langid" =>34),
		    array("param" => "Van identification height for extra side nozzles", "default_value" =>$values_default[63],  "value" =>$values[63], "langid" =>63),
		    array("param" => "Side HP application backwards: swing frame turning point", "default_value" =>$values_default[74],  "value" =>$values[74], "langid" =>74),
			array("param" => "Side HP wash: over-travel at rear", "default_value" =>$values_default[85],  "value" =>$values[85], "langid" =>85)),
			
			10 => array( // Gategoria: Katto KP
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "HP top wash and prewash (FC mode): full-speed reference", "default_value" =>$values_default[12],  "value" =>$values[12], "langid" =>12),
		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14],  "value" =>$values[14], "langid" =>14),
		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23],  "value" =>$values[23], "langid" =>23),
		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52],  "value" =>$values[52], "langid" =>52),
		    array("param" => "HP top wash - rotary head: vertical over-travel distance upwards", "default_value" =>$values_default[53],  "value" =>$values[53], "langid" =>53),
		    array("param" => "HP top wash - rotary head: horizontal over-travel distance", "default_value" =>$values_default[54],  "value" =>$values[54], "langid" =>54),
			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55],  "value" =>$values[55], "langid" =>55),
			array("param" => "Top HP application: over-travel at rear", "default_value" =>$values_default[68],  "value" =>$values[68], "langid" =>68),
			array("param" => "Top HP application: spraying time at rear", "default_value" =>$values_default[69],  "value" =>$values[69], "langid" =>69),
			array("param" => "Top HP wash: start point at front", "default_value" =>$values_default[87],  "value" =>$values[87], "langid" =>87),
			array("param" => "Top HP wash: start point at rear", "default_value" =>$values_default[88],  "value" =>$values[88], "langid" =>88)),
			
			11 => array( // Gategoria: Harjapesu päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Brush wash: low speed", "default_value" =>$values_default[16],  "value" =>$values[16], "langid" =>16),
			array("param" => "Travel speed during cross-over wash", "default_value" =>$values_default[17],  "value" =>$values[17], "langid" =>17),
			array("param" => "Brush wash: corner bypass travel speed", "default_value" =>$values_default[18],  "value" =>$values[18], "langid" =>18),
			array("param" => "Top brush: high ascending speed", "default_value" =>$values_default[19],  "value" =>$values[19], "langid" =>19),
			array("param" => "Top brush: low ascending speed", "default_value" =>$values_default[20],  "value" =>$values[20], "langid" =>20),
			array("param" => "Brush wash: back-off speed at front and rear", "default_value" =>$values_default[21],  "value" =>$values[21], "langid" =>21),
		    array("param" => "Brush wash: travel speed on sides", "default_value" =>$values_default[22],  "value" =>$values[22], "langid" =>22),
			array("param" => "Brush wash: Side HP ON:OFF on front", "default_value" =>$values_default[90], "value" =>$values[90], "langid" =>90), // updKHu
			array("param" => "Drying agent: automatic spreading at brush wash ON:OFF", "default_value" =>$values_default[106],  "value" =>$values[106], "langid" =>106),
			array("param" => "Side brushes: rotation direction change ON:OFF", "default_value" =>$values_default[107],  "value" =>$values[107], "langid" =>107),
		    array("param" => "Side brushes Ia", "default_value" =>$values_default[113],  "value" =>$values[113], "langid" =>113),
		    array("param" => "Side brushes: 1:3 dI-%", "default_value" =>$values_default[114],  "value" =>$values[114], "langid" =>114),
			array("param" => "Side brushes: 2:3 dI-%", "default_value" =>$values_default[115],  "value" =>$values[115], "langid" =>115),
			array("param" => "Side brushes dI", "default_value" =>$values_default[116],  "value" =>$values[116], "langid" =>116),
			array("param" => "Top brush Ia", "default_value" =>$values_default[117],  "value" =>$values[117], "langid" =>117),
			array("param" => "Top brush 1:3 dI-%", "default_value" =>$values_default[118],  "value" =>$values[118], "langid" =>118),
			array("param" => "Top brush 2:3 dI-%", "default_value" =>$values_default[119],  "value" =>$values[119], "langid" =>119),
			array("param" => "Top brush dI", "default_value" =>$values_default[120],  "value" =>$values[120], "langid" =>120),
			array("param" => "Side brushes: over-travel at rear", "default_value" =>$values_default[121],  "value" =>$values[121], "langid" =>121),
		    array("param" => "Side brushes: over-travel at front", "default_value" =>$values_default[122],  "value" =>$values[122], "langid" =>122),
		    array("param" => "Side brushes crossover wash: traverse distance", "default_value" =>$values_default[123],  "value" =>$values[123], "langid" =>123),
			array("param" => "Side brushes: corner override distance", "default_value" =>$values_default[124],  "value" =>$values[124], "langid" =>124),
			array("param" => "Side brushes: brushes extended distance", "default_value" =>$values_default[125],  "value" =>$values[125], "langid" =>125),
			array("param" => "Side brushes: tilting point", "default_value" =>$values_default[126],  "value" =>$values[126], "langid" =>126),
			array("param" => "Brush wash forwards: middle car point", "default_value" =>$values_default[127],  "value" =>$values[127], "langid" =>127),
			array("param" => "Brush wash backwards: middle car point", "default_value" =>$values_default[128],  "value" =>$values[128], "langid" =>128),
			array("param" => "Top brush: descending distance to trigger top brush reversing", "default_value" =>$values_default[129],  "value" =>$values[129], "langid" =>129),
			array("param" => "Top brush: back-off feature enable distance at front", "default_value" =>$values_default[130],  "value" =>$values[130], "langid" =>130),
			array("param" => "Top brush: back-off feature enable distance at rear", "default_value" =>$values_default[131],  "value" =>$values[131], "langid" =>131),
		    array("param" => "Top brush reversing: prior override distance", "default_value" =>$values_default[132], "value" =>$values[132],  "langid" =>132),
		    array("param" => "Side brushes: van identification height for tilting", "default_value" =>$values_default[133],  "value" =>$values[133], "langid" =>133),
		    array("param" => "Side brushes: Ia value at sill wash (tilting outwards)", "default_value" =>$values_default[134],  "value" =>$values[134], "langid" =>134),
			array("param" => "Side brushes: dI value at sill wash (tilting outwards)", "default_value" =>$values_default[135],  "value" =>$values[135], "langid" =>135)),
			
			12 => array( // Gategoria: Vesihuuhtelu
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6],  "value" =>$values[6], "langid" =>6),
			array("param" => "Waxing and rinsing applications: over-travel at rear", "default_value" =>$values_default[57],  "value" =>$values[57], "langid" =>57),
		    array("param" => "Wax and rinse applications: over-travel at front", "default_value" =>$values_default[103],  "value" =>$values[103], "langid" =>103)),
			
			13 => array( // Gategoria: KP Huuhtelu -> Pyöräharjat päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Wheel brush: rotationing time, direction", "default_value" =>$values_default[70],  "value" =>$values[70], "langid" =>70),
		    array("param" => "Wheel brush alignment", "default_value" =>$values_default[86],  "value" =>$values[86], "langid" =>86)),
			
			14 => array( // Gategoria: Osmoosivesi
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6],  "value" =>$values[6], "langid" =>6),
			array("param" => "RO-water application: over-travel at rear", "default_value" =>$values_default[96],  "value" =>$values[96], "langid" =>96),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104],  "value" =>$values[104], "langid" =>104),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105],  "value" =>$values[105], "langid" =>105)),
			
			15 => array( // Gategoria: Vaha päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6],  "value" =>$values[6], "langid" =>6),
			array("param" => "Waxing and rinsing applications: over-travel at rear", "default_value" =>$values_default[57],  "value" =>$values[57], "langid" =>57),
		    array("param" => "Wax and rinse applications: nozzle distance from the roof", "default_value" =>$values_default[102], "value" =>$values[102], "langid" =>102), // updKHu
		    array("param" => "Wax and rinse applications: over-travel at front", "default_value" =>$values_default[103],  "value" =>$values[103], "langid" =>103),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104],  "value" =>$values[104], "langid" =>104),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105],  "value" =>$values[105], "langid" =>105)),
			
			16 => array( // Gategoria: Kuivausvaha päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6],  "value" =>$values[6], "langid" =>6),
			array("param" => "Waxing and rinsing applications: over-travel at rear", "default_value" =>$values_default[57],  "value" =>$values[57], "langid" =>57),
		    array("param" => "Wax and rinse applications: nozzle distance from the roof", "default_value" =>$values_default[102], "value" =>$values[102], "langid" =>102), // updKHu
		    array("param" => "Wax and rinse applications: over-travel at front", "default_value" =>$values_default[103],  "value" =>$values[103], "langid" =>103),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104],  "value" =>$values[104], "langid" =>104),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105],  "value" =>$values[105], "langid" =>105)),
			
			17 => array( // Gategoria: Harjavaha päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6],  "value" =>$values[6], "langid" =>6),
			array("param" => "Waxing and rinsing applications: over-travel at rear", "default_value" =>$values_default[57],  "value" =>$values[57], "langid" =>57),
		    array("param" => "Wax and rinse applications: nozzle distance from the roof", "default_value" =>$values_default[102], "value" =>$values[102], "langid" =>102), // updKHu
		    array("param" => "Wax and rinse applications: over-travel at front", "default_value" =>$values_default[103],  "value" =>$values[103], "langid" =>103),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104],  "value" =>$values[104], "langid" =>104),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105],  "value" =>$values[105], "langid" =>105)),
			
			18 => array( // Gategoria: Kiillotus päivitetty, updKHu v4.7
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Brush wash: low speed", "default_value" =>$values_default[16],  "value" =>$values[16], "langid" =>16),
			array("param" => "Travel speed during cross-over wash", "default_value" =>$values_default[17],  "value" =>$values[17], "langid" =>17),
			array("param" => "Brush wash: corner bypass travel speed", "default_value" =>$values_default[18],  "value" =>$values[18], "langid" =>18),
			array("param" => "Brush wash: back-off speed at front and rear", "default_value" =>$values_default[21],  "value" =>$values[21], "langid" =>21),
		    array("param" => "Brush wash: travel speed on sides", "default_value" =>$values_default[2],  "value" =>$values[22], "langid" =>22),
		    array("param" => "Tire shining speed", "default_value" =>$values_default[24], "value" =>$values[24], "langid" =>24), // updKHu
			array("param" => "Side brushes: rotation direction change ON:OFF", "default_value" =>$values_default[107],  "value" =>$values[107], "langid" =>107),
		    array("param" => "Side brushes Ia", "default_value" =>$values_default[113],  "value" =>$values[113], "langid" =>113),
		    array("param" => "Side brushes: 1:3 dI-%", "default_value" =>$values_default[114],  "value" =>$values[114], "langid" =>114),
			array("param" => "Side brushes: 2:3 dI-%", "default_value" =>$values_default[115],  "value" =>$values[115], "langid" =>115),
			array("param" => "Side brushes dI", "default_value" =>$values_default[116],  "value" =>$values[116], "langid" =>116),
			array("param" => "Top brush Ia", "default_value" =>$values_default[117],  "value" =>$values[117], "langid" =>117),
			array("param" => "Top brush 1:3 dI-%", "default_value" =>$values_default[118],  "value" =>$values[118], "langid" =>118),
			array("param" => "Top brush 2:3 dI-%", "default_value" =>$values_default[119],  "value" =>$values[119], "langid" =>119),
			array("param" => "Top brush dI", "default_value" =>$values_default[120],  "value" =>$values[120], "langid" =>120),
			array("param" => "Side brushes: over-travel at rear", "default_value" =>$values_default[121],  "value" =>$values[121], "langid" =>121),
		    array("param" => "Side brushes: over-travel at front", "default_value" =>$values_default[122],  "value" =>$values[122], "langid" =>122),
		    array("param" => "Side brushes crossover wash: traverse distance", "default_value" =>$values_default[123],  "value" =>$values[123], "langid" =>123),
		    array("param" => "Side brushes: corner override distance", "default_value" =>$values_default[124],  "value" =>$values[124], "langid" =>124),
			array("param" => "Side brushes: brushes extended distance", "default_value" =>$values_default[125],  "value" =>$values[125], "langid" =>125),
			array("param" => "Side brushes: tilting point", "default_value" =>$values_default[126],  "value" =>$values[126], "langid" =>126),
			array("param" => "Brush wash forwards: middle car point", "default_value" =>$values_default[127],  "value" =>$values[127], "langid" =>127),
			array("param" => "Brush wash backwards: middle car point", "default_value" =>$values_default[128],  "value" =>$values[128], "langid" =>128),
			array("param" => "Top brush: descending distance to trigger top brush reversing", "default_value" =>$values_default[129],  "value" =>$values[129], "langid" =>129),
			array("param" => "Top brush: back-off feature enable distance at front", "default_value" =>$values_default[130],  "value" =>$values[130], "langid" =>130),
			array("param" => "Top brush: back-off feature enable distance at rear", "default_value" =>$values_default[131],  "value" =>$values[131], "langid" =>131),
		    array("param" => "Top brush reversing: prior override distance", "default_value" =>$values_default[132],  "value" =>$values[132], "langid" =>132),
		    array("param" => "Side brushes: van identification height for tilting", "default_value" =>$values_default[133],  "value" =>$values[133], "langid" =>133),
		    array("param" => "Side brushes: Ia value at sill wash (tilting outwards)", "default_value" =>$values_default[134],  "value" =>$values[134], "langid" =>134),
			array("param" => "Side brushes: dI value at sill wash (tilting outwards)", "default_value" =>$values_default[135],  "value" =>$values[135], "langid" =>135)),
			
			19 => array( // Gategoria: Kuivaus
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Drying cycle: full-speed reference", "default_value" =>$values_default[4],  "value" =>$values[4], "langid" =>4),
		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14],  "value" =>$values[14], "langid" =>14),
			array("param" => "Rotary head: high ascending speed", "default_value" =>$values_default[15],  "value" =>$values[15], "langid" =>15),
		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23],  "value" =>$values[23], "langid" =>23),
			array("param" => "Drying cycle: switch-off point at car front", "default_value" =>$values_default[50],  "value" =>$values[50], "langid" =>50),
			array("param" => "Drying cycle: over-travel at rear", "default_value" =>$values_default[51],  "value" =>$values[51], "langid" =>51),
		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52],  "value" =>$values[52], "langid" =>52),
			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55],  "value" =>$values[55], "langid" =>55),
			array("param" => "M:C roof frame drying with top blower ON:OFF", "default_value" =>$values_default[58],  "value" =>$values[58], "langid" =>58),
			array("param" => "Blowers start interval", "default_value" =>$values_default[59],  "value" =>$values[59], "langid" =>59),
			array("param" => "Drying cycle: end height at rear", "default_value" =>$values_default[60],  "value" =>$values[60], "langid" =>60),
		    array("param" => "Drying cycle - rotary head:  vertical over-travel upwards", "default_value" =>$values_default[64],  "value" =>$values[64], "langid" =>64),
			array("param" => "Drying cycle - rotary head: horizontal over-travel", "default_value" =>$values_default[65],  "value" =>$values[65], "langid" =>65),
			array("param" => "Drying cycle: start point at front", "default_value" =>$values_default[66],  "value" =>$values[66], "langid" =>66),
			array("param" => "Drying cycle: start point at rear if height not measured", "default_value" =>$values_default[67],  "value" =>$values[67], "langid" =>67),
		    array("param" => "Drying cycle - rotary head: vertical over-travel upwards at back", "default_value" =>$values_default[84],  "value" =>$values[84], "langid" =>84)),
			
			20 => array( // Gategoria: Kaikki parametrit
			array("param" => "Parameters quantity", "default_value" =>$values_default[0], "value" =>$values[0], "langid" =>0), // updKHu v4.7
			array("param" => "Speed of indexing motion", "default_value" =>$values_default[1], "value" =>$values[1], "langid" =>1),
		    array("param" => "Prewash (FO mode) and foam applications: full-speed reference", "default_value" =>$values_default[2], "value" =>$values[2], "langid" =>2),
		    array("param" => "Prewash: travel speed  at rear", "default_value" =>$values_default[3],"value" =>$values[3], "langid" =>3),
		    array("param" => "Drying cycle: full-speed reference", "default_value" =>$values_default[4], "value" =>$values[4], "langid" =>4),
			array("param" => "Prewash (FC mode) at roof: full-speed reference", "default_value" =>$values_default[5], "value" =>$values[5], "langid" =>5),
			array("param" => "Waxing, rinsing and RO-water application: full-speed reference", "default_value" =>$values_default[6], "value" =>$values[6], "langid" =>6),
			array("param" => "Floor washing cycle speed", "default_value" =>$values_default[7], "value" =>$values[7], "langid" =>7),
			array("param" => "Travel speed during start movements", "default_value" =>$values_default[8], "value" =>$values[8], "langid" =>8),
			array("param" => "Override speed", "default_value" =>$values_default[9], "value" =>$values[9], "langid" =>9),
			array("param" => "Chassis wash: full-speed reference", "default_value" =>$values_default[10], "value" =>$values[10], "langid" =>10),
			
			array("param" => "Wheel wash: full-speed reference", "default_value" =>$values_default[11], "value" =>$values[11], "langid" =>11),
		    array("param" => "HP top wash and prewash (FC mode): full-speed reference", "default_value" =>$values_default[12], "value" =>$values[12], "langid" =>12),
		    array("param" => "HP side wash: full-speed reference", "default_value" =>$values_default[13], "value" =>$values[13], "langid" =>13),
		    array("param" => "Rotary head: descending speed", "default_value" =>$values_default[14], "value" =>$values[14], "langid" =>14),
			array("param" => "Rotary head: high ascending speed", "default_value" =>$values_default[15], "value" =>$values[15], "langid" =>15),
			array("param" => "Brush wash: low speed", "default_value" =>$values_default[16], "value" =>$values[16], "langid" =>16),
			array("param" => "Travel speed during cross-over wash", "default_value" =>$values_default[17], "value" =>$values[17], "langid" =>17),
			array("param" => "Brush wash: corner bypass travel speed", "default_value" =>$values_default[18], "value" =>$values[18], "langid" =>18),
			array("param" => "Top brush: high ascending speed", "default_value" =>$values_default[19], "value" =>$values[19], "langid" =>19),
			array("param" => "Top brush: low ascending speed", "default_value" =>$values_default[20], "value" =>$values[20], "langid" =>20),
			
			array("param" => "Brush wash: back-off speed at front and rear", "default_value" =>$values_default[21], "value" =>$values[21], "langid" =>21),
		    array("param" => "Brush wash: travel speed on sides", "default_value" =>$values_default[22], "value" =>$values[22], "langid" =>22),
		    array("param" => "Rotary head: ascending speed", "default_value" =>$values_default[23], "value" =>$values[23], "langid" =>23),
		    array("param" => "Tire shining speed", "default_value" =>$values_default[24], "value" =>$values[24], "langid" =>24),
			array("param" => "Length of indexing motion", "default_value" =>$values_default[25], "value" =>$values[25], "langid" =>25),
			array("param" => "Foam application: over travel at rear", "default_value" =>$values_default[26], "value" =>$values[26], "langid" =>26),
			array("param" => "Foam application: over travel at front", "default_value" =>$values_default[27], "value" =>$values[27], "langid" =>27),
			array("param" => "Prewash: over travel at rear", "default_value" =>$values_default[28], "value" =>$values[28], "langid" =>28),
			array("param" => "Van nozzles: automatic mode ON:OFF", "default_value" =>$values_default[29], "value" =>$values[29], "langid" =>29),
			array("param" => "Prewash (FO), foam and side HP applications: front wash time", "default_value" =>$values_default[30], "value" =>$values[30], "langid" =>30),
			
			array("param" => "Pre wash (FO), foam and side HP applications: rear wash time", "default_value" =>$values_default[31], "value" =>$values[31], "langid" =>31),
		    array("param" => "Exit time", "default_value" =>$values_default[32], "value" =>$values[32], "langid" =>32),
		    array("param" => "Prewash forwards: swing frame turning point", "default_value" =>$values_default[33], "value" =>$values[33], "langid" =>33),
		    array("param" => "HP wash forwards: swing frame turning point", "default_value" =>$values_default[34], "value" =>$values[34], "langid" =>34),
			array("param" => "Chassis wash: reverse travel initiation distance from rear wheel", "default_value" =>$values_default[35], "value" =>$values[35], "langid" =>35),
			array("param" => "Wheel wash (parallel with side HP): front wheel distance adjustment", "default_value" =>$values_default[36], "value" =>$values[36], "langid" =>36),
			array("param" => "Wheel wash (parallel with side HP): rear wheel distance adjustment", "default_value" =>$values_default[37], "value" =>$values[37], "langid" =>37),
			array("param" => "Wheelprewash spraying time", "default_value" =>$values_default[38], "value" =>$values[38], "langid" =>38),
			array("param" => "Wheel wash: minimum wheel size", "default_value" =>$values_default[39], "value" =>$values[39], "langid" =>39),
			array("param" => "Wheel wash: maximum wheel size", "default_value" =>$values_default[40], "value" =>$values[40], "langid" =>40),
			
			array("param" => "Prewash forwards from sides (FC mode): start point", "default_value" =>$values_default[41], "value" =>$values[41], "langid" =>41),
		    array("param" => "Prewash backwards from sides (FC mode): start point", "default_value" =>$values_default[42], "value" =>$values[42], "langid" =>42),
		    array("param" => "Prewash forwards from sides (FC mode): switch-off point", "default_value" =>$values_default[43], "value" =>$values[43], "langid" =>43),
		    array("param" => "Wheel wash: start point at rear", "default_value" =>$values_default[44], "value" =>$values[44], "langid" =>44),
			array("param" => "Wheel wash: minimum wheelbase", "default_value" =>$values_default[45], "value" =>$values[45], "langid" =>45),
			array("param" => "Wheel wash: over-travel distance", "default_value" =>$values_default[46], "value" =>$values[46], "langid" =>46),
			array("param" => "Wheel wash: start distance adjustment", "default_value" =>$values_default[47], "value" =>$values[47], "langid" =>47),
			array("param" => "Lift distance of override control", "default_value" =>$values_default[48], "value" =>$values[48], "langid" =>48),
			array("param" => "Horizontal travel distance of override control", "default_value" =>$values_default[49], "value" =>$values[49], "langid" =>49),
			array("param" => "Drying cycle: switch-off point at car front", "default_value" =>$values_default[50], "value" =>$values[50], "langid" =>50),
			
			array("param" => "Drying cycle: over-travel at rear", "default_value" =>$values_default[51], "value" =>$values[51], "langid" =>51),
		    array("param" => "Rotary head: descending inhibited distance at front", "default_value" =>$values_default[52], "value" =>$values[52], "langid" =>52),
		    array("param" => "HP top wash - rotary head: vertical over-travel distance upwards", "default_value" =>$values_default[53], "value" =>$values[53], "langid" =>53),
		    array("param" => "HP top wash - rotary head: horizontal over-travel distance", "default_value" =>$values_default[54], "value" =>$values[54], "langid" =>54),
			array("param" => "Rotary head: descending inhibited distance at rear", "default_value" =>$values_default[55], "value" =>$values[55], "langid" =>55),
			array("param" => "Wheelprewash alignment", "default_value" =>$values_default[56], "value" =>$values[56], "langid" =>56),
			array("param" => "Waxing and rinsing applications: over-travel at rear", "default_value" =>$values_default[57], "value" =>$values[57], "langid" =>57),
			array("param" => "M:C roof frame drying with top blower ON:OFF", "default_value" =>$values_default[58], "value" =>$values[58], "langid" =>58),
			array("param" => "Blowers start interval", "default_value" =>$values_default[59], "value" =>$values[59], "langid" =>59),
			array("param" => "Drying cycle: end height at rear", "default_value" =>$values_default[60], "value" =>$values[60], "langid" =>60),
			
			array("param" => "Prewash (FO) van nozzles override control ON:OFF", "default_value" =>$values_default[61], "value" =>$values[61], "langid" =>61),
		    array("param" => "Prewash (FC) roof spraing ON:OFF", "default_value" =>$values_default[62], "value" =>$values[62], "langid" =>62),
		    array("param" => "Van identification height for extra side nozzles", "default_value" =>$values_default[63], "value" =>$values[63], "langid" =>63),
		    array("param" => "Drying cycle - rotary head:  vertical over-travel upwards", "default_value" =>$values_default[64], "value" =>$values[64], "langid" =>64),
			array("param" => "Drying cycle - rotary head: horizontal over-travel", "default_value" =>$values_default[65], "value" =>$values[65], "langid" =>65),
			array("param" => "Drying cycle: start point at front", "default_value" =>$values_default[66], "value" =>$values[66], "langid" =>66),
			array("param" => "Drying cycle: start point at rear if height not measured", "default_value" =>$values_default[67], "value" =>$values[67], "langid" =>67),
			array("param" => "Top HP application: over-travel at rear", "default_value" =>$values_default[68], "value" =>$values[68], "langid" =>68),
			array("param" => "Top HP application: spraying time at rear", "default_value" =>$values_default[69], "value" =>$values[69], "langid" =>69),
			array("param" => "Wheel brush: rotationing time, direction", "default_value" =>$values_default[70], "value" =>$values[70], "langid" =>70),
			
			array("param" => "Wheel wash and sill wash ON:OFF", "default_value" =>$values_default[71], "value" =>$values[71], "langid" =>71),
		    array("param" => "Change RO water to 'bug arc'", "default_value" =>$values_default[72], "value" =>$values[72], "langid" =>72),
		    array("param" => "Top HP application: spraying upward at rear", "default_value" =>$values_default[73], "value" =>$values[73], "langid" =>73),
		    array("param" => "Side HP application backwards: swing frame turning point", "default_value" =>$values_default[74], "value" =>$values[74], "langid" =>74),
			array("param" => "Manual start code", "default_value" =>$values_default[75], "value" =>$values[75], "langid" =>75),
			array("param" => "Wash cycle: start delay", "default_value" =>$values_default[76], "value" =>$values[76], "langid" =>76),
			array("param" => "Dwell time as parallel function", "default_value" =>$values_default[77], "value" =>$values[77], "langid" =>77),
			array("param" => "Chassis wash: start point at rear", "default_value" =>$values_default[78], "value" =>$values[78], "langid" =>78),
			array("param" => "DUO distance between home limits", "default_value" =>$values_default[79], "value" =>$values[79], "langid" =>79),
			array("param" => "Chassis wash: start advance", "default_value" =>$values_default[80], "value" =>$values[80], "langid" =>80),
			
			array("param" => "Chassis wash: maximum rear wheel recognition distance", "default_value" =>$values_default[81], "value" =>$values[81], "langid" =>81),
		    array("param" => "Chassis wash: switch-off delay", "default_value" =>$values_default[82], "value" =>$values[82], "langid" =>82),
		    array("param" => "Standing delay (s) until pipeline clearance (Biojet)", "default_value" =>$values_default[83], "value" =>$values[83], "langid" =>83),
		    array("param" => "Drying cycle - rotary head: vertical over-travel upwards at back", "default_value" =>$values_default[84], "value" =>$values[84], "langid" =>84),
			array("param" => "Side HP wash: over-travel at rear", "default_value" =>$values_default[85], "value" =>$values[85], "langid" =>85),
			array("param" => "Wheel brush alignment", "default_value" =>$values_default[86], "value" =>$values[86], "langid" =>86),
			array("param" => "Top HP wash: start point at front", "default_value" =>$values_default[87], "value" =>$values[87], "langid" =>87),
			array("param" => "Top HP wash: start point at rear", "default_value" =>$values_default[88], "value" =>$values[88], "langid" =>88),
			array("param" => "Scanner: nozzle normal offset, cm", "default_value" =>$values_default[89], "value" =>$values[89], "langid" =>89),
			array("param" => "Brush wash: Side HP ON:OFF on front", "default_value" =>$values_default[90], "value" =>$values[90], "langid" =>90),
			
			array("param" => "Token queue ON:OFF", "default_value" =>$values_default[91], "value" =>$values[91], "langid" =>91),
		    array("param" => "Wheel prewash and sill wash without stopping ON:OFF", "default_value" =>$values_default[92], "value" =>$values[92], "langid" =>92),
		    array("param" => "Scanner: random pixel filter ON:OFF", "default_value" =>$values_default[93], "value" =>$values[93], "langid" =>93),
		    array("param" => "Scanner: masking upper cells of the light curtain", "default_value" =>$values_default[94], "value" =>$values[94], "langid" =>94),
			array("param" => "Chassis wash: back-up travel distance of chassis wash", "default_value" =>$values_default[95], "value" =>$values[95], "langid" =>95),
			array("param" => "RO-water application: over-travel at rear", "default_value" =>$values_default[96], "value" =>$values[96], "langid" =>96),
			array("param" => "DIP: delay for rear spraying", "default_value" =>$values_default[97], "value" =>$values[97], "langid" =>97),
			array("param" => "DIP: max on time", "default_value" =>$values_default[98], "value" =>$values[98], "langid" =>98),
			array("param" => "DIP: upwards spraying time", "default_value" =>$values_default[99], "value" =>$values[99], "langid" =>99),
			array("param" => "Top brush: parking ON:OFF", "default_value" =>$values_default[100], "value" =>$values[100], "langid" =>100),
			
			array("param" => "Use of 30 token ON:OFF", "default_value" =>$values_default[101], "value" =>$values[101], "langid" =>101),
		    array("param" => "Wax and rinse applications: nozzle distance from the roof", "default_value" =>$values_default[102], "value" =>$values[102], "langid" =>102),
		    array("param" => "Wax and rinse applications: over-travel at front", "default_value" =>$values_default[103], "value" =>$values[103], "langid" =>103),
		    array("param" => "Wax and rinse applications: spraying time at front", "default_value" =>$values_default[104], "value" =>$values[104], "langid" =>104),
			array("param" => "Wax and rinse applications: spraying time at rear", "default_value" =>$values_default[105], "value" =>$values[105], "langid" =>105),
			array("param" => "Drying agent: automatic spreading at brush wash ON:OFF", "default_value" =>$values_default[106], "value" =>$values[106], "langid" =>106),
			array("param" => "Side brushes: rotation direction change ON:OFF", "default_value" =>$values_default[107], "value" =>$values[107], "langid" =>107),
			array("param" => "Defrost, draining time", "default_value" =>$values_default[108], "value" =>$values[108], "langid" =>108),
			array("param" => "Liftgears ratio", "default_value" =>$values_default[109], "value" =>$values[109], "langid" =>109),
			array("param" => "Scanner: light curtain height from the floor", "default_value" =>$values_default[110], "value" =>$values[110], "langid" =>110),
			
			array("param" => "Scanner: light curtain operation allowed", "default_value" =>$values_default[111], "value" =>$values[111], "langid" =>111),
		    array("param" => "Continuous wash ON:OFF", "default_value" =>$values_default[112], "value" =>$values[112], "langid" =>112),
		    array("param" => "Side brushes Ia", "default_value" =>$values_default[113], "value" =>$values[113], "langid" =>113),
		    array("param" => "Side brushes: 1:3 dI%", "default_value" =>$values_default[114], "value" =>$values[114], "langid" =>114),
			array("param" => "Side brushes: 2:3 dI%", "default_value" =>$values_default[115], "value" =>$values[115], "langid" =>115),
			array("param" => "Side brushes dI", "default_value" =>$values_default[116], "value" =>$values[116], "langid" =>116),
			array("param" => "Top brush Ia", "default_value" =>$values_default[117], "value" =>$values[117], "langid" =>117),
			array("param" => "Top brush 1:3 dI%", "default_value" =>$values_default[118], "value" =>$values[118], "langid" =>118),
			array("param" => "Top brush 2:3 dI%", "default_value" =>$values_default[119], "value" =>$values[119], "langid" =>119),
			array("param" => "Top brush dI", "default_value" =>$values_default[120], "value" =>$values[120], "langid" =>120),
			
			array("param" => "Side brushes: over-travel at rear", "default_value" =>$values_default[121], "value" =>$values[121], "langid" =>121),
		    array("param" => "Side brushes: over-travel at front", "default_value" =>$values_default[122], "value" =>$values[122], "langid" =>122),
		    array("param" => "Side brushes crossover wash: traverse distance", "value" =>$values[123], "default_value" =>$values_default[123], "langid" =>123),
		    array("param" => "Side brushes: corner override distance", "default_value" =>$values_default[124], "value" =>$values[124], "langid" =>124),
			array("param" => "Side brushes: brushes extended distance", "default_value" =>$values_default[125], "value" =>$values[125], "langid" =>125),
			array("param" => "Side brushes: tilting point", "default_value" =>$values_default[126], "value" =>$values[126], "langid" =>126),
			array("param" => "Brush wash forwards: middle car point", "default_value" =>$values_default[127], "value" =>$values[127],"langid" =>127),
			array("param" => "Brush wash backwards: middle car point", "default_value" =>$values_default[128], "value" =>$values[128], "langid" =>128),
			array("param" => "Top brush: descending distance to trigger top brush reversing", "default_value" =>$values_default[129], "value" =>$values[129],"langid" =>129),
			array("param" => "Top brush: back-off feature enable distance at front", "default_value" =>$values_default[130], "value" =>$values[130], "langid" =>130),
			
			array("param" => "Top brush: back-off feature enable distance at rear", "default_value" =>$values_default[131], "value" =>$values[131], "langid" =>131),
		    array("param" => "Top brush reversing: prior override distance", "default_value" =>$values_default[132], "value" =>$values[132], "langid" =>132),
		    array("param" => "Side brushes: van identification height for tilting", "default_value" =>$values_default[133], "value" =>$values[133], "langid" =>133),
		    array("param" => "Side brushes: Ia value at sill wash (tilting outwards)", "default_value" =>$values_default[134], "value" =>$values[134], "langid" =>134),
			array("param" => "Side brushes: dI value at sill wash (tilting outwards)", "default_value" =>$values_default[135], "value" =>$values[135], "langid" =>135),
			array("param" => "Lava Foam: spraying time at front", "default_value" =>$values_default[136], "value" =>$values[136], "langid" =>136), // Tuki 150:lle parametrille v4.7, updKHu
			array("param" => "The maximum wait time of the customer for washing", "default_value" =>$values_default[137], "value" =>$values[137], "langid" =>137),
			array("param" => "Reserve1", "default_value" =>$values_default[138], "value" =>$values[138], "langid" =>138),
			array("param" => "Reserve2", "default_value" =>$values_default[139], "value" =>$values[139], "langid" =>139),
			array("param" => "Reserve3", "default_value" =>$values_default[140], "value" =>$values[140], "langid" =>140),

			array("param" => "Reserve4", "default_value" =>$values_default[141], "value" =>$values[141], "langid" =>141),
			array("param" => "Reserve5", "default_value" =>$values_default[142], "value" =>$values[142], "langid" =>142),
			array("param" => "Reserve6", "default_value" =>$values_default[143], "value" =>$values[143], "langid" =>143),
			array("param" => "Reserve7", "default_value" =>$values_default[144], "value" =>$values[144], "langid" =>144),
			array("param" => "Reserve8", "default_value" =>$values_default[145], "value" =>$values[145], "langid" =>145),
			array("param" => "Reserve9", "default_value" =>$values_default[146], "value" =>$values[146], "langid" =>146),
			array("param" => "Reserve10", "default_value" =>$values_default[147], "value" =>$values[147], "langid" =>147),
			array("param" => "Reserve11", "default_value" =>$values_default[148], "value" =>$values[148], "langid" =>148),
			array("param" => "Reserve12", "default_value" =>$values_default[149], "value" =>$values[149], "langid" =>149),
			array("param" => "Reserve13", "default_value" =>$values_default[150], "value" =>$values[150], "langid" =>150)),
			
			21 => array(
			array("param" => "null", "default_value" =>"null", "langid" =>"null")),
			
			22 => array(
			array("param" => "1 N/A", "default_value" =>"N/A", "langid" =>9)),
			
			23 => array(
			array("param" => "2 N/A", "default_value" =>"N/A", "langid" =>9)),
			
			24 => array(
			array("param" => " ", "default_value" =>"0", "langid" =>9, "search" =>"1")),
			
			25 => array(
			array("param" => "3 N/A", "default_value" =>"N/A", "langid" =>9)),
			
			26 => array(
			array("param" => "4 N/A", "default_value" =>"N/A", "langid" =>9)),
			);


 switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': 
			
			if($id == "search")
			{
				if($param != null)
				{
					 $byte_L = (ord( substr($shm_param, ($param+$param), 1)));
					 $byte_H = (ord( substr($shm_param, ($param+$param+1), 1)));
					 $word16b = ($byte_H << 8) + $byte_L;
					
					 $byte_L_default = (ord( substr($shm_param_default, ($param+$param), 1)));
					 $byte_H_default = (ord( substr($shm_param_default, ($param+$param+1), 1)));
					 $word16b_default = ($byte_H_default << 8) + $byte_L_default;

					 $values[$param+1] = $word16b;
					 $values_default[$param+1] = $word16b_default;
					 
					 $arr =array("param" => "N/A", "default_value" =>$values_default[$param], "value" =>$values[$param], "langid" => intval($param));
					 
					 
				//	 $arr = array("response" => "search ".$param);
					 echo json_encode($arr), "\n";   
					 return; 
				}
			
			}
			
			if($id == "meas")
			{
				$shid = shmop_open($shm_key, "w", 0666, $shm_size );
				if($shid == FALSE) 
					{
				//	printf("Error: can't shm_open memory(key:%d) for writing\n", $shid);
					return;
					}
			
				$machine_height_l = ord(shmop_read($shid, MACHINE_HEIGHT+SHM_FLASH_CACHE, 1));
				$machine_height_h = ord(shmop_read($shid, MACHINE_HEIGHT+SHM_FLASH_CACHE+1, 1));
				$machine_height = ($machine_height_h << 8) + $machine_height_l;
				
				$machine_height_kh_l = ord(shmop_read($shid, MACHINE_HEIGHT_KH+SHM_FLASH_CACHE, 1));
				$machine_height_kh_h = ord(shmop_read($shid, MACHINE_HEIGHT_KH+SHM_FLASH_CACHE+1, 1));
				$machine_height_kh = ($machine_height_kh_h << 8) + $machine_height_kh_l;
				
				$hall_length_l = ord(shmop_read($shid, HALL_LENGTH+SHM_FLASH_CACHE, 1));
				$hall_length_h = ord(shmop_read($shid, HALL_LENGTH+SHM_FLASH_CACHE+1, 1));
				$hall_length = ($hall_length_h << 8) + $hall_length_l;
				
				$json['machine_height']=$machine_height; 
				$json['machine_height_kh']=$machine_height_kh; 
				$json['hall_length']=$hall_length; 
			
			
				echo json_encode($json), "\n";	
				shmop_close($shid);
				return;
			}
		
			if($id == "response")
			{
				global $messagequeue;
				$ind = $_GET['langid'];
				$command = $_GET['command'];
				$page = $_GET['page'];
				
				$shid = shmop_open($shm_key, "w", 0666, $shm_size );
				if($shid == FALSE) 
					{
				//	printf("Error: can't shm_open memory(key:%d) for writing\n", $shid);
					return;
					}
				
				$ret = exchangeparameter($ind, $dat, $command, $page);
				$arr = array("response" => $ret);
				echo json_encode($arr), "\n";   				
				return;
			}
           	if($id != NULL)
           	{
	            echo json_encode($parameters[$id]), "\n";           		
           	}
         break;
		 
		 case 'POST':
				$update = json_decode(file_get_contents('php://input'), true);
				
			//	if($update[0]['command'] == "set")
					$ret = SaveParameter($update);
					$arr = array("response" => $ret);
					echo json_encode($arr), "\n";   
		 break;
    }

	
function SaveParameter($update)
{
global $messagequeue;
global $shid;


		for($i = 0; $i<count($update); $i++)
		{
				if($update[$i]['command_param'] == "high_reset" && $update[$i]['command'] == "set")
				{
					$shm_bytes_written = write_command(19662,0x00);
					$shm_bytes_written = write_command(19663,0x00);
					$shm_bytes_written = write_command(19664,0x00);
					$shm_bytes_written = write_command(19665,0x00);
					$shm_bytes_written = write_command(19666,0x00);
					$shm_bytes_written = write_command(19667,0x00);
					return "High reset";
				}
		
			usleep(10000);  			// sleep 10ms
			$pid= ((getmypid()) % 100) + 1; // is php process on

			$shm_param = shmop_read($shid, 2152, 8);  // READ...ALL...8 chars 
			$mutex=(ord( substr($shm_param, 0, 1)));
			if($mutex == 0) // mutex free nobody is using interface
			{
					$shm_bytes_written = write_command(2152,$pid);		
			
					$dat = $update[$i]['value'];
					$ind = $update[$i]['langid'];
					$command = $update[$i]['command'];
					$command_param = $update[$i]['command_param'];
					$page = $update[$i]['page'];
					
					if($command == "set" && $page == "inv1")
						$shm_bytes_written = write_command(2154,71);	  // G
					else if($command == "get" && $page == "inv1")
						$shm_bytes_written = write_command(2154,103);   // g
						
					else if($command == "set" && $page == "inv2")
						$shm_bytes_written = write_command(2154,176);    // L
					else if($command == "get" && $page == "inv2")
						$shm_bytes_written = write_command(2154,108);   // l
						
					else if($command == "set" && $page == "inv3")
						$shm_bytes_written = write_command(2154,66);    // B
					else if($command == "get" && $page == "inv3")
						$shm_bytes_written = write_command(2154,98);    // b
						
					else if($command == "set" && $page == "inv4")
						$shm_bytes_written = write_command(2154,82);    // R
					else if($command == "get" && $page == "inv4")
						$shm_bytes_written = write_command(2154,114);   // r
						
					else if($command == "set" && $command_param == "params_reset")
						$shm_bytes_written = write_command(2154,70);   // F
					else if($command == "set" && $command_param == "gantry_reset")
						$shm_bytes_written = write_command(2154,70);   // F
		
					else if($command == "set" && $command_param == "lift_reset")
						$shm_bytes_written = write_command(2154,70);   // F
					
					else if($command == "set" && $command_param == "brush_reset")
						$shm_bytes_written = write_command(2154,70);   // F
					else if($command == "set" && $command_param == "rotate_reset")
						$shm_bytes_written = write_command(2154,70);   // F
					else
						$shm_bytes_written = write_command(2154,77);   // M
			
			
				if($command == "set")
				{
					$add_byte_hi  = (($ind>>8)&0xFF);	       // address hi
					$add_byte_lo  = (($ind)&0xFF);	 	// address lo
					$temp_byte_hi = (($dat>>8)&0xFF);	       // data hi ...THIS IS FOR WRITING COMMAND ONLY
					$temp_byte_lo = (($dat)&0xFF);	 	// data lo ...THIS IS FOR WRITING COMMAND ONLY
	
	/*
					$array_update = array();
					$array_update_send = array();

					$array_update['offset'] =  2155; // offset
					$array_update['cmd'] = $add_byte_hi; // cmd	
					$array_update_send[] = $array_update;
					
					$array_update['offset'] =  2156; // offset
					$array_update['cmd'] = $add_byte_lo; // cmd	
					$array_update_send[] = $array_update;
					
					$array_update['offset'] =  2157; // offset
					$array_update['cmd'] = $temp_byte_hi; // cmd	
					$array_update_send[] = $array_update;
					
					$array_update['offset'] =  2158; // offset
					$array_update['cmd'] = $add_byte_hi; // cmd	
					$array_update_send[] = $array_update;

					write_array_mixed(array("mixed", $array_update_send));
		*/
	
	
					$shm_bytes_written = write_command(2155,$add_byte_hi);	
					sleep(1);  		
					$shm_bytes_written = write_command(2156,$add_byte_lo);
					sleep(1);  							
					$shm_bytes_written = write_command(2157,$temp_byte_hi);	
					sleep(1);  		
					$shm_bytes_written = write_command(2158,$temp_byte_lo);	
	
					usleep(200000);	

					$shm_bytes_written = write_command(2152,150);	
					sleep(3);  		
					$shm_bytes_written = write_command(2152,chr("0"));
					
					return "Value is set.";
					
				}
				if($command_param != null)
					return $command_param;
				else
					return "";
			}
			else
			   return "Interface is on use. Mutex: ".$mutex;
		}	

}	
//	printf("Error: Another user is currently using interface, try again");

function exchangeparameter($ind, $dat, $command, $page)
{

	global $messagequeue;
	global $shid;
	
	$str_ret_val="Error:Uninitialized";
	$pid=0;	
	$mutex=0;
	$readme=0;
	$counter10ms=0;

	$add_character_trg = "";
	$add_word = 0;
	$add_byte_hi  = 0;
	$add_byte_lo  = 0;

	$temp_character_trg = "";
	$temp_word  = 0;
	$temp_byte_hi  = 0;
	$temp_byte_lo  = 0;
	
	if($command == "set" && $page == "inv1")
		$trg = "g";	  // G
	else if($command == "get" && $page == "inv1")
		$trg = "G";   // g
	else if($command == "set" && $page == "inv2")
		$trg = "l";    // L
	else if($command == "get" && $page == "inv2")
		$trg = "L";   // l
	else if($command == "set" && $page == "inv3")
		$trg = "b";
	else if($command == "get" && $page == "inv3")
		$trg = "B";
	else if($command == "set" && $page == "inv4")
		$trg = "r";
	else if($command == "get" && $page == "inv4")
		$trg = "R";		
	else if($command == "set" && $command_param == "params_reset")
		$trg = "F";   // F
	else if($command == "set" && $command_param == "gantry_reset")
		$trg = "F";   // F
	else if($command == "set" && $command_param == "lift_reset")
		$trg = "F";   // F
	else
		$trg = "M";   // M
	
	//return $trg." ".$command." ".$page." ".$ind." ".$dat;

	$shm_param_lkm = ord(shmop_read($shid, (2252+19712), 1)); // parametrien lukumäärä, updKHu
	
	if(($trg != "m") && ($trg != "l") && ($trg != "g") && ($trg != "M") && ($trg != "L") && ($trg != "G") && ($trg != "F") && ($trg != "b")  && ($trg != "B")  && ($trg != "r")  && ($trg != "B"))
		return $str_ret_val="Error: Target(m,l,g,M,L,G,F,b,B,r,R) are only supported";

	if(($trg == "l") || ($trg == "g") || ($trg == "L") || ($trg == "G") || ($trg == "r") || ($trg == "R") || ($trg == "b") || ($trg == "B"))
		if(($ind < 1) || ($ind > 9999))
			return $str_ret_val="Error: Outranged, parameters area (1...9999)";

	if(($trg == "m") || ($trg == "M"))
//		if(($ind < 1) || ($ind > 135)) // updKHu
		if(($ind < 1) || ($ind > $shm_param_lkm))
			return $str_ret_val="Error: Outranged, parameters area (1...135)";

	if($trg == "F")
		if(($ind != 0xF1) && ($ind != 0xDE))
			return $str_ret_val="Error: Outranged, parameters area (0xF1 or 0xDE)";

	$pid= ((getmypid()) % 100) + 1;

	$shm_param = shmop_read($shid, 2152, 8);  // READ...ALL...8 chars 
//	return $mutex;
	if( ($mutex=(ord( substr($shm_param, 0, 1)))) == 0) // mutex free nobody is using interface
	{
		//$shm_bytes_written = shmop_write($shid, chr($pid), 2152);	
		$shm_bytes_written = write_command(2152,$pid);
		usleep(10000);  			// sleep 10ms
/*
		$shm_param = shmop_read($shid, 2152, 8);  // READ...ALL...8 chars 
		if(($mutex=(ord( substr($shm_param, 0, 1)))) != $pid)
		{
			$str_ret_val = "Error: Can't start formfill"; 
			shmop_close($shid);
			return $str_ret_val;
		}
*/
		$add_character_trg = $trg;	
		$add_byte_hi  = (($ind>>8)&0xFF);	       // address hi
		$add_byte_lo  = (($ind)&0xFF);	 	// address lo
		$temp_byte_hi = (($dat>>8)&0xFF);	       // data hi ...THIS IS FOR WRITING COMMAND ONLY
		$temp_byte_lo = (($dat)&0xFF);	 	// data lo ...THIS IS FOR WRITING COMMAND ONLY
		/*
		$shm_bytes_written = shmop_write($shid, $add_character_trg, 2152+2);	
		$shm_bytes_written = shmop_write($shid, chr($add_byte_hi),  2152+3);	
		$shm_bytes_written = shmop_write($shid, chr($add_byte_lo),  2152+4);	
		$shm_bytes_written = shmop_write($shid, chr($temp_byte_hi), 2152+5);	
		$shm_bytes_written = shmop_write($shid, chr($temp_byte_lo), 2152+6);	
		*/
		$shm_bytes_written = write_command(2154,ord($add_character_trg));	
		$shm_bytes_written = write_command(2155,$add_byte_hi);	
		$shm_bytes_written = write_command(2156,$add_byte_lo);	
		$shm_bytes_written = write_command(2157,$temp_byte_hi);	
		$shm_bytes_written = write_command(2158,$temp_byte_lo);	
		usleep(10000);  			//## sleep 10ms

		
		$pid = $pid + 100;
	//	$shm_bytes_written = shmop_write($shid, chr($pid), 2152);	
		$shm_bytes_written = write_command(2152,$pid);	
/*
		$shm_param = shmop_read($shid, 2152, 8);  // READ...ALL...8 chars 
		if(($mutex=(ord( substr($shm_param, 0, 1)))) != $pid)
		{
			$str_ret_val = "Error: Can't stop formfill";
			shmop_close($shid);
			return $str_ret_val;
		}
*/


		//### now we can start read reasponce when README counter runs up, after read clear mutex...
		for($counter10ms=0; $counter10ms<100; $counter10ms++)
		{

			sleep(2);  			//## sleep 100ms
			$shm_param = shmop_read($shid, 2152, 8);  // READ...ALL...8 chars 

			if(($readme=(ord( substr($shm_param, 1, 1)))) == 0) // readmecounter active -> can read
			{
				$mutex		= (ord( substr($shm_param, 0, 1)));
				$temp_character_trg= (( substr($shm_param, 2, 1)));   		//reread addr trg from form

				$add_byte_hi	= (ord( substr($shm_param, 3, 1)));   		//reread addr hi-byte from form
				$add_byte_lo	= (ord( substr($shm_param, 4, 1)));		//reread addr low-byte from form
				$add_word	= ($add_byte_hi << 8) + $add_byte_lo;		

				$temp_byte_hi = (ord( substr($shm_param, 5, 1)));		//reread data low-byte from form
				$temp_byte_lo = (ord( substr($shm_param, 6, 1)));		//reread data low-byte from form
				$temp_word    = ($temp_byte_hi << 8) + $temp_byte_lo; 		

				//$shm_bytes_written = shmop_write($shid, chr("0"), 2152);  	// write 0 to mutex for freeing the Mutex for others, and reset timoutcounter	
				$shm_bytes_written = write_command(2152,chr("0"));
				shmop_close($shid);

				//## check error...
				if($add_word == 0) //inverter responses ERROR
				{
					$str_ret_val = "Error:Code(" . $temp_word . ") FromInverter... " .  
					" " . $mutex . "," . $readme . " ["  . $temp_character_trg . "," . $add_byte_hi . "," .  $add_byte_lo . "," . $temp_byte_hi . "," . $temp_byte_lo . "]"; 
					return $str_ret_val;
				}
				if($temp_character_trg != $trg)	// target changed by another user
				{				
					$str_ret_val = "Error:Target(" . $trg . ") changed to (" . $temp_character_trg . ") by another client, try again... " . 
					" " . $mutex . "," . $readme . " ["  . $temp_character_trg . "," . $add_byte_hi . "," .  $add_byte_lo . "," . $temp_byte_hi . "," . $temp_byte_lo . "]"; 
					return $str_ret_val;
				}
				if($add_word != $ind)	// address changed by another user
				{
					$str_ret_val = "Error:Address(" . $ind . ") changed to (" . $add_word . ") by another client, try again... " . 
					" " . $mutex . "," . $readme . " ["  . $temp_character_trg . "," . $add_byte_hi . "," .  $add_byte_lo . "," . $temp_byte_hi . "," . $temp_byte_lo . "]"; 
					return $str_ret_val;
				}

				//## success if no errors found...
			//	$str_ret_val = " Success:".  $trg . "(" . $add_word . "=" . $temp_word . ")"; 
				$str_ret_val  = $trg."|".$add_word."|".$temp_word;
				return $str_ret_val;
			}

		}


		$str_ret_val = "Error: Timeout(10s) occured at CPU while reading Inverter, try again!"; 
		shmop_close($shid);
		return $str_ret_val;
	}

	$str_ret_val = "Error: Another user is currently using interface, try again"; 
	shmop_close($shid);
	return $str_ret_val;
	
}


?>			
