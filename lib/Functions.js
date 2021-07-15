
// backward counter 
	var intervalId; // keep the ret val from setTimeout()
	var intervalId2; // keep the ret val from setTimeout()
	var intervalId3; // keep the ret val from setTimeout()
	var intervalId4; // keep the ret val from setTimeout()
	var intervalId5; // keep the ret val from setTimeout()
	var intervalId6; // keep the ret val from setTimeout()
	var counter = 0;
	var touch = 0; // updKHu
	var targetBox = null; // updKHu

function handleDown(evt) 
{
	if (evt.pointerType ==  "touch") 
	{
		touch  = 1;
		//console.log("Touching=" + touch);
		var text = targetBox.id;
		switch (text)
		{
			case "GantryBackward" :
				counter = 18;
				runme("GantryBackwardCounter");
			break;
			case "GantryForward" :
				counter = 18;
				runme("GantryForwardCounter");
			break;
			case "RoofBrushDown" :
				counter = 18;
				runme("brushDownCounter");
			break;
			case "RoofBrushUp" :
				counter = 18;
				runme("brushUpCounter");
			break;
			case "RoofNozzleDown" :
				counter = 18;
				runme("nozzleDownCounter");
			break;
			case "RoofNozzleUp" :
				counter = 18;
				runme("nozzleUpCounter");
			break;
			case "SbrushAside" :
				counter = 18;
				runme("SbrushAsideCounter");
			break;
			default :
				console.log("Unknown touchcode=" + text);
		}
		//evt.preventDefault();
	}
	else 
	{
		touch = 0;
		//console.log("Clicking=" + touch);
	}
	targetBox.onpointerdown = null;
}

