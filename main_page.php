<?php
session_start();
// Open memory for reading

if($_SESSION['username'] == null)
{
	header("Location: index.php");
}

	/* Include definations */
include 'defines.php';
/* Include functions */
include 'sync/sync_server_functions.php';
// Parse config
$config = parse_config($config_file_name);
// Set variables
include 'select_shared_mem.php';
// Open queue
//$messagequeue = msg_get_queue($mqueue_key,0666);
// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );

if($shid == FALSE)
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shm_key);
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}

$title = shmop_read($shid, SHM_FLASH_CACHE+24832, 256); // read station_data
$pos = strpos($title,"*");
$title = substr($title,0,$pos-1);

sleep(2);
$ifsf = ord(shmop_read($shid, $FUNCTIONS[20] + SHM_FLASH_CACHE, 1)); //ifsf_config
$_SESSION["ifsf"] = $ifsf;
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"/>
   <link rel="stylesheet" type="text/css" href= "/lib/dojo/1.8/dijit/themes/claro/claro.css">
   <link rel="stylesheet" type="text/css" href= "lib/css/ultralux.css">
   <script language="JavaScript" type="text/javascript" src="lib/Functions.js"></script>
   <script language="JavaScript" type="text/javascript" src="lib/LoadPdf.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
   <link rel="shortcut icon" href="lib/css/images/favicon.ico">
   <title><?php echo $title; ?></title>
    <script>

var dojoConfig = {
    baseUrl: "lib/",
    async: true,
    tlmSiblingOfDojo: true,
    parseOnLoad: true,
	locale : location.search.substring(1),
    packages: [
        { name: "dojo", location: "/lib/dojo/1.8/dojo" },
        { name: "dijit", location: "/lib/dojo/1.8/dijit" },
        { name: "dojox", location: "/lib/dojo/1.8/dojox" },
        { name: "dgrid", location: "/lib/dojo/1.8/dgrid" },
        { name: "put-selector", location: "/lib/dojo/1.8/put-selector" },
        { name: "xstyle", location: "/lib/dojo/1.8/xstyle" },
        { name: "ext", location: "dojo/1.8/ext" },
        { name: "custom", location: "dojo/1.8/custom" }
    ]
};

    </script>
    <script src="/lib/dojo/1.8/dojo/dojo.js"></script>

	  <script >//<![CDATA[


var app;

