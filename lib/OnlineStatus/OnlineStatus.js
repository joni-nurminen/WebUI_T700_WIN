require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/OnlineStatus/templates/OnlineStatus.html",
		"dijit/form/Button",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dijit/form/ComboBox",
		"dojo/store/Cache",
		"dojo/store/JsonRest",
		"dojo/store/Memory",
		"dojo/html",
		"dojo/dom",
		"dgrid/OnDemandGrid",
		"dgrid/Selection",
		"dgrid/editor",
		"dojo/i18n!./lib/nls/resources.js",
		"lib/LangSupport",
		"dojox/image",
		"dijit/registry",
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template,
				Button, theme, xhr,ComboBox,Cache,JsonRest,Memory,html,dom,Grid,Selection,editor,resources,LangSupport,image,registry)
		{
			return  declare("OnlineStatus", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin],
			{

				templateString: template,
				log_out: resources.log_out,
				online_status_header: resources.online_status_header,
				message: resources.message,
				logged_user: resources.logged_user,
				operation_mode: resources.operation_mode,
				washing_time: resources.washing_time,
				program_line_number: resources.program_line_number,
				program_number: resources.program_number,
				online: resources.online,
				offline: resources.offline,

				display_ct: function()
				{
					var x = new Date()
					document.getElementById('clockCtr').innerHTML = x;

				},
				postCreate: function()
				{
				this.inherited(arguments);
				this.ls = new LangSupport();
				var self = this;
				var old_uptime_master;
				var old_uptime_slave;
				var counter = 0;
				var free_counter = 0; // updKHu
				var utick_counter = 0;
				var slave_mode = false;
				var s;
				var s_machine;
                var read_counters_flag = false;
				var counters_saved_flag = false;
				var test;
				var mode;
				var maintenance;
				var inter; // upd JNu & KHu
				var texts;
				var texts32;
				var lang; // Siirretty tähän, updKHu
				
				var u_ticker;
				var old_u_ticker;
				

												
				texts = [resources.TXT_KOODAAMATON,
						resources.TXT_ESIPESU1,
						resources.TXT_ESIPESU2,
						resources.TXT_VAAHTO,
						resources.TXT_VAIKUTUS,
						resources.TXT_ALUSTA,
						resources.TXT_PYORAT,
						resources.TXT_SIVUKP,
						resources.TXT_KATTOKP,
						resources.TXT_HARJAT,
						resources.TXT_VESIHUUHTELU,
						resources.TXT_KPHUUHTELU,
						resources.TXT_OSMOOSIVESI,
						resources.TXT_VAHA,
						resources.TXT_KUIVAUSVAHA,
						resources.TXT_HARJAVAHA,
						resources.TXT_KIILLOTUS,
						resources.TXT_KUIVAUS,
						resources.TXT_PAKU,
						resources.TXT_OK,
						resources.TXT_IFSFODOTUS,
						resources.TXT_KOTIRAJA,
						resources.TXT_KAANTORAJA,
						resources.TXT_YLARAJA_SUUTIN,
						resources.TXT_KESKELLE_SUUTIN,
						resources.TXT_KORKEUSMITTAUS,
						resources.TXT_YLARAJA_HARJA,
						resources.TXT_SIVURAJA_HARJA,
						resources.TXT_VALOKENNO_A,
						resources.TXT_AJA,
						resources.TXT_STOP,
						resources.TXT_PERUUTA,
						resources.TXT_PESUKIELTO,
						resources.TXT_KOODI,
						resources.TXT_OHJELMANR1,
						resources.TXT_OHJELMANR2,
						resources.TXT_OHJELMANR3,
						resources.TXT_AJAULOS,
						resources.TXT_PESUAIKA,
						resources.TXT_YHTEENSA,
						resources.TXT_LATTIAPESU,
						resources.TXT_ILMANPAINE,
						resources.TXT_VESIPAINE,
						resources.TXT_HATASEIS,
						resources.TXT_MOOTTSUOJA,
						resources.TXT_PUMPPUSUOJA,
						resources.TXT_VALISAILIO,
						resources.TXT_YLIAIKA,
						resources.TXT_TANKORAJA,
						resources.TXT_TAAJUUSMUUTTAJA,
						resources.TXT_OHJAUSPAATE,
						resources.TXT_BIOJET,
						resources.TXT_HIHNARAJA,
						resources.TXT_VIRTA_VSH,
						resources.TXT_VIRTA_OSH,
						resources.TXT_VIRTA_KH,
						resources.TXT_SUUTINASENTO,
						resources.TXT_EI_KOODIA,
						resources.TXT_PESUMAARAT,
						resources.TXT_INPUTTESTI,
						resources.TXT_OUTPUTTESTI,
						resources.TXT_ERIKOISOHJ,
						resources.TXT_IOTESTIT,
						resources.TXT_MUISTIO,
						resources.TXT_YHTEENSA2,
						resources.TXT_POLETTIKOODAUS,
						resources.TXT_OVIOHJAUS,
						resources.TXT_PARAMETRIT,
						resources.TXT_TEHDASASETUKSET,
						resources.TXT_HAIRIOT,
						resources.TXT_HALLITYYPPI,
						resources.TXT_OHJAUSSIGNAALI,
						resources.TXT_OVIEN_KAYTTOTAPA,
						resources.TXT_PERUUTETTAVA,
						resources.TXT_LAPIAJO,
						resources.TXT_KONTAKTIOVI,
						resources.TXT_PULSSIOVI,
						resources.TXT_NORMAALI,
						resources.TXT_AVAA_MOLEMMAT,
						resources.TXT_TUULETUS,
						resources.TXT_ODOTA,
						resources.TXT_SUUTIN_YLOS,
						resources.TXT_SUUTIN_ALAS,
						resources.TXT_HARJA_YLOS,
						resources.TXT_HARJA_ALAS,
						resources.TXT_KULKU_ETEEN,
						resources.TXT_KULKU_TAAKSE,
						resources.TXT_NOPEUS,
						resources.TXT_OHJELMATYYPPI,
						resources.TXT_HUOLTO,
						resources.TXT_KESKEYTETYT,
						resources.TXT_KONEPARAMETRIT,
						resources.TXT_INV_KULKU,
						resources.TXT_INV_NOSTO,
						resources.TXT_NUMERO,
						resources.TXT_VAARA_OSOITE,
						resources.TXT_VAARA_ARVO,
						resources.TXT_PYORA,
						resources.TXT_PIENI,
						resources.TXT_ISO,
						resources.TXT_POLETIN_KUITTAUS,
						resources.TXT_SULJETTU,
						resources.TXT_HUOLTOTILA,
						resources.TXT_BIO_TAYTTO,
						resources.TXT_KH_VIRTA,
						resources.TXT_SH_VIRTA,
						resources.TXT_SIIRTYNYTRAJA,
						resources.TXT_SH_YLIKALLISTUS,
						resources.TXT_KH_ALARAJA,
						resources.TXT_SUUTIN_ALARAJA,
						resources.TXT_JAANESTO,
						resources.TXT_KIERRATYS,
						resources.TXT_ODOTAN,
						resources.TXT_TAKAKONEHAIRIO,
						resources.TXT_ODOTUS,
						resources.TXT_PYORAESIPESU,
						resources.TXT_JATKETAANKO,
						resources.TXT_SUUTIN_VALUNUT,
						resources.TXT_KH_VALUNUT 
						];

					texts32 = [
						resources.TXT32_HALL_LENGTH,
						resources.TXT32_WB_ASIDE,
						resources.TXT32_ERR_G_PULSE,
						resources.TXT32_ERR_TN_PULSE,
						resources.TXT32_ERR_TB_PULSE,
						resources.TXT32_ERR_HEIGHT,
						resources.TXT32_ERR_WHEELBRUSH,
						resources.TXT32_ERR_SIDEBRUSH,
						resources.TXT32_ERR_SCANNER,
						resources.TXT32_ERR_TN_UPLIMIT,
						resources.TXT32_ERR_TB_UPLIMIT,
						resources.TXT32_ERR_BRUSHWATER
						];
						
				self.allowCommands();
				console.log("Online status loaded.. Start timer.");
				// get status data every 5s from the washmachine
								  
				console.log(texts);
				console.log(texts32); // updKHu

				inter = setInterval(function()
				{
					var deferred = dojo.xhrGet(xhrArgs);
				}, 1000); //time in miliseconds, 5000 ?

				var tabs = registry.byId("pageTabContainer");
					
					tabs.watch("selectedChildWidget", function(name, oval, nval)
					{
						
						console.log("selected child changed from ", oval.id, " to ", nval.id);

						if(nval.id == "online_status")
						{
						
							// get status data every 5s from the washmachine
							inter = setInterval(function()
							{
								var deferred = dojo.xhrGet(xhrArgs);
							}, 1000); //time in miliseconds, 5000 ?

							console.log("Start timer(Online status)");

							var deferred = dojo.xhrGet(xhrArgs);
							if(s_machine == 1)
								self.command("master");
							if(s_machine == 2)
								self.command("slave");
								
							self.test = s_machine;	
						
						self.allowCommands();
						}
						else
						{
							console.log("Stop timer(Online status)");
							clearInterval(inter);
						}
					});          

					var xhrArgs_selected_machine =
						{
							url: "get_onlinestatus_data.php",
							handleAs: "text",
							timeout: 5000,
							load: function(data)
							{
								if (data)
								{
									var res = dojo.fromJson(data);
									var selected_machine = res.selected_machine; // selected machine

										if(selected_machine == 1)
											self.command("master");
										if(selected_machine == 2)
											self.command("slave");

									self.test = selected_machine;
								}
							}
						}
						var deferred = dojo.xhrGet(xhrArgs_selected_machine);

						var xhrArgs_get_lang =
						{
							url: "save_lang.php",
							handleAs: "text",
							timeout: 5000,
							load: function(data)
							{
								if (data)
								{
									
								}
							}
						}
						
						var deferred = dojo.xhrGet(xhrArgs_get_lang);
						deferred.then(function(data)
						{
							var res = dojo.fromJson(data);
						//	var lang = res.lang; // saved lang
							lang = res.lang; // updKHu
						//	console.log(window.location.search);
							lang = "?"+res.lang;
						//	console.log(lang);
											
							// save burbrown texts to sharedmemory but not yet, after when connection is OK to machine, updKHu
							if (free_counter >= 5)
							{
								
								var xhrArgs_sync_lang =
								{
									url: "sync_text.php",
									postData: dojo.toJson({data:texts,data32:texts32}),
									handleAs: "text",
									timeout: 14000,
									load: function(data)
									{
										console.log(data);
									}
								}
								var deferred = dojo.xhrPost(xhrArgs_sync_lang);
								deferred.then(function(data)
								{
									console.log(data);
									if(window.location.search != lang)
										window.location.replace(lang);
								});
								
							}
						});

				setInterval(this.display_ct, 500); //time in miliseconds 1000 ?


				dojo.connect(this.continue_prog, "onclick", null, function() { self.command("continue_prog"); });
                dojo.connect(this.stop,          "onclick", null, function() { self.command("stop"); });
                dojo.connect(this.pause,         "onclick", null, function() { self.command("pause"); });

				dojo.connect(this.button_master, "onclick", null, function() { self.command("master"); });
				dojo.connect(this.button_slave,  "onclick", null, function() { self.command("slave"); });

			
				console.log(this.texts);
				console.log(this.texts32); // updKHu

				var ProgramLine = [];
				this.ProgramLineStore = new Memory({data:ProgramLine});


					var xhrArgs =
						{
							url: "get_onlinestatus_data.php",
							handleAs: "text",
							timeout: 5000,
							load: function(data)
							{
								if (data)
								{
									var res = dojo.fromJson(data);
									var arr = res.pl;
									var operation_mode = res.operation_mode; // operation mode
									var version_nro = res.version_nro; // version nro
									var prog_line_number = res.prog_line_number; // current programline number
									var is_scanner = res.is_scanner; // is scanner configured

									if(res.prog_number != null)
										self.prog_number = res.prog_number; // current program number

									var washingtime_min = res.washingtime_min; // washingtime mins
									var washingtime_sek = res.washingtime_sek; // washingtime secs
									var error = res.error; // washingtime secs
									self.logged_user = res.logged_user; // logged user
									var bb_textline = res.bb_textline; // bb-text
									var scanner_image = res.scanner_image; // scanned image
									var scanner_image_slave = res.scanner_image_slave; // scanned image slave
									var image_mod_time = res.image_mod_time; // scanned image
									var uptime_master = res.uptime_master; // uptime master
									var uptime_slave = res.uptime_slave; // uptime slave
									self.machinetype =  parseInt(res.machine_type); // machinetype
									var selected_machine = res.selected_machine; // selected machine
									var ip_master = res.ip_master; // ip master
									var ip_slave = res.ip_slave; // ip slave
									var is_maintenance = res.maintenance; // check if it is in maintenance mode
									var allow_continue_cancel = res.allow_continue_cancel; // allow continue and cancel commands
									var cw_status = res.cw_status; // status of cw-server
									var ifsf_status = res.ifsf_status; // status of ifsf-server
									var ifsf_version = res.ifsf_version; // ifsf versionnumber
									var ifsf_available = res.ifsf_available; // ifsf available
									u_ticker = res.u_ticker; // tick counter

								//	console.log("Count: "+u_ticker);

									self.allowCommands();

									s_machine = selected_machine;

									if(self.prog_number != 0 ||  self.prog_number != null)
										this.prognro = self.prog_number;

									// dont show nothing if prog or linenumber is not set
									if(self.prog_number < 1 ||  self.prog_number == null)
										self.prog_number = "";
									if(prog_line_number < 1 || prog_line_number == null)
										prog_line_number = "";


									if(ifsf_available == 1)
									{
										if(ifsf_status != null) //if ifsf-server is running
										{
											dojo.style("ifsf_ok", {
															  "backgroundImage": "url('../lib/css/images/button_green.png')",
															  "height": "25px",
															  "width": "25px"
															  });
											html.set(dom.byId("ifsf_ok_text"), " Ifsf " + self.online);
											dojo.style("ifsf_ok_text", {"color": "green"});
										}
										else
										{
											dojo.style("ifsf_ok", {
															  "backgroundImage": "url('../lib/css/images/button_red.png')",
															  "height": "25px",
															  "width": "25px"
															  });
											html.set(dom.byId("ifsf_ok_text"), " Ifsf " + self.offline);
											dojo.style("ifsf_ok_text", {"color": "red"});
										}

										if(cw_status != null)  //if cw-server is running
										{
										   dojo.style("cw_ok", {
															  "backgroundImage": "url('../lib/css/images/button_green.png')",
															  "height": "25px",
															  "width": "25px"
															  });
											html.set(dom.byId("cw_ok_text"), " CW " + self.online);
											dojo.style("cw_ok_text", {"color": "green"});
										}
										else
										{
											dojo.style("cw_ok", {
															  "backgroundImage": "url('../lib/css/images/button_red.png')",
															  "height": "25px",
															  "width": "25px"
															  });
											html.set(dom.byId("cw_ok_text"), " CW " + self.offline);
											dojo.style("cw_ok_text", {"color": "red"});
										}
									}
									else // hide everything
									{
										console.log("No ifsf_available...");
									}


									console.log(u_ticker);
									if(uptime_master != old_uptime_master) // if shared mem is ok show green lamp
									{
											console.log("master ",uptime_master,old_uptime_master);
											console.log("slave ",uptime_slave,old_uptime_slave);
											
												if (free_counter < 10)
													free_counter += 1;
												
												
												if (free_counter == 5) // updKHu
												{
													var xhrArgs_sync_lang_test =
													{
														url: "sync_text.php",
														postData: dojo.toJson({data:texts,data32:texts32}),
														handleAs: "text",
														timeout: 14000,
														load: function(data)
														{
															console.log(data);
														}
													}
													var deferred = dojo.xhrPost(xhrArgs_sync_lang_test);
												
													deferred.then(function(data)
													{
														console.log(data);
														if(window.location.search != lang)
															window.location.replace(lang);
													});
													
												}

												if(uptime_slave != old_uptime_slave) // if shared mem fron the second machine is ok
												{
													dojo.style("button_master", {"visibility": "visible"}); // show buttons
													dojo.style("button_slave", {"visibility": "visible"});
													old_uptime_slave = uptime_slave;
												}
												else
												{

													this.xhrArgs_machineSelection =
													{
														url: "save_machine_selection.php/1", // second (slave) is not online. use first one (master)
														handleAs: "text",
														load: function(data)
														{
															if (data)
															{
																var arr = dojo.fromJson(data);
																 console.log(arr.selected_machine);
																  console.log("change to master page");

																	dojo.style("pageTabContainer_tablist_edit_programs",{"display": "block"});
																	dojo.query(".edit_programs").style("visibility", "visible");

																	dojo.style("pageTabContainer_tablist_start_washing",{"display": "block"});
																	dojo.query(".start_washing").style("visibility", "visible");

																	dojo.style("pageTabContainer_tablist_edit_programs",{"display": "block"});
																	dojo.query(".edit_programs").style("visibility", "visible");

																	dojo.style("pageTabContainer_tablist_documents",{"display": "block"});
																	dojo.query(".documents").style("visibility", "visible");

																	dojo.style("pageTabContainer_tablist_admin",{"display": "block"});
																	dojo.query(".admin").style("visibility", "visible");

																	dojo.style("button_master",{"color": "orange"});
																	dojo.style("button_slave",{"color": "lightgray"});
															}
														}
													}
											//	console.log(this.s);
												if(this.s != "hidden")
													var deferred = dojo.xhrGet(this.xhrArgs_machineSelection);


												this.s = dojo.style("button_slave", "visibility");


													dojo.style("button_master", {"visibility": "hidden"}); // hid ebuttons
													dojo.style("button_slave", {"visibility": "hidden"});
												}


										if(u_ticker == old_u_ticker)
										{
											utick_counter++;
											
											if(utick_counter >= 4)
											{
												console.log("utick_counter: "+ utick_counter);
												console.log("Shared mem NOT updated");
												
												dojo.style("shared_mem_ok", {
																  "backgroundImage": "url('../lib/css/images/button_red.png')",
																  "height": "25px",
																  "width": "25px"
																  });
												html.set(dom.byId("shared_mem_ok_text"), " Tammercontrol " + self.offline);
												dojo.style("shared_mem_ok_text", {"color": "red"});
												utick_counter = 0;
											}
										}
										else
										{
										//if sharedmemory is up
											dojo.style("shared_mem_ok", {
														  "backgroundImage": "url('../lib/css/images/button_green.png')",
														  "height": "25px",
														  "width": "25px"
														  });

											html.set(dom.byId("shared_mem_ok_text"), " System " + self.online);
											dojo.style("shared_mem_ok_text", {"color": "green"});
											utick_counter = 0;
										}

										old_uptime_master = uptime_master;
										old_uptime_slave = uptime_slave;
										old_u_ticker = u_ticker;
										counter = 0;
									}
									else // cant open the shared mem -> show red lamp
									{
										if(counter > 9)
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
											
											counter = 0;
										}
										else
											counter ++;

									}

									if(error)
										dojo.byId("header_status").innerHTML = "<span style=color:red>" + error + "</span><br>" +  dojo.byId("header_status").innerHTML;

									var machinename;
									var machine_type =  parseInt(res.machine_type);
							//		alert(res.machinetype);
										switch(machine_type)
											{
												case 1:
													machinename = "T700 Pro HL700";
													html.set(dom.byId("header_image_text"), "T700 Pro HL700");
													break;
												case 2:
													machinename = "T700 Jet HB700";
													html.set(dom.byId("header_image_text"), "T700 Jet HB700");
													break;
												case 3:
													machinename = "T700 Lux HM700";
													html.set(dom.byId("header_image_text"), "T700 Lux HM700");
													break;
												case 4:
													machinename = "T700 Takt HH700";
													html.set(dom.byId("header_image_text"), "T700 Takt HH700");
													break;
												case 5:
													machinename = "T700 Twin 1 HW700";  // if twinmachine, show master and slave buttons
													html.set(dom.byId("header_image_text"), "T700 Twin 1 HW700");
												break;
												case 6:
													machinename = "T700 Twin 2 HW700"; // if twinmachine, show master and slave buttons
													html.set(dom.byId("header_image_text"), "T700 Twin 2 HW700");
												break;
												case 7:
													machinename = "T700 Polish Takt HP700";
													html.set(dom.byId("header_image_text"), "T700 Polish Takt HP700");
													break;
												case 8:
													machinename = "-";
													break;
												case 9:
													machinename = "-";
													break;
												case 10:
													machinename = "-";
													break;
											}

									// get lang for operationmod
									var operation_mode_nro = operation_mode;

									console.log("scanner "+ is_scanner);

									if((operation_mode_nro == 7 || operation_mode_nro == 1) && (res.prog_number >= 1) && (res.prog_number <= 30)) // if operation mode is suspended(pause) or inoperative -> show continue button. Otherwise hide it.
										dojo.style("button_continue", {"visibility": "visible"}); // show only when wash in progress, updKHu
									else
										dojo.style("button_continue", {"visibility": "hidden"});
									
									if ((res.prog_number >= 1) && (res.prog_number <= 30)) // show only when wash in progress, updKHu
									{
										if (operation_mode_nro == 7)
											dojo.style("button_pause", {"visibility": "hidden"});
										else
											dojo.style("button_pause", {"visibility": "visible"});
										dojo.style("button_stop",  {"visibility": "visible"});
									}
									else
									{
										dojo.style("button_pause", {"visibility": "hidden"});
										dojo.style("button_stop", {"visibility": "hidden"});
									}

									if(is_scanner == 1) // if scanner is not configured -> hide it. Otherwise show it.
									{
										dojo.style("scanner_image", {"visibility": "visible"});
										dojo.style("scanner_image2", {"visibility": "visible"});
									}
									else
									{
										dojo.style("scanner_image", {"visibility": "collapse"});
										dojo.style("scanner_image2", {"visibility": "collapse"});
									}


									switch(operation_mode_nro)
									{
										case 1: operation_mode =  resources.operation_mode_1; break;
										case 2: operation_mode =  resources.operation_mode_2; break; // closed
										case 3: operation_mode =  resources.operation_mode_3;        // idle
                                                counters_saved_flag = false;
										break;
										case 4: operation_mode =  resources.operation_mode_4;        // customer entry
                                                counters_saved_flag = false;
										break;
										case 5: operation_mode =  resources.operation_mode_5;        // authorised
                                                counters_saved_flag = false;
										break;
										case 6: operation_mode =  resources.operation_mode_6;        // washing
											if(counters_saved_flag == false)
												read_counters_flag = true;
                                        break;
										case 7: operation_mode =  resources.operation_mode_7;        // suspended washing
                                                counters_saved_flag = false;
										break;
										case 8: operation_mode =  resources.operation_mode_8;        // done washing
                                                counters_saved_flag = false;
										break;
										case 9: operation_mode =  resources.operation_mode_9; break; // maintanance

										default: operation_mode =  resources.operation_mode_0;
                                                read_counters_flag = false;
                                                counters_saved_flag = true;
                                        break;
									}
									console.log("operation_mode: " + operation_mode + "-" + operation_mode_nro + " read_counters_flag: " + read_counters_flag + " counters_saved_flag: " + counters_saved_flag + " prog_line_number: " + prog_line_number + " progNumber: " + self.prog_number);

									if(read_counters_flag && prog_line_number == 2)
									{
									  self.saveCounters(read_counters_flag,self.prog_number);
									  read_counters_flag = false;
									  counters_saved_flag = true;
									}

									if (operation_mode_nro==1) // häiriössä punainen teksti, ja muuttuu vihreäksi kun pesu mahdollista jatkaa, updKHu v1.1
									{
										if ((res.prog_number >= 1) && (res.prog_number <= 30) && (prog_line_number == 0))
											dojo.style("bb_message", {"color": "green", "backgroundColor": "white", "padding": "2px"});
										else
											dojo.style("bb_message", {"color": "red", "backgroundColor": "white", "padding": "2px"});
									}
									else
										dojo.style("bb_message", {"color": "green", "backgroundColor": "white", "padding": "2px"});

									html.set(dom.byId("bb_message"), " " + bb_textline);

									html.set(dom.byId("user"), " " + self.logged_user + " " +machinename);

									console.log("is_maintenance: " + is_maintenance);
									
									html.set(dom.byId("operation_mode"), " " + operation_mode);

									html.set(dom.byId("version"), " " + version_nro);

									if(ifsf_available == 1) // if ifsf is in use, show version number
									{
										html.set(dom.byId("ifsf_version"), " " + ifsf_version);
									}
									else
									{
										dojo.style("ifsf_version_text", {"display": "none"});
									}

									html.set(dom.byId("washing_time"), " " + washingtime_min + " min " + washingtime_sek + " sec"); // show washingtime

									// html.set(dom.byId("line_number"), " " + prog_line_number); Poistettu turhana, updKHu v4.8

									html.set(dom.byId("program_number"), " " + self.prog_number);


								//	console.log("mode",self.slave_mode);

									if(self.slave_mode) // if slave is selected
									{
										html.set(dom.byId("ip"), " " + ip_slave); // show ip

										if(scanner_image_slave != null && ((operation_mode_nro == 6) && (prog_line_number >=2)) ||
											operation_mode_nro == 7 || operation_mode_nro == 8) // show scanned pic only if mode is 6,7,or 8 and it present
										{								   // prog_line_number must be 2 or greater, updKHu 
										/*
										    if(machine_type == 5 || machine_type == 6) // it is twinmachine and master is selected --> show both scanned pictures
											{
												dojo.style("scanner_image2", {
														  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image_slave+"')",
														  "height": "100px",
														  "width": "150px"
														  });
											}
											else
											{
												dojo.style("scanner_image2", {
													  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image_slave+"')",
													  "height": "100px",
													  "width": "300px"
													  });

											}

											dojo.style("scanner_image", {
															  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image+"')",
															  "height": "100px",
															  "width": "150px",
															  "margin-top": "-100px",
															  "visibility": "hidden"
															  });

											//html.set(dom.byId("scanner_image"), "<img src='lib/css/images/ScannedImage/"+scanner_image_slave+"'/>");

											*/
											dojo.style("scanner_image", {
														  "height": "0px",
														  "width": "0px"
														  });

											dojo.style("scanner_image2", {
													  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image_slave+"')",
													  "height": "150px",
													  "width": "400px"
													  });

										}
										else
										{
											//html.set(dom.byId("scanner_image"), "<img src='lib/css/images/not_scanned.jpg'/>");
											dojo.style("scanner_image", {
														  "backgroundImage": "url('lib/css/images/not_scanned.jpg')",
														  "height": "150px",
														  "width": "400px" ,
														  "margin-top": "-150px"
														  });
										}
									}
									else // master is selected
									{
										html.set(dom.byId("ip"), " " + ip_master); // show ip
										if(scanner_image != null && ((operation_mode_nro == 6) && (prog_line_number >=2)) ||
											operation_mode_nro == 7 || operation_mode_nro == 8) // show scanned pic only if mode is 6,7,or 8 and it present
										{								   // prog_line_number must be 2 or greater, updKHu
										/*
											if(machine_type == 5 || machine_type == 6) // it is twinmachine and master is selected --> show both scanned pictures
											{
												dojo.style("scanner_image", {
															  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image+"')",
															  "height": "100px",
															  "width": "150px",
															  "margin-top": "-100px",
															  "visibility": "visible"
															  });

												dojo.style("scanner_image2", {
														  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image_slave+"')",
														  "height": "100px",
														  "width": "151px"
														  });
											}
											else
											{
												dojo.style("scanner_image2", {
														  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image+"')",
														  "height": "100px",
														  "width": "300px"
														  });

											}
											//html.set(dom.byId("scanner_image"), "<img src='lib/css/images/ScannedImage/"+scanner_image+"'/>");

										*/
											dojo.style("scanner_image", {
														  "height": "0px",
														  "width": "0px"
														  });


											dojo.style("scanner_image2", {
														  "backgroundImage": "url('lib/css/images/ScannedImage/"+scanner_image+"')",
														  "height": "150px",
														  "width": "400px"
														  });
										}
										else
										{
										//	html.set(dom.byId("scanner_image"), "<img src='lib/css/images/not_scanned.jpg'/>");
											dojo.style("scanner_image", {
														  "backgroundImage": "url('lib/css/images/not_scanned.jpg')",
														  "height": "150px",
														  "width": "400px",
														  "margin-top": "-150px"
														  });
										}
									}

								//	var x = document.getElementById("test").src = "lib/css/images/ScannedImage/"+scanner_image;


									if(arr != null)
									{
										self.ProgramLineStore = new Memory({data:[]});

										for(var i=0; i < arr.length; i++)
										{
											self.ProgramLineStore.put(arr[i]);
										}

										//self.running_wash_grid.refresh();
										//self.running_wash_grid.select(prog_line_number); // show row highlighted
									}
									if(self.prog_number > 0) // if prognumber is set -> show grid
									{
										self.running_wash_grid.store = self.ProgramLineStore;
										self.running_wash_grid.refresh();
										self.running_wash_grid.select(prog_line_number); // show row highlighted
									}

								}
							//	console.log(prog_number);
							}
						};


						// store for langs
						langStore = new Cache(new JsonRest({target:"get_langs.php"}), new Memory()); // get available langs
					//	console.log("luettu",lang);
						var comboBox = new ComboBox(
						{
						 //   id: "PdfSelect",
							name: "lang",
							value: "Lang",
							store: langStore,
							searchAttr: "name",
							onChange: function()
							{

							 var xhrArgs =
									{
									 url: "save_lang.php",
									 postData: dojo.toJson({lang:comboBox.value}),
								     handleAs: "text",
									 load: function(data)
									  {
										console.log("message posted....");
										window.location.replace("?"+comboBox.value);
									  },
									  error: function(error)
									  {
											console.log("message posted.... error");
									  }
									};
										console.log("message being sent....");
									// Call the asynchronous xhrPost
									var deferred = dojo.xhrPost(xhrArgs);
							},
						}, "lang_selection");


						// colums for running_wash_grid
						 var columns_wash_program = [
						 {label:resources.id, field:"id",sortable:false},
						// {label:"<= =>", field:"Direction"},
						 {label:resources.main_prog, get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdMain);
										}
						 },
						 {label:resources.cmr, field:"Cmr_MainProgram",sortable:false},
						 {label:resources.pass, field:"PassStyle",sortable:false},
						 {label:resources.side_prog1, get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdSide1);
										}
						  },

						  {label:resources.cmr, field:"Cmr_SideProgram1",sortable:false},
						  {label:resources.side_prog2,  get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdSide2);
										}
						  },
						  {label:resources.cmr, field:"Cmr_SideProgram2",sortable:false},
						  {label:resources.side_prog3,  get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdSide3);
										}
						  },
						  {label:resources.cmr, field:"Cmr_SideProgram3",sortable:false},
						  {label:resources.side_prog4,  get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdSide4);
										}
						  },
						  {label:resources.cmr, field:"Cmr_SideProgram4",sortable:false},
						  {label:resources.side_prog5,  get: function(object)
										{
											return self.ls.SetLangByLangId(object.LangIdSide5);
										}
						  },
						  {label:resources.cmr, field:"Cmr_SideProgram5",sortable:false},
						  {label:resources.speed, field:"Speed_MainProgram",sortable:false}

					];


					// Create grid for running washprogram
					 this.running_wash_grid = new (declare([Grid, Selection]))({
						  store: this.ProgramLineStore,
						  columns: columns_wash_program,
						  selectionMode: "single"
					  }, "grid_running_work");

					dojo.xhrGet(xhrArgs);
				},
				allowCommands: function()
				{
						this.xhrArgs_get_ifsf_data =
								{
									url: "get_ifsf_data.php",
									handleAs: "text",
									load: function(data)
									{
										if (data)
										{
											var arr = dojo.fromJson(data);
											self.mode = arr.ifsf;
											self.maintenance = arr.maintenance;
											self.op_mode = arr.operation_mode;
											self.allow_continue_cancel = arr.allow_continue_cancel;
											console.log("---"+self.mode+" "+self.maintenance+"---"+self.allow_continue_cancel+"---");
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_get_ifsf_data);
								deferred.then(function(data)
									{
										if(self.mode == 1 && self.maintenance == 0 && self.allow_continue_cancel == 0 && self.op_mode != 7) // ifsf mode is set -> disable button
										{
											dojo.style("button_pause", {
														  "backgroundImage": "url('../lib/css/images/button_pause_gray_dis.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "not-allowed"
														  });
											dojo.style("button_stop", {
														  "backgroundImage": "url('../lib/css/images/button_stop_gray_dis.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "not-allowed"
														  });
											dojo.style("button_continue", {
														  "backgroundImage": "url('../lib/css/images/button_continue_gray_dis.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "not-allowed"
														  });
										}
										else if(self.mode == 1 && self.maintenance == 1 || self.allow_continue_cancel == 1 || self.op_mode == 7) // enable
										{
											dojo.style("button_pause", {
														  "backgroundImage": "url('../lib/css/images/button_pause_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
											dojo.style("button_stop", {
														  "backgroundImage": "url('../lib/css/images/button_stop_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
											dojo.style("button_continue", {
														  "backgroundImage": "url('../lib/css/images/button_continue_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
										}
										else
										{
											dojo.style("button_pause", {
														  "backgroundImage": "url('../lib/css/images/button_pause_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
											dojo.style("button_stop", {
														  "backgroundImage": "url('../lib/css/images/button_stop_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
											dojo.style("button_continue", {
														  "backgroundImage": "url('../lib/css/images/button_continue_gray.png')",
														  "height": "50px",
														  "width": "50px",
														  "cursor": "pointer"
														  });
										}
									});
				},
				 saveCounters: function(flag, prog_nro)
                {
					console.log("Lipun tila:" ,flag,prog_nro);
					if(flag)
					{
						var xhrArgs =
						{
							url: "save_counters_data.php",
							postData: dojo.toJson({prognumber:prog_nro}),
							handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);
						deferred.then(function(value)
							  {
								console.log("tallenna laskurit mode 8 öö");
								console.log("prognumber:",prog_nro);

							  }, function(err)
							  {
								console.log(err);
							  });
					}
				//	 this.read_counters_flag = false;

				},
				 command: function(command)
                {
						console.log("command",command);

						switch(command)
						{
						  case "continue_prog":
						   console.log("self.op_mode ", self.op_mode);
						   if(self.mode == 1 && self.maintenance == 0 && self.allow_continue_cancel == 0 && self.op_mode != 7)
						   {
							   alert("Manual continue is not allowed when IFSF is activated.");
							   return;
						   }

							var c = confirm("Continue program: " +this.prog_number + " ?");
								if(c)
								{

								// vain customer entry tilassa saa käynnistää tee tarkastelu
									if(this.prog_number > 0) // program number is set
									{
										// check what is the current operation mode

									var xhrArgs_get_operation_state =
									{
										url: "run_command.php/get_operation_state",
										handleAs: "text",
										load: function(data)
										{
											if (data)
											{
												var arr = dojo.fromJson(data);
												console.log(arr.operation_mode_master);
												if(arr.operation_mode_master != null)
												{

													if(arr.operation_mode_master) // opeation mode is customer entry -> allow start
													{
														var xhrArgs =
															{
																url: "run_command.php",
																postData: dojo.toJson({run_command:command, prog_number:self.SelectedButton}),
																handleAs: "text"
															};
																var deferred = dojo.xhrPost(xhrArgs);
													}
													else // give error popup
													{

														switch(arr.operation_mode_master)
														{
															case 1:operation_mode =  resources.operation_mode_1;break;
															case 2:operation_mode =  resources.operation_mode_2;break;
															case 3:operation_mode =  resources.operation_mode_3;break;
															case 4:operation_mode =  resources.operation_mode_4;break;
															case 5:operation_mode =  resources.operation_mode_5;break;
															case 6:operation_mode =  resources.operation_mode_6;break;
															case 7:operation_mode =  resources.operation_mode_7;break;
															case 8:operation_mode =  resources.operation_mode_8;break;
															case 9:operation_mode =  resources.operation_mode_9;break;
														//	default:operation_mode =  resources.operation_mode_0;break;
														}

															alert("Wrong operation mode: "+operation_mode);

													}
												}
											}
										}
									};
									var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
									}
									else
										alert("Illegal number undefined..")
								}
							break;
							case "stop":
						    if(self.mode == 1 && self.maintenance == 0 && self.allow_continue_cancel == 0 && self.op_mode != 7)
						    {
							   alert("Manual stop is not allowed when IFSF is activated.");
							   return;
						    }
							var c = confirm("Stop program: " +this.prog_number + " ?");
								if(c)
								{
									var xhrArgs =
									{
									url: "run_command.php",
									postData: dojo.toJson({run_command:command, type:"twin"}),
									handleAs: "text"
									};
									var deferred = dojo.xhrPost(xhrArgs);

								}
							break;
							case "pause":

						    if(self.mode == 1 && self.maintenance == 0 && self.allow_continue_cancel == 0 && self.op_mode != 7)
						    {
							   alert("Manual pause is not allowed when IFSF is activated.");
							   return;
						    }

							var c = confirm("Pause program: " +this.prog_number + " ?");
								if(c)
								{
									var xhrArgs =
									{
									url: "run_command.php",
									postData: dojo.toJson({run_command:command, type:"twin"}),
									handleAs: "text"
									};
									var deferred = dojo.xhrPost(xhrArgs);
								}
							break;

							case "master": // show everything
							console.log("change to master page ",this.logged_user);
							this.slave_mode = false;

							this.xhrArgs_machineSelection =
								{
									url: "save_machine_selection.php/1",
									handleAs: "text",
									load: function(data)
									{
										if (data)
										{
											var arr = dojo.fromJson(data);
											 console.log(arr.selected_machine);
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_machineSelection);

								if(this.logged_user != "Wap" && this.logged_user != "Chain")
								{
									dojo.style("pageTabContainer_tablist_start_washing",{"display": "block"});
									dojo.query(".start_washing").style("visibility", "visible");
									
									dojo.style("pageTabContainer_tablist_edit_programs",{"display": "block"});
									dojo.query(".edit_programs").style("visibility", "visible");
									
									dojo.style("pageTabContainer_tablist_documents",{"display": "block"});
									dojo.query(".documents").style("visibility", "visible");
								}
/*
								if(this.logged_user != "Chain" && this.logged_user != "Wap")
								{
									dojo.style("pageTabContainer_tablist_edit_programs",{"display": "block"});
									dojo.query(".edit_programs").style("visibility", "visible");
								}
*/
								

								if(this.logged_user == "Admin")
								{
									dojo.style("pageTabContainer_tablist_admin",{"display": "block"});
									dojo.query(".admin").style("visibility", "visible");
								}

								dojo.style("button_master",{"color": "orange"});
								dojo.style("button_slave",{"color": "lightgray"});
							break;

							case "slave": // hide some pages and buttons
							console.log("change to slave page",this.logged_user, this.machinetype);
							this.slave_mode = true;


							this.xhrArgs_machineSelection =
								{
									url: "save_machine_selection.php/2",
									handleAs: "text",
									load: function(data)
									{
										if (data)
										{
											var arr = dojo.fromJson(data);
											 console.log("selected machine ",arr.selected_machine);
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_machineSelection);


								if(this.machinetype == 5 || this.machinetype == 6) // jos twinikone käytössä rajoitetaan valikkonäkyvyyttä, muuten näytetään kaikki
								{
									if(this.logged_user != "Wap")
									{
										dojo.style("pageTabContainer_tablist_start_washing",{"display": "none"});
										dojo.style("pageTabContainer_tablist_start_washing",{"margin-left": "-8px"});
										dojo.query(".start_washing").style("visibility", "hidden");
									}
									if(this.logged_user != "Chain" && this.logged_user != "Wap")
									{
										dojo.style("pageTabContainer_tablist_edit_programs",{"display": "none"});
										dojo.query(".edit_programs").style("visibility", "hidden");
									}

									dojo.style("pageTabContainer_tablist_documents",{"display": "none"});
									dojo.query(".documents").style("visibility", "hidden");

									if(this.logged_user == "Admin")
									{
										dojo.style("pageTabContainer_tablist_admin",{"display": "none"});
										dojo.query(".admin").style("visibility", "hidden");
									}
								}

								dojo.style("button_slave",{"color": "orange"});
								dojo.style("button_master",{"color": "lightgray"});

							//	window.location.assign(window.location);

							break;
						}

                }

        });
    });