function loadImage() 
{
    console.log("Image is loaded");
}

	function mousedownfunc(divid) 
	{
		// intervalId = setInterval(runme, 200, divid); // updKHu
//		alert(divid);
	//	console.log(divid);
		counter = 1;

		switch(divid)
		{
		case "GantryBackwardCounter":
		  dojo.style("GantryBackward", {
          "background-image": "url('../lib/css/images/button_empty_green_small.png')",
          "width": "120px",
          "height": "50px"
			});
			console.log("start GantryBackwardCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_backward",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "GantryForwardCounter":
		  dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_green_small.png')",
          "width": "120px",
          "height": "50px"
			});
			console.log("start GantryForwardCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_forward",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "brushDownCounter":
			dojo.style("RoofBrushDown", {
			  "background-image": "url('../lib/css/images/button_empty_green_small.png')",
			  "width": "120px",
			  "height": "50px"
			});
			console.log("start brushDownCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_down",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "nozzleDownCounter":
			 dojo.style("RoofNozzleDown", {
			  "background-image": "url('../lib/css/images/button_empty_green_small.png')",
			  "width": "120px",
			  "height": "50px"
			});
			console.log("start nozzleDownCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_down",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "brushUpCounter":
			 dojo.style("RoofBrushUp", {
			  "background-image": "url('../lib/css/images/button_empty_green_small.png')",
			  "width": "120px",
			  "height": "50px"
			});
			console.log("start brushUpCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_up",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "nozzleUpCounter":
			 dojo.style("RoofNozzleUp", {
			  "background-image": "url('../lib/css/images/button_empty_green_small.png')",
			  "width": "120px",
			  "height": "50px"
			});
			console.log("start nozzleUpCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_up",mode:"start"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "SbrushAsideCounter": // updKHu
			 dojo.style("SbrushAside", {
			  "background-image": "url('../lib/css/images/button_empty_green_small.png')",
			  "width": "120px",
			  "height": "50px"
			});
			console.log("start SbrushAsideCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"side_brush_aside"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		}
		intervalId = setInterval(runme, 500, divid); // Siirretty tähän, updKHu
		console.log("setIntervaId=" + intervalId);
	}

	function mouseupfunc(divid) 
	{
	//	console.log("mooseup touch=" + touch);
	/*
		clearInterval(intervalId);

		clearInterval(intervalId2);
		clearInterval(intervalId3);
		clearInterval(intervalId4);
		clearInterval(intervalId5);
		clearInterval(intervalId6);
		counter = 0;
		touch = 0;
	*/
		var viive;

		console.log("stop requested");
		if ((counter != 0) && (counter<6))
			viive = 3000;
		else
			viive = 0;

		clearInterval(intervalId);
		counter = 0;

		setTimeout(function() {

		console.log("send stop.. viive=" + viive);

		switch(divid)
		{
		case "GantryBackwardCounter":
			dojo.style("GantryBackward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop GantryBackwardCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_backward",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "GantryForwardCounter":
			dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop GantryForwardCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_forward",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "brushDownCounter":
			dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop brushDownCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_down",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "brushUpCounter":
			dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop brushUpCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_up",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "nozzleUpCounter":
			dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop nozzleUpCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_up",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		case "nozzleDownCounter":
			dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
			});
			
			console.log("stop nozzleDownCounter");
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_down",mode:"stop"}),
				  handleAs: "text"
			};
			var deferred = dojo.xhrPost(xhrArgs);
		  break;
		}
				}, viive); //3000ms
		
		dojo.style("GantryBackward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		dojo.style("GantryForward", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		dojo.style("RoofBrushDown", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		dojo.style("RoofNozzleDown", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		dojo.style("RoofBrushUp", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		dojo.style("RoofNozzleUp", {
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});

		dojo.style("SbrushAside", { // updKHu
          "background-image": "url('../lib/css/images/button_empty_gray_small.png')",
          "width": "120px",
          "height": "50px"
		});
		
		document.getElementById('GantryBackwardCounter').innerHTML = '';
		document.getElementById('GantryForwardCounter').innerHTML = '';
		document.getElementById('brushDownCounter').innerHTML = '';
		document.getElementById('nozzleDownCounter').innerHTML = '';
		document.getElementById('brushUpCounter').innerHTML = '';
		document.getElementById('nozzleUpCounter').innerHTML = '';
		document.getElementById('SbrushAsideCounter').innerHTML = ''; // updKHu'
		
	}

	function runme(divid) 
	{
		/*
		switch(divid)
		{
		case "GantryBackwardCounter":
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_backward"}),
				  handleAs: "text"
			};
		  break;
		case "GantryForwardCounter":
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"gantry_fwd"}),
				  handleAs: "text"
			};
		  break;
		case "brushDownCounter":
			 var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_down"}),
				  handleAs: "text",
			};
		  break;
		case "nozzleDownCounter":
			 var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_down"}),
				  handleAs: "text"
			};
		  break;
		case "brushUpCounter":
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_brush_up"}),
				  handleAs: "text"
			};
		  break;
		case "nozzleUpCounter":
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"top_nozzle_up"}),
				  handleAs: "text"
			};
		  break;
		case "SbrushAsideCounter": // updKHu
			var xhrArgs = 
			{
				  url: "save_manual_control_data.php",
				  postData: dojo.toJson({command:"side_brush_aside"}),
				  handleAs: "text"
			};
		  break;
		}
		*/

		//var deferred = dojo.xhrPost(xhrArgs); //updKHu
		
		counter++;
		if(counter >= 60) // 30 sek max, updKHu
		{
			mouseupfunc();
			console.log("timeout exeeded in runme function");
		}
//		else
//		{   // 500 ms välein, pesukone odottaa 750 ms strokea
//			var deferred = dojo.xhrPost(xhrArgs);
//		}

		//console.log(counter);
		//console.log("counter=" + counter + " " + "touch=" + touch);
		
		if (touch == 1)
			document.getElementById(divid).innerHTML = "#" + counter;
		else
			document.getElementById(divid).innerHTML = counter;
			
	}

function InsertProgramRow()
{
	var table=document.getElementById("ProgramTable");
	var row=table.insertRow(0);
	var cell1=row.insertCell(0);
	var cell2=row.insertCell(1);
	cell1.innerHTML="<=";
	cell2.innerHTML="Brush wax";
}
function toggleToGray(id)
{
	var obj;
	obj=document.getElementById(id)
	dojo.style("loadingOverlay", {"display": "block"});

	var xhrArgs = 
		{
			  url: "get_debugio_data.php",
			  postData: dojo.toJson({output_id:id,state:"off"}),
			  handleAs: "text"
		};
		var deferred = dojo.xhrPost(xhrArgs);	
		deferred.then(function(value)
		{
			// Do something when the process completes
		//	obj.src="lib/css/images/button_gray.png";
			console.log("toggleToGray deferred");
			setTimeout(function(){dojo.style("loadingOverlay", {"display": "none"});},3000); 
		}, function(err)
		{
			// Do something when the process errors out
			dojo.style("loadingOverlay", {"display": "none"});
		}, function(update)
		{
			// Do something when the process provides progress information
		});
 }
 function toggleToGreen(id)
{
	var obj;
	obj=document.getElementById(id)
	dojo.style("loadingOverlay", {"display": "block"});

	var xhrArgs = 
		{
			  url: "get_debugio_data.php",
			  postData: dojo.toJson({output_id:id,state:"on"}),
			  handleAs: "text"
		};
		var deferred = dojo.xhrPost(xhrArgs);
		deferred.then(function(value)
		{
			// Do something when the process completes
		//	obj.src="lib/css/images/button_green.png"
			console.log("toggleToGreen deferred");
			setTimeout(function(){dojo.style("loadingOverlay", {"display": "none"});},3000); 
		}, function(err)
		{
			// Do something when the process errors out
			dojo.style("loadingOverlay", {"display": "none"});
		}, function(update)
		{
			// Do something when the process provides progress information
		});		
 }

 
function ShowMessage(arr,timeout)
{ 
	if(arr.message_ok != null)
	{
		dojo.byId("status").innerHTML = "Message: " + arr.message_ok;
		setTimeout(function(){dojo.byId("status").innerHTML=""},timeout); // clear status field
	}
	else if(arr.message_err != null)
	{
		dojo.byId("status_err").innerHTML = "Message: " + arr.message_err;
		setTimeout(function(){dojo.byId("status_err").innerHTML=""},timeout); // clear status field
	}
	else
	{
		dojo.byId("status_err").innerHTML = "Message: " + "Unknown message type..";
		setTimeout(function(){dojo.byId("status_err").innerHTML=""},timeout); // clear status field
	}
}