require([
		"dojo/dom-construct",
		"dijit/registry",
		"dojo/dom-attr",
		"dojo/dnd/Source",
		"dojo/parser",
		"dojo/_base/lang",
		"lib/app",
		"dijit/form/Button",
		"dojo/ready",
		"dijit/form/RadioButton",
		"dojo/i18n!./lib/nls/resources.js",
		"lib/OnlineStatus/OnlineStatus",
		"lib/DebugIOData/DebugIOData",
		"lib/DebugIOData/DebugIOData_IO1",
		"lib/DebugIOData/DebugIOData_IO2",
		"lib/DebugIOData/DebugIOData_IO3",
		"lib/DebugIOData/DebugIOData_IO4",
		"lib/DebugIOData/DebugIOData_IO5",
		"lib/DebugIOData/DebugIOData_IO6",
		"lib/DebugIOData/DebugIOData_IO1_Out",
		"lib/DebugIOData/DebugIOData_IO2_Out",
		"lib/DebugIOData/DebugIOData_IO3_Out",
		"lib/DebugIOData/DebugIOData_IO4_Out",
		"lib/DebugIOData/DebugIOData_IO5_Out",
		"lib/DebugIOData/DebugIOData_IO6_Out",
		"lib/DebugIOData_Log/DebugIOData_Log",
		"lib/Diagnostics/Diagnostics",
		"lib/Statistics/Statistics",
		"lib/StartWashing/StartWashing",
		"lib/EditPrograms/EditPrograms",
		"lib/EditParameters/EditParameters",
		"lib/EditMachineSetup/EditMachineSetup",
		"lib/ManualControl/ManualControl",
		"lib/Documents/Documents",
		"lib/Admin/Admin",
		"lib/SaveToFlash/SaveToFlash",
		"lib/Ifsf/Ifsf",
		"dojo/domReady!"],
function(domConst, registry,domAttr, dnd, parser, lang,libApp, Button, ready, RadioButton, resources)
{
  app = new libApp({});
  // set langs

    var ifsf = "<?php echo $_SESSION["ifsf"]; ?>";
	var user = '<?php echo $_SESSION["username"]; ?>';
	switch (user)
	{
	case "Admin":
		domAttr.set("online_status", "title", resources.online_status);
		domAttr.set("start_washing", "title", resources.start_washing);
		domAttr.set("statistics", "title", resources.statistics);
		domAttr.set("diagnostics", "title", resources.diagnostics);
		domAttr.set("debug_io", "title", resources.debug_io);
		domAttr.set("edit_programs", "title", resources.edit_programs);
		domAttr.set("edit_parameters", "title", resources.edit_parameters);
		domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		domAttr.set("documents", "title", resources.documents);
		domAttr.set("save_to_flash", "title", resources.save_to_flash);
		domAttr.set("admin", "title", resources.admin);
		if(ifsf == 1)
		{
			domAttr.set("ifsf", "title", resources.option7);
		}
		if(document.getElementById('input_1') != null)
			domAttr.set("input_1", "title", resources.input_1);
		if(document.getElementById('input_2') != null)
			domAttr.set("input_2", "title", resources.input_2);
		if(document.getElementById('input_3') != null)
			domAttr.set("input_3", "title", resources.input_3);
		if(document.getElementById('input_4') != null)
			domAttr.set("input_4", "title", resources.input_4);
		if(document.getElementById('input_5') != null)
			domAttr.set("input_5", "title", resources.input_5);
		if(document.getElementById('input_6') != null)
			domAttr.set("input_6", "title", resources.input_6);
		if(document.getElementById('output_1') != null)
			domAttr.set("output_1", "title", resources.output_1);
		if(document.getElementById('output_2') != null)
			domAttr.set("output_2", "title", resources.output_2);
		if(document.getElementById('output_3') != null)
			domAttr.set("output_3", "title", resources.output_3);
		if(document.getElementById('output_4') != null)
			domAttr.set("output_4", "title", resources.output_4);
		if(document.getElementById('output_5') != null)
			domAttr.set("output_5", "title", resources.output_5);
		if(document.getElementById('output_6') != null)
			domAttr.set("output_6", "title", resources.output_6);

		domAttr.set("log", "title", resources.log);
	  break;
	case "TM":
		domAttr.set("online_status", "title", resources.online_status);
		domAttr.set("start_washing", "title", resources.start_washing);
		domAttr.set("statistics", "title", resources.statistics);
		domAttr.set("diagnostics", "title", resources.diagnostics);
		domAttr.set("debug_io", "title", resources.debug_io);
		domAttr.set("edit_programs", "title", resources.edit_programs);
		domAttr.set("edit_parameters", "title", resources.edit_parameters);
		domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		domAttr.set("documents", "title", resources.documents);
		domAttr.set("save_to_flash", "title", resources.save_to_flash);
		if(document.getElementById('input_1') != null)
			domAttr.set("input_1", "title", resources.input_1);
		if(document.getElementById('input_2') != null)
			domAttr.set("input_2", "title", resources.input_2);
		if(document.getElementById('input_3') != null)
			domAttr.set("input_3", "title", resources.input_3);
		if(document.getElementById('input_4') != null)
			domAttr.set("input_4", "title", resources.input_4);
		if(document.getElementById('input_5') != null)
			domAttr.set("input_5", "title", resources.input_5);
		if(document.getElementById('input_6') != null)
			domAttr.set("input_6", "title", resources.input_6);
		if(document.getElementById('output_1') != null)
			domAttr.set("output_1", "title", resources.output_1);
		if(document.getElementById('output_2') != null)
			domAttr.set("output_2", "title", resources.output_2);
		if(document.getElementById('output_3') != null)
			domAttr.set("output_3", "title", resources.output_3);
		if(document.getElementById('output_4') != null)
			domAttr.set("output_4", "title", resources.output_4);
		if(document.getElementById('output_5') != null)
			domAttr.set("output_5", "title", resources.output_5);
		if(document.getElementById('output_6') != null)
			domAttr.set("output_6", "title", resources.output_6);
		domAttr.set("log", "title", resources.log);
	  break;
	case "Importer":
		domAttr.set("online_status", "title", resources.online_status);
		domAttr.set("start_washing", "title", resources.start_washing);
		domAttr.set("statistics", "title", resources.statistics);
		domAttr.set("diagnostics", "title", resources.diagnostics);
		domAttr.set("debug_io", "title", resources.debug_io);
		domAttr.set("edit_programs", "title", resources.edit_programs);
		domAttr.set("edit_parameters", "title", resources.edit_parameters);
		domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		domAttr.set("documents", "title", resources.documents);
		domAttr.set("save_to_flash", "title", resources.save_to_flash);
	  break;
	case "Operator":
		domAttr.set("online_status", "title", resources.online_status);
		domAttr.set("start_washing", "title", resources.start_washing);
		domAttr.set("statistics", "title", resources.statistics);
		domAttr.set("diagnostics", "title", resources.diagnostics);
		//domAttr.set("debug_io", "title", resources.debug_io);
		domAttr.set("edit_programs", "title", resources.edit_programs);
		//domAttr.set("edit_parameters", "title", resources.edit_parameters);
		domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		domAttr.set("documents", "title", resources.documents);
		domAttr.set("save_to_flash", "title", resources.save_to_flash);
	  break;
	  case "Chain":
		domAttr.set("online_status", "title", resources.online_status);
		//domAttr.set("start_washing", "title", resources.start_washing);
		//domAttr.set("statistics", "title", resources.statistics);
		//domAttr.set("diagnostics", "title", resources.diagnostics);
		//domAttr.set("debug_io", "title", resources.debug_io);
		//domAttr.set("edit_programs", "title", resources.edit_programs);
		//domAttr.set("edit_parameters", "title", resources.edit_parameters);
		//domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		//domAttr.set("documents", "title", resources.documents);
		//domAttr.set("save_to_flash", "title", resources.save_to_flash);
	  break;
	   case "Wap":
		domAttr.set("online_status", "title", resources.online_status);
		//domAttr.set("start_washing", "title", resources.start_washing);
		domAttr.set("statistics", "title", resources.statistics);
		domAttr.set("diagnostics", "title", resources.diagnostics);
		domAttr.set("debug_io", "title", resources.debug_io);
		//domAttr.set("edit_programs", "title", resources.edit_programs);
		domAttr.set("edit_parameters", "title", resources.edit_parameters);
		domAttr.set("edit_machineSetup", "title", resources.edit_machineSetup);
		domAttr.set("manual_control", "title", resources.manual_control);
		domAttr.set("documents", "title", resources.documents);
		domAttr.set("save_to_flash", "title", resources.save_to_flash);
	  break;
	}
});


