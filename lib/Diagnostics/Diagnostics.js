require([
	"dojo/_base/declare", 
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/Diagnostics/templates/Diagnostics.html",
	"dgrid/OnDemandGrid",
	"dgrid/Selection", 
	"dgrid/selector", 
	"dojo/store/Memory",
	"dojo/store/JsonRest", 
	"dojo/json",
	"dojo/store/Cache",
	"dojo/i18n!./lib/nls/resources.js",
	"dojo/html",
	"dojo/dom",
	"lib/LangSupport",
	"dijit/registry"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Grid,Selection,selector,Memory,JsonRest,json,Cache,resources,html,dom,LangSupport,registry){
			return  declare("Diagnostics", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], {
				
				templateString: template,
				diagnostics: resources.diagnostics,
				uptime: resources.uptime,
				process_cycletimes : resources.process_cycletimes,
				alarm_reason : resources.alarm_reason,
				act: resources.act,
				max: resources.max,
				io_update_and_analog: resources.io_update_and_analog,
				machinecontrol_task: resources.machinecontrol_task,
				cw_server_serial_link:  resources.cw_server_serial_link,
				general_background:  resources.general_background,
				remote_io_task:  resources.remote_io_task,
				time_calculations:  resources.time_calculations,
				cycletime_calculations:  resources.cycletime_calculations,
				scanned_images:  resources.scanned_images,
				prog_step:  resources.prog_step,
				nbr:  resources.nbr,
				logins:  resources.logins,
				time_stamp:  resources.time_stamp,
				alarm_type:  resources.alarm_type,
				latest_ifsf_error: resources.latest_ifsf_error,
				ifsf_id: resources.ifsf_id,
				ifsf_alarm_type: resources.ifsf_alarm_type,
				ifsf_prog_nro: resources.ifsf_prog_nro,
				ifsf_line_nro: resources.ifsf_line_nro,
				ifsf_operation_mode: resources.ifsf_operation_mode,
				ifsf_timestamp: resources.ifsf_timestamp,

				postCreate: function() 
				{
					this.inherited(arguments);
					var self = this;	   	
					this.ls = new LangSupport();
					var inter;
					var state=0; // updKHu
					
					this.Store_user_information = new Memory();
						
					  var columns_user_information = 
					 [
						 {label:"Ip", field: "ip",sortable:false},
						 {label:"User", field:"user",sortable:false},
						 {label:"Login time", field:"time_in",sortable:false},
						 {label:"Logout time", field:"time_out",sortable:false},
					 ];
					 
					// Create grid for user information
					 this.grid_user_information_collection = new (declare([Grid, Selection]))({
						  store: this.Store_user_information,
						  columns: columns_user_information,
						  selectionMode: "single"
					  }, "grid_user_information");	
					  
					console.log("Diagnostics loaded..");
					
					var tabs = registry.byId("pageTabContainer");
						
						tabs.watch("selectedChildWidget", function(name, oval, nval)
						{
							console.log("selected child changed from ", oval.id, " to ", nval.id);

							if(nval.id == "diagnostics")
							{
								// get status data every 3s from the washmachine
								inter = setInterval(function()
								{
									var deferred = dojo.xhrGet(xhrArgs);
								}, 3000); //time in miliseconds

								console.log("Start timer(Diagnostics)");

								var deferred = dojo.xhrGet(xhrArgs);
								var deferred = dojo.xhrGet(xhrArgsGetScannedImages);
							}
							else
							{
								console.log("Stop timer(Diagnostics)");
								clearInterval(inter);
							}
						});

					var xhrArgsGetScannedImages = 
					{
						url: "get_scanned_images.php",
						handleAs: "json",
						load: function(data)
						{
							
							if (data) 
							{
								var im = " ";
								for(var i=0;i<data.length;i++)
								{
									var path = "/lib/css/images/ScannedImage/old/" + data[i];
									var res = data[i].split(".");

									var res = new Date(parseInt(res[0])*1000).toString();
									var parts = res.split(" ");
									//var formatted_date = res.getFullYear() + "-" + (res.getDate() + 1) + "-" + res.getMonth() + " " + res.getHours() + ":" + res.getMinutes() + ":" + res.getSeconds()
									var formatted_date = parts[0]+" "+parts[1]+" "+parts[2]+" "+parts[3]+" "+parts[4];
									im += "<span><img src="+path+" width='400px' height='150px'><div class='caption'>"+formatted_date+"</div></span>";
								}
								document.getElementById('imageslist').innerHTML = im;
	
							}
						}
					}
						
					var xhrArgs = 
					{
						url: "get_diagnostics_data.php",
						handleAs: "text",
						load: function(data)
						{
							if (data) 
							{
								var res = dojo.fromJson(data);
								var user = res.user;
								state = res.state; // updKHu

								self.Store_user_information = new Memory({data:[]});
								
								if(res != null)
									{
										//for(var i=0; i < user.length; i++)
										for(var i=0; i < 10; i++) 
										{
										//	console.log(user[i]);
											self.Store_user_information.put(user[i]);
										}
									}
									
								self.grid_user_information_collection.store = self.Store_user_information;
								self.grid_user_information_collection.refresh();
								
							    var Ifsf_alarm_id = res.ifsf_alarm[0].ifsf_id;
								var Ifsf_alarm_type = res.ifsf_alarm[0].alarm_type;
								var Ifsf_alarm_nro = res.ifsf_alarm[0].prog_number;
								var Ifsf_alarm_line = res.ifsf_alarm[0].line_number; 
								var Ifsf_alarm_mode = res.ifsf_alarm[0].operation_mode;
								var Ifsf_alarm_time = res.ifsf_alarm[0].timestamp;
							
								var ifsf = res.ifsf;
								if(ifsf == 0)
								{
									dojo.style("ifsf_error_data", {"display": "none"}); 
								}
								else
								{
									dojo.style("ifsf_error_data", {"display": "block"}); 
								}
							
								var G10Max = res.G10Max;
								var GLoMax = res.GLoMax;
								var G40Max = res.G40Max;
								var G160Max = res.G160Max;
								var G320Max = res.G320Max;
								var G640Max = res.G640Max;
								var G1280Max = res.G1280Max;
								
								var G10Ave = res.G10Ave;
								var GLoAve = res.GLoAve;
								var G40Ave = res.G40Ave;
								var G160Ave = res.G160Ave;
								var G320Ave = res.G320Ave;
								var G640Ave = res.G640Ave;
								var G1280Ave = res.G1280Ave;
								
								
								var Alarm_A0 =  self.ls.SetLangByLangId(res.Alarm_A0);
								var Alarm_A1 =  self.ls.SetLangByLangId(res.Alarm_A1);
								var Alarm_A2 =  self.ls.SetLangByLangId(res.Alarm_A2);
								var Alarm_A3 =  self.ls.SetLangByLangId(res.Alarm_A3);
								var Alarm_A4 =  self.ls.SetLangByLangId(res.Alarm_A4);
								var Alarm_A5 =  self.ls.SetLangByLangId(res.Alarm_A5);
								var Alarm_A6 =  self.ls.SetLangByLangId(res.Alarm_A6);
								var Alarm_A7 =  self.ls.SetLangByLangId(res.Alarm_A7);
								var Alarm_A8 =  self.ls.SetLangByLangId(res.Alarm_A8);
								var Alarm_A9 =  self.ls.SetLangByLangId(res.Alarm_A9);
								
								var Alarm_S0 = res.Alarm_S0;
								var Alarm_S1 = res.Alarm_S1;
								var Alarm_S2 = res.Alarm_S2;
								var Alarm_S3 = res.Alarm_S3;
								var Alarm_S4 = res.Alarm_S4;
								var Alarm_S5 = res.Alarm_S5;
								var Alarm_S6 = res.Alarm_S6;
								var Alarm_S7 = res.Alarm_S7;
								var Alarm_S8 = res.Alarm_S8;
								var Alarm_S9 = res.Alarm_S9;
								
								var Time_alarm1 = res.Alarm1_time;
								var Time_alarm2 = res.Alarm2_time;
								var Time_alarm3 = res.Alarm3_time;
								var Time_alarm4 = res.Alarm4_time;
								var Time_alarm5 = res.Alarm5_time;
								var Time_alarm6 = res.Alarm6_time;
								var Time_alarm7 = res.Alarm7_time;
								var Time_alarm8 = res.Alarm8_time;
								var Time_alarm9 = res.Alarm9_time;
								var Time_alarm10 = res.Alarm10_time;
								
								html.set(dom.byId("Alarm1_time"), "" + Time_alarm1);
								html.set(dom.byId("Alarm2_time"), "" + Time_alarm2);
								html.set(dom.byId("Alarm3_time"), "" + Time_alarm3);
								html.set(dom.byId("Alarm4_time"), "" + Time_alarm4);
								html.set(dom.byId("Alarm5_time"), "" + Time_alarm5);
								html.set(dom.byId("Alarm6_time"), "" + Time_alarm6);
								html.set(dom.byId("Alarm7_time"), "" + Time_alarm7);
								html.set(dom.byId("Alarm8_time"), "" + Time_alarm8);
								html.set(dom.byId("Alarm9_time"), "" + Time_alarm9);
								html.set(dom.byId("Alarm10_time"), "" + Time_alarm10);
								
								var uptime = res.uptime;
							//	var uptime2 = res.uptime2;
								
								html.set(dom.byId("G10Ave"), "" + G10Ave + " ms");
								html.set(dom.byId("G10Max"), "" + G10Max + " ms");
								
								html.set(dom.byId("GLoAve"), "" + GLoAve + " ms");
								html.set(dom.byId("GLoMax"), "" + GLoMax + " ms");
								
								html.set(dom.byId("G40Max"), "" + G40Max + " ms");
								html.set(dom.byId("G40Ave"), "" + G40Ave + " ms");
								
								html.set(dom.byId("G160Max"), "" + G160Max + " ms");
								html.set(dom.byId("G160Ave"), "" + G160Ave + " ms");
								
								html.set(dom.byId("G320Max"), "" + G320Max + " ms");
								html.set(dom.byId("G320Ave"), "" + G320Ave + " ms");
								
								html.set(dom.byId("G640Max"), "" + G640Max + " ms");
								html.set(dom.byId("G640Ave"), "" + G640Ave + " ms");
								
								html.set(dom.byId("G1280Max"), "" + G1280Max + " ms");
								html.set(dom.byId("G1280Ave"), "" + G1280Ave + " ms");
								
								html.set(dom.byId("Alarm_A0"), "" + Alarm_A0);
								html.set(dom.byId("Alarm_A1"), "" + Alarm_A1);
								html.set(dom.byId("Alarm_A2"), "" + Alarm_A2);
								html.set(dom.byId("Alarm_A3"), "" + Alarm_A3);
								html.set(dom.byId("Alarm_A4"), "" + Alarm_A4);
								html.set(dom.byId("Alarm_A5"), "" + Alarm_A5);
								html.set(dom.byId("Alarm_A6"), "" + Alarm_A6);
								html.set(dom.byId("Alarm_A7"), "" + Alarm_A7);
								html.set(dom.byId("Alarm_A8"), "" + Alarm_A8);
								html.set(dom.byId("Alarm_A9"), "" + Alarm_A9);
								
								html.set(dom.byId("Alarm_S0"), "" + Alarm_S0);
								html.set(dom.byId("Alarm_S1"), "" + Alarm_S1);
								html.set(dom.byId("Alarm_S2"), "" + Alarm_S2);
								html.set(dom.byId("Alarm_S3"), "" + Alarm_S3);
								html.set(dom.byId("Alarm_S4"), "" + Alarm_S4);
								html.set(dom.byId("Alarm_S5"), "" + Alarm_S5);
								html.set(dom.byId("Alarm_S6"), "" + Alarm_S6);
								html.set(dom.byId("Alarm_S7"), "" + Alarm_S7);
								html.set(dom.byId("Alarm_S8"), "" + Alarm_S8);
								html.set(dom.byId("Alarm_S9"), "" + Alarm_S9);
								
								/* latest ifsf error */
								html.set(dom.byId("Ifsf_alarm_id"), "" + Ifsf_alarm_id);
								html.set(dom.byId("Ifsf_alarm_type"), "" + Ifsf_alarm_type);
								html.set(dom.byId("Ifsf_alarm_nro"), "" + Ifsf_alarm_nro);
								html.set(dom.byId("Ifsf_alarm_line"), "" + Ifsf_alarm_line);
								html.set(dom.byId("Ifsf_alarm_mode"), "" + Ifsf_alarm_mode);
								html.set(dom.byId("Ifsf_alarm_time"), "" + Ifsf_alarm_time);
								
								html.set(dom.byId("uptime"), "" + uptime);

								if (state == 5) // Pesu hyväksytty, updKHu v4.7
								{
									//alert("Jepulis pesua pukkaa");
									tabs.selectChild("online_status"); // Online välilehdelle, updKHu v4.7
									domClass.add("pageTabContainer_tablist_online_status", "dijitTabChecked dijitChecked");
								}
							}
							else
								state = 0;
						}
					}          
				}
				
		});
});


