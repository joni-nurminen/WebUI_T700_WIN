require([
	"dojo/_base/declare",
	"dijit/_WidgetBase",
	"dijit/_TemplatedMixin",
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/DebugIOData/templates/DebugIOData.html",
	"dgrid/OnDemandGrid",
	"dgrid/Selection",
	"dgrid/selector",
	"dojo/store/Memory",
	"dojo/store/JsonRest",
	"dojo/json",
	"dojo/store/Cache",
	"dojo/html",
	"dojo/dom",
	"dojo/i18n!./lib/nls/resources.js",
	"lib/LangSupport",
	"dojox/charting/Chart",
	"dojox/charting/plot2d/Lines",
	"dojox/charting/themes/ThreeD",
	"dijit/registry",
	"dojox/charting/plot2d/Pie",
	"dojox/charting/action2d/Tooltip",
	"dojox/charting/widget/Legend",
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Grid,Selection,selector,Memory,JsonRest,json,Cache,html,dom,resources,LangSupport,Chart,Lines,theme,registry,Pie,Tooltip,Legend){
			return  declare("DebugIOData", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], {

				templateString: template,
				device_speed : resources.device_speed,
				speed : resources.speed,
				npos: resources.npos,
				opos: resources.opos,
				power: resources.power,
				brushes: resources.brushes,
				topbrush: resources.topbrush,
				leftbrush: resources.leftbrush,
				rightbrush: resources.rightbrush,
				top_brush: resources.top_brush,
				nozzle: resources.nozzle,
				nozzles: resources.nozzles,
				roofnozzle: resources.roofnozzle,
				angle: resources.angle,
				top_brush: resources.top_brush,
				nozzle: resources.nozzle,
				gantry: resources.gantry,
				io1: resources.io1,
				io2: resources.io2,
				io3: resources.io3,
				io4: resources.io4,
				io5: resources.io5,
				io6: resources.io6,
				camera_ip: "", //"rtsp://192.168.0.97/h264/main/avstream",
				camera_height: "400",
				camera_width: "640",
				camera_visibility: "display:none;",

				postCreate: function()
				{
				this.inherited(arguments);
				var self = this;
				this.ls = new LangSupport();
				var inter; // upd JNu & KHu
				var speedDataBrush = [30];
				var speedDataNozzle = [30];
				var speedDataMachine = [30];

				var posDataBrush = [30];
				var posDataNozzle = [30];
				var posDataMachine = [30];

				var brushDataBrush= [30];
				var brushDataLBrush= [30];
				var brushDataRBrush= [30];

				var nozzleDataRoofNozzle= [30];

				var chartTimer = -1;

				var tabs = registry.byId("pageTabContainer");

				tabs.watch("selectedChildWidget", function(name, oval, nval)
				{
					console.log("selected child changed from ", oval.id, " to ", nval.id);

					if(nval.id == "debug_io")
					{
						// get status data every 3s from the washmachine, upd JNu & KHu
						inter = setInterval(function()
						{
							var deferred = dojo.xhrGet(xhrArgs);
						}, 500); //time in miliseconds, 3000 ?

						console.log("Start timer(debug_io)");

						var deferred = dojo.xhrGet(xhrArgs);
					}
					else
					{
						console.log("Stop timer(debug_io)");
						clearInterval(inter);
					}
				});      


				dojo.connect(this.stop,     "onclick", null, function() { self.command("stop",self); });
                dojo.connect(this.start,    "onclick", null, function() { self.command("start",self); });


				// colums for IO1
				 var columns_IO1 = [

						 {label:resources.input,
						  get: function(object)
								{
									var n=object.id.split("_"); // split data to get id number
									var id = n[0]; // just the number

									if(id > 0 && id <= 24)
										return self.ls.SetLangByLangId("io1_"+object.id);
									if(id > 24 && id <= 48)
										return self.ls.SetLangByLangId("io2_"+object.id);
									if(id > 48 && id <= 72)
										return self.ls.SetLangByLangId("io3_"+object.id);
									if(id > 72 && id <= 96)
										return self.ls.SetLangByLangId("io4_"+object.id);
									if(id > 96 && id <= 120)
										return self.ls.SetLangByLangId("io5_"+object.id);
									if(id > 120 && id <= 144)
										return self.ls.SetLangByLangId("io6_"+object.id);


									if(id > 144 && id <= 168)
										return self.ls.SetLangByLangId("out1_"+object.id);
									if(id > 168 && id <= 192)
										return self.ls.SetLangByLangId("out2_"+object.id);
									if(id > 192 && id <= 216)
										return self.ls.SetLangByLangId("out3_"+object.id);
									if(id > 216 && id <= 240)
										return self.ls.SetLangByLangId("out4_"+object.id);
									if(id > 240 && id <= 264)
										return self.ls.SetLangByLangId("out5_"+object.id);
									if(id > 264 && id <= 288)
										return self.ls.SetLangByLangId("out6_"+object.id);
								}
							},
						 {
							label: resources.state,
							field: "state",
							sortable: false,
							get: function(object)
								{
										// get card data
									//	this.card = object.card;
										// get current io-state
										this.data = object.state;
										//this.id = object.id;
										var id = object.id.split("_");
										this.id = id[0];
								},
							formatter: function(icon) // show red or gray lamp
							{
								if(this.data == 1)
									if(this.id > 144)
										return "<img class='icon' id='"+this.id+"' onclick='toggleToGray("+this.id+")' src='lib/css/images/button_green.png' width='25' height='25'>&nbsp;</img>";
									else
										return '<div class="icon" id="button_green" style="background-image:url(lib/css/images/button_green.png); width: 25px; height:25px;">&nbsp;</div>';
								else
									if(this.id > 144)
										return "<img class='icon' id='"+this.id+"' onclick='toggleToGreen("+this.id+")' src='lib/css/images/button_gray.png' width='25' height='25'>&nbsp;</img>";
									else
										return '<div class="icon" id="button_gray" style="background-image:url(lib/css/images/button_gray.png); width: 25px; height:25px;">&nbsp;</div>';
							}
						},
						 {label:resources.description, sortable: false,
						  get: function(object)
								{
									var n=object.id.split("_"); // split data to get id number
									var id = n[0]; // just the number

									if(id > 0 && id <= 24)
										return self.ls.SetLangByLangId("io1_desc"+object.id);
									if(id > 24 && id <= 48)
										return self.ls.SetLangByLangId("io2_desc"+object.id);
									if(id > 48 && id <= 72)
										return self.ls.SetLangByLangId("io3_desc"+object.id);
									if(id > 72 && id <= 96)
										return self.ls.SetLangByLangId("io4_desc"+object.id);
									if(id > 96 && id <= 120)
										return self.ls.SetLangByLangId("io5_desc"+object.id);
									if(id > 120 && id <= 144)
										return self.ls.SetLangByLangId("io6_desc"+object.id);


									if(id > 144 && id <= 168)
										return self.ls.SetLangByLangId("out1_desc"+object.id);
									if(id > 168 && id <= 192)
										return self.ls.SetLangByLangId("out2_desc"+object.id);
									if(id > 192 && id <= 216)
										return self.ls.SetLangByLangId("out3_desc"+object.id);
									if(id > 216 && id <= 240)
										return self.ls.SetLangByLangId("out4_desc"+object.id);
									if(id > 240 && id <= 264)
										return self.ls.SetLangByLangId("out5_desc"+object.id);
									if(id > 264 && id <= 288)
										return self.ls.SetLangByLangId("out6_desc"+object.id);

									/*
									if(id > 0 && id <= 24)
										return self.ls.SetLangByLangId("io1_desc"+object.id);
									if(id > 24 && id <= 48)
										return self.ls.SetLangByLangId("io2_desc"+object.id);
									if(id > 48 && id <= 72)
										return self.ls.SetLangByLangId("io3_desc"+object.id);
									if(id > 72 && id <= 96)
										return self.ls.SetLangByLangId("io4_desc"+object.id);

									if(id > 96 && id <= 120)
										return self.ls.SetLangByLangId("out1_desc"+object.id);
									if(id > 120 && id <= 144)
										return self.ls.SetLangByLangId("out2_desc"+object.id);
									if(id > 144 && id <= 168)
										return self.ls.SetLangByLangId("out3_desc"+object.id);
									if(id > 168 && id <= 192)
										return self.ls.SetLangByLangId("out4_desc"+object.id);
										*/
								}
								},
						 ];

				this.IO1Store = new Memory();
				 //  = new Cache(new JsonRest({target:"get_debugio_data.php"}), new Memory());

						// Create grid card1
					 this.grid_card1 = new (declare([Grid, Selection]))({
						 store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card1");

					self.grid_card1.refresh();

					// Create grid card2
					 this.grid_card2= new (declare([Grid, Selection]))({
						store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card2");

				//	self.grid_card2.refresh();

					// Create grid card3
					 this.grid_card3= new (declare([Grid, Selection]))({
						store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card3");

				//	self.grid_card3.refresh();

					// Create grid card4
					 this.grid_card4= new (declare([Grid, Selection]))({
						 store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card4");

					 this.grid_card5= new (declare([Grid, Selection]))({
						 store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card5");

					this.grid_card6= new (declare([Grid, Selection]))({
						 store: new Memory({data:[]}),
						  columns: columns_IO1,
						  selectionMode: "multiple"
					  }, "grid_card6");

				//	self.grid_card4.refresh();
					var xhrArgs =
					{
						url: "get_debugio_data.php",
						handleAs: "text",
						load: function(data)
						{
							if (data)
							{
								self.Card = [];
								var arr = dojo.fromJson(data);

								// show device speed data
								//html.set(dom.byId("Tbrush_OrgPos"), "" + arr[6].Tbrush_OrgPos);
								html.set(dom.byId("Tbrush_EstSpd"), "" + arr[6].Tbrush_EstSpd);
								//html.set(dom.byId("Tbrush_EstPos"), "" + arr[6].Tbrush_EstPos);
								html.set(dom.byId("Tbrush_EstPos"), "" + arr[6].Tbrush_OrgPos);     // FIX This!

								//html.set(dom.byId("Nozzle_OrgPos"), "" + arr[6].Nozzle_OrgPos);
								html.set(dom.byId("Nozzle_EstSpd"), "" + arr[6].Nozzle_EstSpd);
								//html.set(dom.byId("Nozzle_EstPos"), "" + arr[6].Nozzle_EstPos);
								html.set(dom.byId("Nozzle_EstPos"), "" + arr[6].Nozzle_OrgPos);     // FIX This!

								//html.set(dom.byId("Gantry_OrgPos"), "" + arr[6].Gantry_OrgPos);
								html.set(dom.byId("Gantry_EstSpd"), "" + arr[6].Gantry_EstSpd);
								//html.set(dom.byId("Gantry_EstPos"), "" + arr[6].Gantry_EstPos);
								html.set(dom.byId("Gantry_EstPos"), "" + arr[6].Gantry_OrgPos);      // FIX This!

								html.set(dom.byId("Nozzle_angle"), "" + arr[6].Nozzle_angle + " ° "); // + "<br><br><br> Vac=" + arr[6].Main_Voltage + " V"); // Verkkojännite, updKHu

								html.set(dom.byId("Top_Brush_Power"), "" + arr[6].Top_Brush_Power);
								html.set(dom.byId("Left_Brush_Power"), "" + arr[6].Left_Brush_Power);
								html.set(dom.byId("Right_Brush_Power"), "" + arr[6].Right_Brush_Power);

								html.set(dom.byId("topBrushPW"), "" + arr[6].topBrushPW);
								html.set(dom.byId("nozzlePW"), "" + arr[6].nozzlePW);
								html.set(dom.byId("gantryPW"), "" + arr[6].gantryPW);
								
								var i=0;
								var data0,data1,data2,data3,data4,data5,data6,data7;
								data0 = data1 = data2 = data3 = data4 = data5 = data6 = data7 = "";
								// 2cm resoluution lisädata, updKHu v4.8
								var data8,data9,data10,data11;
								data8 = data9 = data10 = data11 = "";
								// Telco extra height upper beams, updKHu v4.8
								var data12,data13,data14,data15;
								data12 = data13 = data14 = data15 = "";
								var resoluutio=0;
								var extra_height=0;
								
								if (arr[6].ScanRes & 2)
									resoluutio=1; // 2cm resoluutio, updKHu v4.8
								if (arr[6].ScanRes & 4)
									extra_height=1; // Telco extra height 240 beams, updKHu v4.8

								for (i=8; i>0; i--)
								{
									data0 += arr[6].ScanData_0 & (1<<(i-1)) ? '1' : '0';
									data1 += arr[6].ScanData_1 & (1<<(i-1)) ? '1' : '0';
									data2 += arr[6].ScanData_2 & (1<<(i-1)) ? '1' : '0';
									data3 += arr[6].ScanData_3 & (1<<(i-1)) ? '1' : '0';
									data4 += arr[6].ScanData_4 & (1<<(i-1)) ? '1' : '0';
									data5 += arr[6].ScanData_5 & (1<<(i-1)) ? '1' : '0';
									data6 += arr[6].ScanData_6 & (1<<(i-1)) ? '1' : '0';
									if ((arr[6].ScanType == 0) && (i<5))
										continue; // Reer skannerilla vain 60 sädettä
									data7 += arr[6].ScanData_7 & (1<<(i-1)) ? '1' : '0';
									if (resoluutio)
									{   // Telco 2cm resoluution lisädata (4 bytes), updKHu v4.8
										data8  += arr[6].ScanData_8 & (1<<(i-1)) ? '1' : '0';
										data9  += arr[6].ScanData_9 & (1<<(i-1)) ? '1' : '0';
										data10 += arr[6].ScanData_10 & (1<<(i-1)) ? '1' : '0';
										data11 += arr[6].ScanData_11 & (1<<(i-1)) ? '1' : '0';
									}
									if (extra_height)
									{   // Telco extra height upper beams (3 bytes), updKHu v4.8
										data12 += arr[6].ScanData_12 & (1<<(i-1)) ? '1' : '0';
										data13 += arr[6].ScanData_13 & (1<<(i-1)) ? '1' : '0';
										data14 += arr[6].ScanData_14 & (1<<(i-1)) ? '1' : '0';
									}
								}
								
								if (arr[6].ScanType == 1)
								{
									if (arr[6].Scan_Target != 0)
									{
										if (extra_height)
										{
											document.getElementById("scannerdata").style.fontSize = "small";
											html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>Scan: "
											+ data14 + " " + data13 + " " + data12 + " " + data11 + " " + data10 + " " + data9 + " " + data8 + " " + data0 + " " + data1 + " " + data2 + " " + data3 + " " + data4 + " " + data5 + " " + data6 + " " + data7 + "</span>");
										}
										else
										{
											if (resoluutio)
											{
												document.getElementById("scannerdata").style.fontSize = "medium";
												html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>Scan: "
												+ data11 + " " + data10 + " " + data9 + " " + data8 + " " + data0 + " " + data1 + " " + data2 + " " + data3 + " " + data4 + " " + data5 + " " + data6 + " " + data7 + "</span>");
											}
											else
												html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>Telco ScanData: "
														+ data0 + " " + data1 + " " + data2 + " " + data3 + " " + data4 + " " + data5 + " " + data6 + " " + data7 + "</span>");
										}
										/* padStart ei toimi Linux alustalla ???
										html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>Telco ScanData: "
																						 + parseInt(arr[6].ScanData_0, 10).toString(2).padStart(8, '0') + " " 
																						 + parseInt(arr[6].ScanData_1, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_2, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_3, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_4, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_5, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_6, 10).toString(2).padStart(8, '0') + " "
																						 + parseInt(arr[6].ScanData_7, 10).toString(2).padStart(8, '0') + "</span>"); // Skannerin data, updKHu
										*/
									}
									else
										html.set(dom.byId("scannerdata"), "Scanner Data: Inactive");
								}
								else
								{
									if (arr[6].Scan_Target != 0)
									{
										html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>ReeR ScanData: "
														+ data0 + " " + data1 + " " + data2 + " " + data3 + " " + data4 + " " + data5 + " " + data6 + " " + data7 + "</span>");
										/* padStart ei toimi Linux alustalla ???
										arr[6].ScanData_7 &= 0xF0;
										arr[6].ScanData_7 >>= 4;
										html.set(dom.byId("scannerdata"), "<span style='color:red; background-color:white'>Reer ScanData: "
																						+ parseInt(arr[6].ScanData_0, 10).toString(2).padStart(8, '0') + " " 
																						+ parseInt(arr[6].ScanData_1, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_2, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_3, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_4, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_5, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_6, 10).toString(2).padStart(8, '0') + " "
																						+ parseInt(arr[6].ScanData_7, 10).toString(2).padStart(4, '0') + "</span>"); // Skannerin data, updKHu
										*/
									}
									else
										html.set(dom.byId("scannerdata"), "Scanner Data: Inactive");
								}
				                html.set(dom.byId("scannererrors"), "Scanner error(s): " + arr[6].ScanError); // updKHu
								html.set(dom.byId("vac"), "VAC: " + arr[6].Main_Voltage + " V"); // updKHu
								html.set(dom.byId("nozzlelevel"), "TOP NOZZLE level: " + arr[6].NozzleDist); // updKHu
								html.set(dom.byId("brushlevel"), "TOP BRUSH level: " + arr[6].TBrushDist); // updKHu
								
								
						//		console.log(arr[4].Tbrush_OrgPos);
								for(var i =0 ; i < arr.length; i++)
								{
									self.Card.push(new Memory({data:arr[i]}));
								}
								// Create grid card1
								self.grid_card1.store =  self.Card[0];
								self.grid_card1.refresh();

								// Create grid card2
								 self.grid_card2.store = self.Card[1];
								self.grid_card2.refresh();

								// Create grid card3
								 self.grid_card3.store = self.Card[2];
								self.grid_card3.refresh();

								// Create grid card4
								 self.grid_card4.store = self.Card[3];
								self.grid_card4.refresh();

								// Create grid card5
								 self.grid_card5.store = self.Card[4];
								self.grid_card5.refresh();

								// Create grid card6
								 self.grid_card6.store = self.Card[5];
								self.grid_card6.refresh();
							}

						}

					}



					/* ********************************* nopeudet kuvaaja *************************** */
					var chartData1 = [];
					var chartData2 = [];
					var chartData3 = [];
					var chartData4 = [];

					// Create the chart within it's "holding" node
					this.chart1 =  new Chart(this.chartNode1);
					this.chart2 =  new Chart(this.chartNode2);
					this.chart3 =  new Chart(this.chartNode3);
					this.chart4 =  new Chart(this.chartNode4);

					// Set the theme
					this.chart1.setTheme(theme);
					this.chart2.setTheme(theme);
					this.chart3.setTheme(theme);
					this.chart4.setTheme(theme);


					// Add the only/default plot
					this.chart1.addPlot("default",
					{
					type: "Lines",
					markers: false
					});

					this.chart2.addPlot("default",
					{
					type: "Lines",
					markers: false
					});

					this.chart3.addPlot("default",
					{
					type: "Lines",
					markers: false
					});

					this.chart4.addPlot("default",
					{
					type: "Lines",
					markers: true
					});

					// Add axes
					this.chart1.addAxis("x");
					this.chart1.addAxis("y", { min: 0, max: 100, vertical: true, fixLower: "major", fixUpper: "major" });

					this.chart2.addAxis("x");
					this.chart2.addAxis("y", { min: 0, max: 260, vertical: true, fixLower: "major", fixUpper: "major" });

					this.chart3.addAxis("x");
					this.chart3.addAxis("y", { min: 0, max: 1000, vertical: true, fixLower: "major", fixUpper: "major" });

					this.chart4.addAxis("x");
					this.chart4.addAxis("y", { min: 0, max: 360, vertical: true, fixLower: "major", fixUpper: "major" });

					// Add the series of data
					this.chart1.addSeries("speedDataBrush",chartData1, {color:"green"});
					this.chart1.addSeries("speedDataNozzle",chartData1,{color:"blue"});
					this.chart1.addSeries("speedDataMachine",chartData1,{color:"red"});


					this.chart2.addSeries("posDataBrush",chartData2,{color:"orange"});
					this.chart2.addSeries("posDataNozzle",chartData2,{color:"purple"});
					this.chart2.addSeries("posDataMachine",chartData2,{color:"violet"});

					this.chart3.addSeries("brushDataBrush",chartData3 ,{color:"green"});
					this.chart3.addSeries("brushDataLBrush",chartData3 ,{color:"blue"});
					this.chart3.addSeries("brushDataRBrush",chartData3 ,{color:"red"});

					this.chart4.addSeries("nozzleDataRoofNozzle",chartData4 ,{color:"green"});



					var tip = new Tooltip(this.chart4, "default");
					//var legend = new dojox.charting.widget.Legend({ chart: this.chart1, horizontal: false }, "legend");

					// Render the chart!
					this.chart1.render();
					this.chart2.render();
					this.chart3.render();
					this.chart4.render();

					this.xhrArgs_chart_data =
						{
								url:"GetChartData.php",
								handleAs:"text",
								timeout: 5000,
								load: function(data)
								{
									var res = dojo.fromJson(data);

									if(speedDataBrush.length == 30)
									{
										speedDataBrush.shift();
									}
									if(speedDataNozzle.length == 30)
									{
										speedDataNozzle.shift();
									}
									if(speedDataMachine.length == 30)
									{
										speedDataMachine.shift();
									}

									if(posDataBrush.length == 30)
									{
										posDataBrush.shift();
									}
									if(posDataNozzle.length == 30)
									{
										posDataNozzle.shift();
									}
									if(posDataMachine.length == 30)
									{
										posDataMachine.shift();
									}

									if(brushDataBrush.length == 30)
									{
										brushDataBrush.shift();
									}
									if(brushDataLBrush.length == 30)
									{
										brushDataLBrush.shift();
									}
									if(brushDataRBrush.length == 30)
									{
										brushDataRBrush.shift();
									}


									if(nozzleDataRoofNozzle.length == 30)
									{
										nozzleDataRoofNozzle.shift();
									}

									speedDataBrush.push(res.nop_harja);
									speedDataNozzle.push(res.nop_suutin);
									speedDataMachine.push(res.nop_kone);

									posDataBrush.push(res.pos_harja);
									posDataNozzle.push(res.pos_suutin);
									posDataMachine.push(res.pos_kone);

									brushDataBrush.push(res.kattoharja_teho);
									brushDataLBrush.push(res.vasharja_teho);
									brushDataRBrush.push(res.oikharja_teho);

									nozzleDataRoofNozzle.push(res.kattosuutin_kulma);

									self.chart1.updateSeries("speedDataBrush", speedDataBrush);
									self.chart1.updateSeries("speedDataNozzle", speedDataNozzle);
									self.chart1.updateSeries("speedDataMachine", speedDataMachine);

									self.chart2.updateSeries("posDataBrush", posDataBrush);
									self.chart2.updateSeries("posDataNozzle", posDataNozzle);
									self.chart2.updateSeries("posDataMachine", posDataMachine);

									self.chart3.updateSeries("brushDataBrush", brushDataBrush);
									self.chart3.updateSeries("brushDataLBrush", brushDataLBrush);
									self.chart3.updateSeries("brushDataRBrush", brushDataRBrush);

									self.chart4.updateSeries("nozzleDataRoofNozzle", nozzleDataRoofNozzle);

									self.chart1.render();
									self.chart2.render();
									self.chart3.render();
									self.chart4.render();
								}
						}
			//		var deferred = dojo.xhrGet(this.xhrArgs_chart_data);


        },
		command: function(command,self)
        {
			switch(command)
			{
				case "start":
				console.log("start ",self.chartTimer);
				if(self.chartTimer > 0)
					return;

				self.chartTimer = setInterval(function()
						{
						//console.log("get io data");
							var deferred = dojo.xhrGet(self.xhrArgs_chart_data);
						}, 500); //time in miliseconds
				break;

				case "stop":
				console.log("stop");
				clearInterval(self.chartTimer);
				self.chartTimer = -1;
				break;
			}
		}

		});
});