//]]></script>
  </head>

  <div id="header">
	<div id="header_image" class="header_image"></div>
	<div id="header_image_text" class="header_image_text"></div>
	<div id="status" class="status_text"></div>
	<div id="status_err" class="status_text_err"></div>

	<table id="statuslights" border=0>
		<tr><td><div id="ifsf_ok" class="ifsf_ok" title="ifsf easylon status"></div></td><td><div id="ifsf_ok_text" class="ifsf_ok_text"></div></td></tr>
		<tr><td><div id="cw_ok" class="cw_ok" title="Cw-server status"></div></td><td><div id="cw_ok_text" class="cw_ok_text"></div></td></tr>
		<tr><td><div id="shared_mem_ok" class="shared_mem_ok" title="Shared memory status"></div></td><td><div id="shared_mem_ok_text" class="shared_mem_ok_text"></div></td></tr>
	</table>


	<div id="shared_mem_ok" class="shared_mem_ok" title="Shared mem status"></div>
	<div id="shared_mem_ok_text" class="shared_mem_ok_text"></div>

	<div id="header_status" class="header_status"></div>
  </div> <!-- header image -->

  <body class="claro">

    <div id="loadingOverlay" class="loadingOverlay pageOverlay"></div>

    <div class="pageTabContainer" id="pageTabContainer" data-dojo-type="dijit/layout/TabContainer" style="background-color: transparent;">
	<?php

		switch ($_SESSION['username'])
		{
			case 'Admin':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' class='start_washing' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' class='statistics' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  ShowIotabs($link,$selected_machine,$shid);

				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_programs' class='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' class='documents' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' class='admin' id='admin' title='Admin'><div data-dojo-type='Admin'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";

				  if($_SESSION["ifsf"] == 1)
					echo "<div data-dojo-type='dijit/layout/ContentPane' class='ifsf' id='ifsf' title='Ifsf'><div data-dojo-type='Ifsf'></div></div>";
			break;

			case 'TM':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  ShowIotabs($link,$selected_machine,$shid);

				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";
			break;

			case 'Importer':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  ShowIotabs($link,$selected_machine,$shid);

				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";
			break;

			case 'Operator':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  echo "<div  data-dojo-type='dijit/layout/ContentPane' id='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";
			break;
			case 'Chain':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  //echo "<div  data-dojo-type='dijit/layout/ContentPane' id='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  //echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";
			break;

			case 'Wap':
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='online_status' title='Online Status'  selected='true'><div data-dojo-type='OnlineStatus'></div></div>";
			//	  echo "<div data-dojo-type='dijit/layout/ContentPane' id='start_washing' title='Start Washing'><div data-dojo-type='StartWashing'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='statistics' title='Statistics'><div data-dojo-type='Statistics'></div> </div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='diagnostics' title='Diagnostics'><div data-dojo-type='Diagnostics'></div> </div>";

				  ShowIotabs($link,$selected_machine,$shid);
				  //echo "<div  data-dojo-type='dijit/layout/ContentPane' id='edit_programs' title='Edit Programs'><div data-dojo-type='EditPrograms'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_parameters' title='Edit Parameters'><div data-dojo-type='EditParameters'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='edit_machineSetup' title='Edit MachineSetup'><div data-dojo-type='EditMachineSetup'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='manual_control' title='Manual control'><div data-dojo-type='ManualControl'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='documents' title='Documents'><div data-dojo-type='Documents'></div></div>";
				  echo "<div data-dojo-type='dijit/layout/ContentPane' id='save_to_flash' title='Save to Flash'><div data-dojo-type='SaveToFlash'></div></div>";
			break;
		}


		function ShowIotabs($link,$selected_machine,$shid)
		{
			$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype

			if($machine_type != 5 || $machine_type != 6) // kone on joku muu kuin twinkone
			{
				if($selected_machine == 1)
				{
					$iocardselections = "IoCardSelections";
				}
				else if($selected_machine == 2)
				{
					$iocardselections = "IoCardSelections2";
				}
			}
			else
			{
				$iocardselections = "IoCardSelections";
			}
		    $result = mysqli_query($link,"SELECT * FROM $iocardselections");
			if(!$result)
			{
			  echo("Error description: " . mysqli_error($link));
			}
			$row = mysqli_fetch_array($result);

			echo "<div data-dojo-type='dijit/layout/ContentPane'  id='debug_io' title='Debug I/O Data'>";
						echo "<div style='width: 100%; height: 100%'>";
							echo "<div id='top_tabs' data-dojo-type='dijit/layout/TabContainer' style='width: 100%; height: 100%;'>";
								echo "<div data-dojo-type='dijit/layout/ContentPane' title=' I/O-data' data-dojo-props='selected:true'>";
									echo "<div data-dojo-type='DebugIOData'></div>";
								echo "</div>";

								if($row['in1'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_1' title=' Input 1'>";
										echo "<div data-dojo-type='DebugIOData_IO1'></div>";
									echo "</div>";
								}
								if($row['out1'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_1' title=' Output 1'>";
										echo "<div data-dojo-type='DebugIOData_IO1_Out'></div>";
									echo "</div>";
								}
								if($row['in2'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_2' title=' Input 2'>";
										echo "<div data-dojo-type='DebugIOData_IO2'></div>";
									echo "</div>";
								}
								if($row['out2'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_2' title=' Output 2'>";
										echo "<div data-dojo-type='DebugIOData_IO2_Out'></div>";
									echo "</div>";
								}
								if($row['in3'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_3' title=' Input 3'>";
										echo "<div data-dojo-type='DebugIOData_IO3'></div>";
									echo "</div>";
								}
								if($row['out3'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_3' title=' Output 3'>";
										echo "<div data-dojo-type='DebugIOData_IO3_Out'></div>";
									echo "</div>";
								}
								if($row['in4'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_4' title=' Input 4'>";
										echo "<div data-dojo-type='DebugIOData_IO4'></div>";
									echo "</div>";
								}
								if($row['out4'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_4' title=' Output 4'>";
										echo "<div data-dojo-type='DebugIOData_IO4_Out'></div>";
									echo "</div>";
								}
								if($row['in5'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_5' title=' Input 5'>";
										echo "<div data-dojo-type='DebugIOData_IO5'></div>";
									echo "</div>";
								}
								if($row['out5'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_5' title=' Output 5'>";
										echo "<div data-dojo-type='DebugIOData_IO5_Out'></div>";
									echo "</div>";
								}
								if($row['in6'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='input_6' title=' Input 6'>";
										echo "<div data-dojo-type='DebugIOData_IO6'></div>";
									echo "</div>";
								}
								if($row['out6'] == 1)
								{
									echo "<div data-dojo-type='dijit/layout/ContentPane' id='output_6' title=' Output 6'>";
										echo "<div data-dojo-type='DebugIOData_IO6_Out'></div>";
									echo "</div>";
								}
								echo "<div data-dojo-type='dijit/layout/ContentPane' id='log' title=' log'>";
									echo "<div data-dojo-type='DebugIOData_Log'></div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
				  echo "</div>";
		}
	?>

      <script type="dojo/method">
         app.endOverlay('loadingOverlay',false); // true = animate
      </script>
    </div>
  </body>
</html>
