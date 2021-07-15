require([
		"dojo/_base/declare",
		"dijit/_WidgetBase",
		"dijit/_TemplatedMixin",
		"dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/ManualControl/templates/ManualControl.html",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/dom",
		"dojo/html",
		"dojo/on",
		"dojo/i18n!./lib/nls/resources.js",
		"dijit/registry", // upd JNu & KHu
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, theme, xhr, dom ,html, on,resources,registry)
		{
			return  declare("ManualControl", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin],
			{

			templateString: template,
			manual_control: resources.manual_control,
			drive_in: resources.drive_in,
			drive_out: resources.drive_out,
			maintenance: resources.maintenance,
			frost_blowout: resources.frost_blowout,
			floor_wash: resources.floor_wash,
			roof_brush_up: resources.roof_brush_up,
			roof_brush_down: resources.roof_brush_down,
			roof_nozzle_up: resources.roof_nozzle_up,
			roof_nozzle_down: resources.roof_nozzle_down,
			start_pump: resources.start_pump,
			gantry_backward: resources.gantry_backward,
			gantry_forward: resources.gantry_forward,
			side_brush_aside: resources.side_brush_aside, // updKHu
			shutdown: resources.shutdown,
			reboot: resources.reboot,
			reset: resources.reset,
			online: resources.online,
			offline: resources.offline,
			postCreate: function()
			{
				this.inherited(arguments);
				var self = this;
				var inter; // upd JNu & KHu
				var old_uptime_master;
				var counter = 0;
				var counter2 = 0; // updKHu v4.8

				var tabs = registry.byId("pageTabContainer");
					
				tabs.watch("selectedChildWidget", function(name, oval, nval)
				{
					console.log("selected child changed from ", oval.id, " to ", nval.id);

					if(nval.id == "manual_control")
					{
						// get camera settings
						this.xhrArgs_camera_settings =
						{
							url: "manage_camera.php",
							handleAs: "text",
							load: function(data)
							{

							}
						}
						var deferred = dojo.xhrGet(this.xhrArgs_camera_settings);
						deferred.then(function(data)
						{
							var arr = dojo.fromJson(data);
							var camera_status = parseInt(arr[0].camera_status);
							var camera_ip = arr[0].camera_ip;
							var camera_port = arr[0].camera_port;
							var camera_quality = arr[0].camera_quality;
							var camera_fps = arr[0].camera_fps;
							var camera_width = arr[0].camera_width;
							var camera_height = arr[0].camera_height;

							if(camera_status == 1) // camera is on
							{
								
								if (Hls.isSupported()) 
								{
								  var video = document.getElementById('video');
								  var hls = new Hls();
								  // bind them together
								  hls.attachMedia(video);
								  hls.on(Hls.Events.MEDIA_ATTACHED, function () 
								  {
									console.log("video and hls.js are now bound together !");
									hls.loadSource("http://10.2.213.90/test/stream.m3u8");
									hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
									});
								  });
								}
								else
									console.log("Hls is not supported!");
								
								// request camera stream
							//	var n = dojo.create("div", { innerHTML: "<iframe id='ip_camera' data-dojo-attach-point='ip_camera' src='http://"+camera_ip+":"+camera_port+"/control/faststream.jpg?stream=full&preview&previewsize="+camera_width+"x"+camera_height+"&quality="+camera_quality+"&fps="+camera_fps+"' align='center' style='height:525px; width:700px' scrolling='no' frameborder=no marginheight='0px'></iframe" });
							//	var n = dojo.create("div", { innerHTML: "<video id='ip_camera' data-dojo-attach-point='ip_camera' src='http://10.2.213.90:8080/' autoplay='true' controls='controls' width='700' height='525'></video>" });
							//	dojo.place(n, 'videoarea');
							}
							else
							{
								// cancel camera stream request
								dojo.destroy("ip_camera");
							}

						}, function(err)
						{
							console.log("error",err);
						}, function(update)
						{
							console.log(data);
						});

					
						
						// get status data every 3s from the washmachine
						inter = setInterval(function()
						{
							var deferred = dojo.xhrGet(xhrArgs);
						}, 500); //time in miliseconds, 3000 -> 500 updKHu

						console.log("Start timer(manual_control)");

						var deferred = dojo.xhrGet(xhrArgs);
					}
					else
					{
						
						// cancel camera stream request
						dojo.destroy("ip_camera");
						console.log("Stop timer(manual_control)");
						clearInterval(inter);
					}
				});      

				 dojo.connect(this.FrostBlowout, "onclick", null, function() { self.pressed("frost_blowout"); });
				 dojo.connect(this.FloorWash, "onclick", null, function() { self.pressed("floor_wash"); });
				 dojo.connect(this.RoofBrushUp, "onclick", null, function() { self.pressed_roofbrush_up(); });
				 dojo.connect(this.DriveIn, "onclick", null, function() { self.pressed("drive_in"); });
				 dojo.connect(this.DriveOut, "onclick", null, function() { self.pressed("drive_out"); });
				 dojo.connect(this.Maintenance, "onclick", null, function() { self.pressed("maintenance"); });
				 dojo.connect(this.RoofNozzleUp, "onclick", null, function() { self.pressed_roofnozzle_up(); });
				 dojo.connect(this.RoofBrushDown, "onclick", null, function() { self.pressed_roofbrush_down(); });
				 dojo.connect(this.RoofNozzleDown, "onclick", null, function() { self.pressed_roofnozzle_down(); });
				 dojo.connect(this.StartPump, "onclick", null, function() { self.pressed("startpump"); });
				 dojo.connect(this.GantryForward, "onclick", null, function() { self.pressed_forward(); });
				 dojo.connect(this.GantryBackward, "onclick", null, function() { self.pressed_backward(); });
				 dojo.connect(this.ShutDown, "onclick", null, function() { self.pressed_shutdown(); });
				 dojo.connect(this.Reboot, "onclick", null, function() { self.pressed_reboot(); });
				 dojo.connect(this.Reset, "onclick", null, function() { self.pressed_reset(); });
				 dojo.connect(this.SbrushAside, "onclick", null, function() { self.pressed_sidebrush_aside(); }); // updKHu

				 var xhrArgs =
						{
							url: "save_manual_control_data.php",
							handleAs: "text",
							timeout: 2000,
							load: function(data)
							{
								if (data)
								{
									var res = dojo.fromJson(data);

									var frost_blowout_status = res.frost_blowout_status;
									var floor_wash_status = res.floor_wash_status;
									var drive_in = res.drive_in;
									var drive_out = res.drive_out;
									var maintenance = res.maintenance;
									var pump_state = res.pump_state;
									var state = res.state;
									var logged_user = res.logged_user;
									var machine_state = res.machine_state; // updKHu
									var uptime_master = res.uptime_master; 

									if(uptime_master != old_uptime_master) // if shared mem is ok show green lamp
									{
										//if sharedmemory is up
										dojo.style("shared_mem_ok", {
														  "backgroundImage": "url('../lib/css/images/button_green.png')",
														  "height": "25px",
														  "width": "25px"
														  });

										html.set(dom.byId("shared_mem_ok_text"), " System " + self.online);
										dojo.style("shared_mem_ok_text", {"color": "green"});

										old_uptime_master = uptime_master;
									//	old_uptime_slave = uptime_slave;
										counter = 0;
									}
									else
									{
										if(counter > 6)
										{
                                            dojo.style("button_master", {"visibility": "hidden"});
                                            dojo.style("button_slave", {"visibility": "hidden"});

                                            dojo.style("shared_mem_ok", {
                                                              "backgroundImage": "url('../lib/css/images/button_red.png')",
                                                              "height": "25px",
                                                              "width": "25px"
                                                              });
                                            html.set(dom.byId("shared_mem_ok_text"), " System " + self.offline);
                                            dojo.style("shared_mem_ok_text", {"color": "red"});
										//	clearInterval(inter);
										}
									//	alert("Can't open shared memory!");
										if(counter == 12)
										{
										//	alert("Connection to washing machine failed!");
											counter = 0;
										}
										else
											counter ++;
										  
										 
									}

									if(logged_user == "Chain" || logged_user == "Operator")
									{
											dojo.style("Maintenance", {
											  "visibility": "collapse"
											  });
									}
									else
									{
										dojo.style("Maintenance", {
											  "visibility": "visible"
											  });
									}


									if(drive_in == 1)
									{
										dojo.byId("DriveIn").innerHTML = "<div class='manualcontrol_button_selected' id='DriveIn' data-dojo-attach-point='DriveIn'><span>"+resources.drive_in+"</span></div>";
									}
									else
									{
										dojo.byId("DriveIn").innerHTML = "<div class='manualcontrol_button' id='DriveIn' data-dojo-attach-point='DriveIn'><span>"+resources.drive_in+"</span></div>";
									}

									if(drive_out == 1)
									{
										dojo.byId("DriveOut").innerHTML = "<div class='manualcontrol_button_selected' id='DriveOut' data-dojo-attach-point='DriveOut'><span>"+resources.drive_out+"</span></div>";
									}
									else
									{
										dojo.byId("DriveOut").innerHTML = "<div class='manualcontrol_button' id='DriveOut' data-dojo-attach-point='DriveOut'><span>"+resources.drive_out+"</span></div>";
									}
									if(maintenance == 1)
									{
										dojo.byId("Maintenance").innerHTML = "<div class='manualcontrol_button_selected' id='Maintenance' data-dojo-attach-point='Maintenance'><span>"+resources.maintenance+"</span></div>";
									}
									else
									{
										dojo.byId("Maintenance").innerHTML = "<div class='manualcontrol_button' id='Maintenance' data-dojo-attach-point='Maintenance'><span>"+resources.maintenance+"</span></div>";
									}
									if(pump_state == 1)
									{
										dojo.byId("StartPump").innerHTML = "<div class='manualcontrol_button_selected' id='StartPump' data-dojo-attach-point='StartPump'><span>"+resources.start_pump+"</span></div>";
									}
									else
									{
										dojo.byId("StartPump").innerHTML = "<div class='manualcontrol_button' id='StartPump' data-dojo-attach-point='StartPump'><span>"+resources.start_pump+"</span></div>";
									}
									if(frost_blowout_status == 1)
									{
										dojo.byId("FrostBlowout").innerHTML = "<div class='manualcontrol_button_selected' id='FrostBlowout' data-dojo-attach-point='FrostBlowout'><span>"+resources.frost_blowout+"</span></div>";
									}
									else
									{
										dojo.byId("FrostBlowout").innerHTML = "<div class='manualcontrol_button' id='FrostBlowout' data-dojo-attach-point='FrostBlowout'><span>"+resources.frost_blowout+"</span></div>";
									}
									if(floor_wash_status == 10)
									{
										dojo.byId("FloorWash").innerHTML = "<div class='manualcontrol_button_selected' id='FloorWash' data-dojo-attach-point='FloorWash'><span>"+resources.floor_wash+"</span></div>";
									}
									else
									{
										dojo.byId("FloorWash").innerHTML = "<div class='manualcontrol_button' id='FloorWash' data-dojo-attach-point='FloorWash'><span>"+resources.floor_wash+"</span></div>";
									}
									/*
									if(state == 11)
									{
										dojo.byId("RoofBrushUp").innerHTML = "<div class='manualcontrol_button_selected' id='RoofBrushUp' data-dojo-attach-point='RoofBrushUp'><span class='text'>"+resources.roof_brush_up+"</span></div>";
									}
									else
									{
										dojo.byId("RoofBrushUp").innerHTML = "<div class='manualcontrol_button' id='RoofBrushUp' data-dojo-attach-point='RoofBrushUp'><span class='text'>"+resources.roof_brush_up+"</span></div>";
									}
									if(state == 10)
									{
										dojo.byId("RoofNozzleUp").innerHTML = "<div class='manualcontrol_button_selected' id='RoofNozzleUp' data-dojo-attach-point='RoofNozzleUp'><span class='text'>"+resources.roof_nozzle_up+"</span></div>";
									}
									else
									{
										dojo.byId("RoofNozzleUp").innerHTML = "<div class='manualcontrol_button' id='RoofNozzleUp' data-dojo-attach-point='RoofNozzleUp'><span class='text'>"+resources.roof_nozzle_up+"</span></div>";
									}
									*/
									if (machine_state == 1) // Pesukone häiriössä, updKHu
									{
										dojo.style("SbrushAside", {"visibility": "visible"});
										dojo.style("RoofNozzleDown", {"visibility": "visible"});
										dojo.style("RoofBrushDown", {"visibility": "visible"});
										dojo.style("ShutDown", {"visibility": "visible"}); // Shutdown näkyvissä vain idle, häiriö ja huolto tilassa, updKHu v4.8
										dojo.style("Reboot", {"visibility": "visible"});
										dojo.style("Reset", {"visibility": "visible"});
										dojo.style("FrostBlowout", {"visibility": "hidden"});
										dojo.style("FloorWash", {"visibility": "hidden"});
									}
									else
									{
										dojo.style("SbrushAside", {"visibility": "hidden"});
										dojo.style("Reboot", {"visibility": "hidden"});	// Reboot ja Reset näkyvissä vain häiriö tilassa, updKHu v4.8
										dojo.style("Reset", {"visibility": "hidden"});
										if (machine_state == 5)
										{
											if (counter2++ == 10) // Mahdollisuus ohjata ovia authorised tilassa, updKHu v4.8
											{
												counter2 = -15;
												tabs.selectChild("online_status"); // Online välilehdelle, updKHu v4.7
												domClass.add("pageTabContainer_tablist_online_status", "dijitTabChecked dijitChecked");
											}
										}
										else
											counter2 = 0;
										if ((machine_state == 3) || (machine_state == 9)) // Pesukone idle tai huolto tilassa, updKHu v4.8
										{
											dojo.style("RoofNozzleDown", {"visibility": "visible"});
											dojo.style("RoofBrushDown", {"visibility": "visible"});
											dojo.style("ShutDown", {"visibility": "visible"});
											dojo.style("FrostBlowout", {"visibility": "visible"});
											dojo.style("FloorWash", {"visibility": "visible"});										
										}
										else // Piilotetaan lasku napit turvallisuussyistä muissa paitsi idle, häiriö ja huoltotilassa, updKHu v4.8
										{
											dojo.style("RoofNozzleDown", {"visibility": "hidden"});
											dojo.style("RoofBrushDown", {"visibility": "hidden"});
											dojo.style("ShutDown", {"visibility": "hidden"});
											dojo.style("FrostBlowout", {"visibility": "hidden"});
											dojo.style("FloorWash", {"visibility": "hidden"});											
										}
									}
								}
							},
							error: function(error)
							{
								console.log(error);
							}
						};
//						var inter = setInterval(function()
//						{
//							var deferred = dojo.xhrGet(xhrArgs);
//						}, 500); //time in miliseconds 3000 ?

			},
			pressed: function(button)
			{
				// set button color to yellow when waiting...
			if(button == "maintenance")
			{
				dojo.byId("Maintenance").innerHTML = "<div class='manualcontrol_button_wait' id='Maintenance' data-dojo-attach-point='Maintenance'><span>"+resources.maintenance+"</span></div>";
			}
			if(button == "drive_out")
			{
				dojo.byId("DriveOut").innerHTML = "<div class='manualcontrol_button_wait' id='DriveOut' data-dojo-attach-point='DriveOut'><span>"+resources.drive_out+"</span></div>";
			}
			if(button == "drive_in")
			{
				dojo.byId("DriveIn").innerHTML = "<div class='manualcontrol_button_wait' id='DriveIn' data-dojo-attach-point='DriveIn'><span>"+resources.drive_in+"</span></div>";
			}
			if(button == "startpump")
			{
				dojo.byId("StartPump").innerHTML = "<div class='manualcontrol_button_wait' id='StartPump' data-dojo-attach-point='StartPump'><span>"+resources.start_pump+"</span></div>";
			}
			if(button == "floor_wash")
			{
				dojo.byId("FloorWash").innerHTML = "<div class='manualcontrol_button_wait' id='FloorWash' data-dojo-attach-point='FloorWash'><span>"+resources.floor_wash+"</span></div>";
			}
			if(button == "frost_blowout")
			{
				dojo.byId("FrostBlowout").innerHTML = "<div class='manualcontrol_button_wait' id='FrostBlowout' data-dojo-attach-point='FrostBlowout'><span>"+resources.frost_blowout+"</span></div>";
			}

				var xhrArgs =
						{
							  url: "save_manual_control_data.php",
							  postData: dojo.toJson({command:button}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);
			},
			pressed_forward: function()
			{
				console.log("pressed_forward");
			},
			pressed_backward: function()
			{
				console.log("pressed_backward");
			},
			pressed_roofbrush_up: function()
			{
				console.log("pressed_roofbrush_up");
			},
			pressed_roofbrush_down: function()
			{
				console.log("pressed_roofbrush_down");
			},
			pressed_roofnozzle_up: function()
			{
				console.log("pressed_roofnozzle_up");
			},
			pressed_roofnozzle_down: function()
			{
				console.log("pressed_roofnozzle_down");
			},
			pressed_sidebrush_aside: function() // updKHu
			{
				console.log("pressed_sidebrush_aside");
			},
			pressed_reset: function()
			{
				var xhrArgs_get_operation_state =
				{
				url: "run_command.php/get_operation_state",
				handleAs: "text",
					load: function(data)
					{
						if (data)
						{
							var arr = dojo.fromJson(data);
							var o_mas = arr.operation_mode_master;
							var o_sla = arr.operation_mode_slave;

							if(o_mas != 6 && o_sla != 6) // something else than washing mode
							{
								var c = confirm("Reset system ?");
									if(c)
									{
									var xhrArgs =
											{
												  url: "save_manual_control_data.php",
												  postData: dojo.toJson({command:"reset"}),
												  handleAs: "text"
											};
											var deferred = dojo.xhrPost(xhrArgs);
											console.log("pressed_reset");
									}
							}
							else
								alert("Reboot command not allowed.");
						}
					}
				}
			var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
			},
			pressed_reboot: function()
			{
				var xhrArgs_get_operation_state =
				{
				url: "run_command.php/get_operation_state",
				handleAs: "text",
				load: function(data)
				{
					if (data)
					{
						var arr = dojo.fromJson(data);
						var o_mas = arr.operation_mode_master;
						var o_sla = arr.operation_mode_slave;

						if(o_mas != 6 && o_sla != 6) // something else than washing mode
						{
							var c = confirm("Reboot system ?");
								if(c)
								{
								var xhrArgs =
										{
											  url: "save_manual_control_data.php",
											  postData: dojo.toJson({command:"reboot"}),
											  handleAs: "text"
										};
										var deferred = dojo.xhrPost(xhrArgs);
										console.log("pressed_reboot");
								}
						}
						else
							alert("Reboot command not allowed.");
					}
				}
				}
			var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
			},
			pressed_shutdown: function()
			{
				var xhrArgs_get_operation_state =
				{
				url: "run_command.php/get_operation_state",
				handleAs: "text",
				load: function(data)
				{
					if (data)
					{
						var arr = dojo.fromJson(data);
						var o_mas = arr.operation_mode_master;
						var o_sla = arr.operation_mode_slave;

						if(o_mas != 6 && o_sla != 6) // something else than washing mode
						{
							var c = confirm("Shutdown system ?");
								if(c)
								{
								var xhrArgs =
										{
											  url: "save_manual_control_data.php",
											  postData: dojo.toJson({command:"shutdown"}),
											  handleAs: "text"
										};
										var deferred = dojo.xhrPost(xhrArgs);
										console.log("pressed_reboot");
								}
						}
						else
							alert("Shutdown command not allowed. !");
					}
				}
				}
			var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
			},
        });
    });
