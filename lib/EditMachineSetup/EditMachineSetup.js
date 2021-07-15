require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/EditMachineSetup/templates/EditMachineSetup.html",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/i18n!./lib/nls/resources.js",
		"dijit/registry",
		"dojo/dom",
		"dojo/html",
		"dijit/form/ComboBox",
		"dojo/store/Cache",
		"dojo/store/JsonRest",
		"dojo/store/Memory",
		"dijit/form/CheckBox",
		"dijit/form/Form",
		"dojox/form/Uploader",
		"dojox/form/uploader/FileList",
		"dojo/parser",
		"dojox/charting/axis2d/Default",
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, theme, xhr,resources,registry,dom,html,ComboBox,Cache,JsonRest,Memory,CheckBox)
		{
			return  declare("EditMachineSetup", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin],
			{

				templateString: template,
				machine_setup: resources.machine_setup,
				machine_type: resources.machine_type,
				brush_machine: resources.brush_machine,
				kp_machine: resources.kp_machine,
				combi_machine: resources.combi_machine,
				drying_machine: resources.drying_machine,
				brush_duo_master: resources.brush_duo_master,
				brush_duo_slave: resources.brush_duo_slave,
				kp_duo_master: resources.kp_duo_master,
				kp_duo_slave: resources.kp_duo_slave,
				combi_duo_master: resources.combi_duo_master,
				combi_duo_slave: resources.combi_duo_slave,

				bay_type : resources.bay_type,
				door_control: resources.door_control,
				door_function : resources.door_function,
				wax_type : resources.wax_type,
				foam_type : resources.foam_type,

				not_in_use : resources.not_in_use,
				drive_thru : resources.drive_thru,
				contact_signal : resources.contact_signal,
				normal : resources.normal,
				cold: resources.cold,
				reversing_backwards : resources.reversing_backwards,
				pulse: resources.pulse,
				ventilation : resources.ventilation,
				hot: resources.hot,
				rain: resources.rain,
				lava: resources.lava,
				open_both : resources.open_both,

				chassis_wash : resources.chassis_wash,
				wheel_wash : resources.wheel_wash,
				prewash2 : resources.prewash2,
				van_nozzles : resources.van_nozzles,
				ro_water : resources.ro_water,
				wheel_brush : resources.wheel_brush,
				buffing_wax : resources.buffing_wax,
				wheel_prewash : resources.wheel_prewash,
				tyre_shiner : resources.tyre_shiner,
				opt_scanner : resources.opt_scanner,

				air_wax : resources.air_wax,
				biojet_in_use : resources.biojet_in_use,
				drive_in_prewash : resources.drive_in_prewash,
				option1 : resources.option1,
				option2 : resources.option2,
				option3 : resources.option3,
				option4 : resources.option4,
				option5 : resources.option5,
				option6 : resources.option6,
				option7 : resources.option7,
				option8 : resources.option8,
				option9 : resources.option9,
				option10 : resources.option10,
				option11 : resources.option11,
				option12 : resources.option12,

				save_setup: resources.save_setup,
				use_setup : resources.use_setup,

				email_settings : resources.email_settings,
				station_data : resources.station_data,
				to : resources.to,
				to2 : resources.to2,
				to3 : resources.to3,
				cc : resources.cc,
				cc2 : resources.cc2,
				cc3 : resources.cc3,
				save_email_settins : resources.save_email_settins,

				export_database: resources.export_database,
				import_database: resources.import_database,
				load_pdf: resources.load_pdf,
				load_set: resources.load_set,
				select_lang_folder: resources.select_lang_folder,

				export_database_button: resources.export_database_button,
				select_sql_file_button: resources.select_sql_file_button,
				import_sql_file_button: resources.import_sql_file_button,
				select_pdf_button: resources.select_pdf_button,
				upload_selected_pdf_button: resources.upload_selected_pdf_button,
				select_set_button: resources.select_set_button,
				upload_selected_set_button: resources.upload_selected_set_button,
				set_password: resources.set_password,
				save_password: resources.save_password,
				save_pumps: resources.save_pumps,
				set_pumps: resources.set_pumps,
				save_deiceseqs: resources.save_deiceseqs,
				set_deiceseqs: resources.set_deiceseqs,
				password_disabled: resources.password_disabled,
				select_io_cards_to_show: resources.select_io_cards_to_show,
				save_selections: resources.save_selections,

				input_1: resources.input_1,
				input_2: resources.input_2,
				input_3: resources.input_3,
				input_4: resources.input_4,
				input_5: resources.input_5,
				input_6: resources.input_6,

				output_1: resources.output_1,
				output_2: resources.output_2,
				output_3: resources.output_3,
				output_4: resources.output_4,
				output_5: resources.output_5,
				output_6: resources.output_6,

				weekly:resources.weekly,
				monthly:resources.monthly,
				washcounters_conf:resources.washcounters_conf,
				save_setup:resources.save_setup,
				send_washcounts:resources.send_washcounts,
				save_washcounts_to_db:resources.save_washcounts_to_db,

				postCreate: function()
				{
				this.inherited(arguments);
				var self = this;
				var mode;


					var xhrArgs_username =
					{
						url: "get_username.php/",
						handleAs: "text",
						load: function(data)
						{
							if (data)
							{
								var arr = dojo.fromJson(data);


								if(arr.logged_user == "Operator" || arr.logged_user == "Chain" || arr.logged_user == "Wap") // dont show pinncode, functions and database information
								{
										//console.log(arr.logged_user);

										dojo.setAttr("station_data", "disabled", "disabled");

										dojo.style("widget_station_data", {
												  "border": "none"
												  });

										dojo.style("email_to_row", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("email_to2_row", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("email_to3_row", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("select_cards", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
								}
								if(arr.logged_user == "Importer" || arr.logged_user == "Operator" || arr.logged_user == "Chain" || arr.logged_user == "Wap") // dont show functions and database information
								{
										//console.log(arr.logged_user);
										dojo.setAttr("station_data", "disabled", "disabled");

										dojo.style("widget_station_data", {
												  "border": "none"
												  });

										dojo.style("hidable_content", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("hidable_content2", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("pdf_upload", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
								}
								if(arr.logged_user == "Chain" ) // dont show functions and database information
								{
										dojo.style("set_password", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("bay_parameters", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("button_save_conf_types", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
										dojo.style("set_upload", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
								}
								if(arr.logged_user == "Wap" ) // dont show functions and database information
								{

										dojo.style("set_upload", {
												  "visibility": "hidden",
												  "height": "0px",
												  "overflow": "hidden"
												  });
								}
							}
						},
						error: function(error)
						{
							console.log("error",error)
						}
					}
					var deferred = dojo.xhrGet(xhrArgs_username);

						var tabs = registry.byId("pageTabContainer");

						tabs.watch("selectedChildWidget", function(name, oval, nval)
						{
							if(nval.id == "edit_machineSetup")
							{
								var xhrArgs_machinesetupdata =
								{
								url: "save_machine_setup_data.php",
								handleAs: "text",
								timeout: 5000,
								load: function(data)
								{
									if (data)
									{
										var res = dojo.fromJson(data);
										console.log(res);
										var machine_type =  parseInt(res.machine_type);
										self.mode = parseInt(res.operation_mode);
										console.log("mode: ", self.mode);
										dojo.byId("washcounters_result").innerHTML = " ";
											
										var email_interval = parseInt(res.email_interval);
										switch(email_interval)
										{
											case 0: dijit.byId("weekly").set('checked', true); break;
											case 1: dijit.byId("monthly").set('checked', true); break;
										}
									
										switch(machine_type)
											{
												case 1: dijit.byId("harjakone").set('checked', true); break;
												case 2: dijit.byId("kp_kone").set('checked', true); break;
												case 3: dijit.byId("combikone").set('checked', true); break;
												case 4: dijit.byId("kuivaajakone").set('checked', true); break;
												case 5: dijit.byId("harjaduomaster").set('checked', true); break;
												case 6: dijit.byId("harjaduoslave").set('checked', true); break;
												case 7: dijit.byId("kpduomaster").set('checked', true); break;
												case 8: dijit.byId("kppduoslave").set('checked', true); break;
												case 9: dijit.byId("combiduomaster").set('checked', true); break;
												case 10: dijit.byId("combiduoslave").set('checked', true); break;
											}


										var bay_type = parseInt(res.bay_type);
										switch(bay_type)
										{
											case -1: dijit.byId("bay_notinuse").set('checked', true); break;
											case 1: dijit.byId("bay_drivethru").set('checked', true); break;
											case 0: dijit.byId("bay_reversing").set('checked', true); break;
										}

										var door_control =  parseInt(res.door_control);
										switch(door_control)
										{
											case -1: dijit.byId("doorc_notinuse").set('checked', true); break;
											case 0: dijit.byId("doorc_contactsignal").set('checked', true); break;
											case 1: dijit.byId("doorc_pulse").set('checked', true); break;
										}

										var door_function =  parseInt(res.door_function);
										switch(door_function)
										{
											case -1: dijit.byId("doorf_notinuse").set('checked', true); break;
											case 0: dijit.byId("doorf_normal").set('checked', true); break;
											case 2: dijit.byId("doorf_ventilation").set('checked', true); break;
											case 1: dijit.byId("doorf_openboth").set('checked', true); break;
										}

										var wax_type =  parseInt(res.wax_type);
										switch(wax_type)
										{
											case -1: dijit.byId("wax_notinuse").set('checked', true); break;
											case 0: dijit.byId("wax_cold").set('checked', true); break;
											case 1: dijit.byId("wax_hot").set('checked', true); break;
										}
										
										var foam_type =  parseInt(res.foam_type);
										switch(foam_type)
										{
											case -1: dijit.byId("foam_notinuse").set('checked', true); break;
											case 0: dijit.byId("foam_lava").set('checked', true); break;
											case 1: dijit.byId("foam_rain").set('checked', true); break;
										}

										var sum_of_pumps = parseInt(res.sum_of_pumps);
										switch(sum_of_pumps)
											{
												case 1: dijit.byId("pump1").set('checked', true); break;
												case 2: dijit.byId("pump2").set('checked', true); break;
												case 3: dijit.byId("pump3").set('checked', true); break;
												case 4: dijit.byId("pump4").set('checked', true); break;
											}

										var sum_of_deiceseqs = parseInt(res.sum_of_deiceseqs);
										switch(sum_of_deiceseqs)
											{
												case 1: dijit.byId("deiceseqs1").set('checked', true); break;
												case 2: dijit.byId("deiceseqs2").set('checked', true); break;
												case 3: dijit.byId("deiceseqs3").set('checked', true); break;
												case 4: dijit.byId("deiceseqs4").set('checked', true); break;
											}

										var chassis_wash = parseInt(res.chassis_wash);
										var wheel_wash = parseInt(res.wheel_wash);
										var prewash_2 = parseInt(res.prewash_2);
										var van_nozzles = parseInt(res.van_nozzles);
										var ro_water = parseInt(res.ro_water);
										var wheel_brush = parseInt(res.wheel_brush);
										var buffing_wax = parseInt(res.buffing_wax);
										var chassis_wash = parseInt(res.chassis_wash);
										var wheel_prewash = parseInt(res.wheel_prewash);
										var tyre_shiner = parseInt(res.tyre_shiner);
										var opt_scanner = parseInt(res.opt_scanner);

										var biojet_in_use = parseInt(res.biojet_in_use);
										var drive_in_prewash = parseInt(res.drive_in_prewash);
										var air_wax = parseInt(res.air_wax);
										var option1 = parseInt(res.option1);
										var option2 = parseInt(res.option2);
										var option3 = parseInt(res.option3);
										var option4 = parseInt(res.option4);
										var option5 = parseInt(res.option5);
										var option6 = parseInt(res.option6);
										var option7 = parseInt(res.option7);
										var option8 = parseInt(res.option8);
										var option9 = parseInt(res.option9);
										var option10 = parseInt(res.option10);
										var option11 = parseInt(res.option11);
										var option12 = parseInt(res.option12);

										if(chassis_wash == 1)
											dijit.byId("chassis_wash").set('checked', true);
										else
											dijit.byId("chassis_wash").set('checked', false);

										if(wheel_wash == 1)
											dijit.byId("wheel_wash").set('checked', true);
										else
											dijit.byId("wheel_wash").set('checked', false);

										if(prewash_2 == 1)
											dijit.byId("prewash_2").set('checked', true);
										else
											dijit.byId("prewash_2").set('checked', false);

										if(van_nozzles == 1)
											dijit.byId("van_nozzles").set('checked', true);
										else
											dijit.byId("van_nozzles").set('checked', false);

										if(ro_water == 1)
											dijit.byId("ro_water").set('checked', true);
										else
											dijit.byId("ro_water").set('checked', false);

										if(wheel_brush == 1)
											dijit.byId("wheel_brush").set('checked', true);
										else
											dijit.byId("wheel_brush").set('checked', false);

										if(buffing_wax == 1)
											dijit.byId("buffing_wax").set('checked', true);
										else
											dijit.byId("buffing_wax").set('checked', false);

										if(chassis_wash == 1)
											dijit.byId("chassis_wash").set('checked', true);
										else
											dijit.byId("chassis_wash").set('checked', false);

										if(wheel_prewash == 1)
											dijit.byId("wheel_prewash").set('checked', true);
										else
											dijit.byId("wheel_prewash").set('checked', false);

										if(tyre_shiner == 1)
											dijit.byId("tyre_shiner").set('checked', true);
										else
											dijit.byId("tyre_shiner").set('checked', false);

										if(opt_scanner == 1)
											dijit.byId("opt_scanner").set('checked', true);
										else
											dijit.byId("opt_scanner").set('checked', false);

										if(biojet_in_use == 1)
											dijit.byId("biojet_in_use").set('checked', true);
										else
											dijit.byId("biojet_in_use").set('checked', false);

										if(air_wax == 1)
											dijit.byId("air_wax").set('checked', true);
										else
											dijit.byId("air_wax").set('checked', false);

										if(option1 == 1)
											dijit.byId("option1").set('checked', true);
										else
											dijit.byId("option1").set('checked', false);

										if(option2 == 1)
											dijit.byId("option2").set('checked', true);
										else
											dijit.byId("option2").set('checked', false);

										if(option3 == 1)
											dijit.byId("option3").set('checked', true);
										else
											dijit.byId("option3").set('checked', false);

										if(option4 == 1)
											dijit.byId("option4").set('checked', true);
										else
											dijit.byId("option4").set('checked', false);

										if(option5 == 1)
											dijit.byId("option5").set('checked', true);
										else
											dijit.byId("option5").set('checked', false);

										if(option6 == 1)
											dijit.byId("option6").set('checked', true);
										else
											dijit.byId("option6").set('checked', false);

										if(option7 == 1)
											dijit.byId("option7").set('checked', true);
										else
											dijit.byId("option7").set('checked', false);

										if(option8 == 1)
											dijit.byId("option8").set('checked', true);
										else
											dijit.byId("option8").set('checked', false);

										if(option9 == 1)
											dijit.byId("option9").set('checked', true);
										else
											dijit.byId("option9").set('checked', false);

										if(option10 == 1)
											dijit.byId("option10").set('checked', true);
										else
											dijit.byId("option10").set('checked', false);

										if(option11 == 1)
											dijit.byId("option11").set('checked', true);
										else
											dijit.byId("option11").set('checked', false);

										if(option12 == 1)
											dijit.byId("option12").set('checked', true);
										else
											dijit.byId("option12").set('checked', false);


										if(drive_in_prewash == 1)
											dijit.byId("drive_in_prewash").set('checked', true);
										else
											dijit.byId("drive_in_prewash").set('checked', false);
									}
								},
								error: function(error)
								{
									console.log(error);
								}
								};

							var deferred = dojo.xhrGet(xhrArgs_machinesetupdata);
							var deferred = dojo.xhrGet(self.xhrArgs_email_settings); // get email-data
							}

						});

					pdfLangStore = new Cache(new JsonRest({target:"get_pdf_langs.php"}), new Memory()); // get available langs
					var comboBox = new ComboBox(
					{
					 //   id: "PdfSelect",
						name: "lang",
						value: "English",
						store: pdfLangStore,
						searchAttr: "name",
						onChange: function()
						{
							dojo.byId("selected_lang").value = comboBox.value;
						},
					}, "lang_pdf_selection");


					dojo.connect(this.button_save_pass, "onclick", null, function() {self.save_pass(self); });
					this.Password = registry.byId("password");

					this.xhrArgs_get_pass =
					{
						url: "compare_passwords.php",
						handleAs: "text",
						load: function(data)
						{
							if (data)
							{
								var arr = dojo.fromJson(data);
								self.Password.set("value", arr.pass);

							}
						},
						error: function(error)
						{
							console.log("error",error);
						}
					}
					var deferred = dojo.xhrGet(this.xhrArgs_get_pass);



					dojo.connect(this.button_save_email_settings, "onclick", null, function() { self.save_email_settings(self); });
					dojo.connect(this.button_send_washcounters, "onclick", null, function() { self.send_washcounters(self); });
					dojo.connect(this.button_save_washcounters_conf, "onclick", null, function() { self.save_washcounters_conf(self); });
					dojo.connect(this.button_sync_washcounters, "onclick", null, function() { self.sync_washcounters(self); });
					
					this.Washcounters_result = registry.byId("washcounters_result");

					this.StationData = registry.byId("station_data");
					this.EmailCc = registry.byId("email_cc");
					this.EmailTo = registry.byId("email_to");

					this.EmailCc2 = registry.byId("email_cc2");
					this.EmailTo2 = registry.byId("email_to2");

					this.EmailCc3 = registry.byId("email_cc3");
					this.EmailTo3 = registry.byId("email_to3");

				
					
						this.xhrArgs_email_settings =
						{
							url: "Manage_accounts.php",
							handleAs: "text",
							load: function(data)
							{
								if (data)
								{
									var arr = dojo.fromJson(data);
								//	console.log(arr.station_data, arr.station_data.length, arr.station_data.indexOf("*"), arr.station_data.substr(0,arr.station_data.indexOf("*")));
									self.StationData.set("value", arr.station_data.substr(0,arr.station_data.indexOf("*")-1));
									self.EmailCc.set("value",  arr.email_cc.substr(0,arr.email_cc.indexOf("*")-1));
									self.EmailTo.set("value",  arr.email_to.substr(0,arr.email_to.indexOf("*")-1));

									self.EmailCc2.set("value",  arr.email_cc2.substr(0,arr.email_cc2.indexOf("*")-1));
									self.EmailTo2.set("value",  arr.email_to2.substr(0,arr.email_to2.indexOf("*")-1));

									self.EmailCc3.set("value", arr.email_cc3.substr(0,arr.email_cc3.indexOf("*")-1));
									self.EmailTo3.set("value", arr.email_to3.substr(0,arr.email_to3.indexOf("*")-1));

								//	console.log("email data: ", arr);
								}

							}

						}
						var deferred = dojo.xhrGet(this.xhrArgs_email_settings);

						// ip camera registrys
						this.camera_ip = registry.byId("camera_ip");
						this.camera_port = registry.byId("camera_port");
						this.camera_quality = registry.byId("camera_quality");
						this.camera_fps = registry.byId("camera_fps");
						this.camera_width = registry.byId("camera_width");
						this.camera_height = registry.byId("camera_height");

						// get camera settings
						this.xhrArgs_camera_settings =
						{
							url: "manage_camera.php",
							handleAs: "text",
							load: function(data)
							{
								if (data)
								{
									var arr = dojo.fromJson(data);
									//console.log("camera data: ", arr[0]);

									var camera_status = parseInt(arr[0].camera_status);
									switch(camera_status)
									{
										case 1: dijit.byId("camera_on").set('checked', true); break;
										case 0: dijit.byId("camera_off").set('checked', true); break;
									}

									//var camera_status = SaveIpcameraConf.getValues().camera_status;
									self.camera_ip.set("value",  arr[0].camera_ip);
									self.camera_port.set("value",  arr[0].camera_port);
									self.camera_quality.set("value",  arr[0].camera_quality);
									self.camera_fps.set("value",   arr[0].camera_fps);
									self.camera_width.set("value",  arr[0].camera_width);
									self.camera_height.set("value",  arr[0].camera_height);
								}
							}
						}
						var deferred = dojo.xhrGet(this.xhrArgs_camera_settings);


				var myUploader = new dojox.form.Uploader({label:"Programmatic Uploader", multiple:true, uploadOnSelect:true, url:"UploadFile.php"});

			//		dojo.byId("myDiv").appendChild(myUploader.domNode);

				var list = new dojox.form.uploader.FileList({uploader:myUploader});

			//		dojo.byId("myDiv2").appendChild(list.domNode);

				dojo.connect(this.button_save_conf_types, "onclick", null, function() { self.save_conf_types(); });
				dojo.connect(this.button_save_conf_functions, "onclick", null, function() { self.save_conf_functions(self); });
				dojo.connect(this.button_save_ipconf, "onclick", null, function() { self.use_ip_conf(self); });
				dojo.connect(this.button_save_selections, "onclick", null, function() { self.Save_selections(); });

				xhrArgs =
						{
							url: "save_machine_setup_data.php",
							handleAs: "text",
							timeout: 5000,
							load: function(data)
							{
								if (data)
								{
									var res = dojo.fromJson(data);
							//		console.log(res);
									var machine_type =  parseInt(res.machine_type);
									switch(machine_type)
										{
											case 1: dijit.byId("harjakone").set('checked', true); break;
											case 2: dijit.byId("kp_kone").set('checked', true); break;
											case 3: dijit.byId("combikone").set('checked', true); break;
											case 4: dijit.byId("kuivaajakone").set('checked', true); break;
											case 5: dijit.byId("harjaduomaster").set('checked', true); break;
											case 6: dijit.byId("harjaduoslave").set('checked', true); break;
											case 7: dijit.byId("kpduomaster").set('checked', true); break;
											case 8: dijit.byId("kppduoslave").set('checked', true); break;
											case 9: dijit.byId("combiduomaster").set('checked', true); break;
											case 10: dijit.byId("combiduoslave").set('checked', true); break;
										}


									var bay_type = parseInt(res.bay_type);
									switch(bay_type)
									{
										case -1: dijit.byId("bay_notinuse").set('checked', true); break;
										case 1: dijit.byId("bay_drivethru").set('checked', true); break;
										case 0: dijit.byId("bay_reversing").set('checked', true); break;
									}

									var door_control =  parseInt(res.door_control);

									switch(door_control)
									{
										case -1: dijit.byId("doorc_notinuse").set('checked', true); break;
										case 0: dijit.byId("doorc_contactsignal").set('checked', true); break;
										case 1: dijit.byId("doorc_pulse").set('checked', true); break;
									}
									var door_function =  parseInt(res.door_function);
									switch(door_function)
									{
										case -1: dijit.byId("doorf_notinuse").set('checked', true); break;
										case 0: dijit.byId("doorf_normal").set('checked', true); break;
										case 2: dijit.byId("doorf_ventilation").set('checked', true); break;
										case 1: dijit.byId("doorf_openboth").set('checked', true); break;
									}
									var wax_type =  parseInt(res.wax_type);
									switch(wax_type)
									{
										case -1: dijit.byId("wax_notinuse").set('checked', true); break;
										case 0: dijit.byId("wax_cold").set('checked', true); break;
										case 1: dijit.byId("wax_hot").set('checked', true); break;
									}

									var sum_of_pumps = parseInt(res.sum_of_pumps);
									switch(sum_of_pumps)
									{
										case 1: dijit.byId("pump1").set('checked', true); break;
										case 2: dijit.byId("pump2").set('checked', true); break;
										case 3: dijit.byId("pump3").set('checked', true); break;
										case 4: dijit.byId("pump4").set('checked', true); break;
									}

									var sum_of_deiceseqs = parseInt(res.sum_of_deiceseqs);
									switch(sum_of_deiceseqs)
									{
										case 1: dijit.byId("deiceseqs1").set('checked', true); break;
										case 2: dijit.byId("deiceseqs2").set('checked', true); break;
										case 3: dijit.byId("deiceseqs3").set('checked', true); break;
										case 4: dijit.byId("deiceseqs4").set('checked', true); break;
									}

									var chassis_wash = parseInt(res.chassis_wash);
									var wheel_wash = parseInt(res.wheel_wash);
									var prewash_2 = parseInt(res.prewash_2);
									var van_nozzles = parseInt(res.van_nozzles);
									var ro_water = parseInt(res.ro_water);
									var wheel_brush = parseInt(res.wheel_brush);
									var buffing_wax = parseInt(res.buffing_wax);
									var chassis_wash = parseInt(res.chassis_wash);
									var wheel_prewash = parseInt(res.wheel_prewash);
									var tyre_shiner = parseInt(res.tyre_shiner);
									var opt_scanner = parseInt(res.opt_scanner);

									var biojet_in_use = parseInt(res.biojet_in_use);
									var air_wax = parseInt(res.air_wax);
									var option1 = parseInt(res.option1);
									var option2 = parseInt(res.option2);
									var option3 = parseInt(res.option3);
									var option4 = parseInt(res.option4);
									var option5 = parseInt(res.option5);
									var option6 = parseInt(res.option6);
									var option7 = parseInt(res.option7);
									var option8 = parseInt(res.option8);
									var option9 = parseInt(res.option9);
									var option10 = parseInt(res.option10);
									var option11 = parseInt(res.option11);
									var option12 = parseInt(res.option12);

									var drive_in_prewash = parseInt(res.drive_in_prewash);

									var in1 = parseInt(res.in1);
									var in2 = parseInt(res.in2);
									var in3 = parseInt(res.in3);
									var in4 = parseInt(res.in4);
									var in5 = parseInt(res.in5);
									var in6 = parseInt(res.in6);

									var out1 = parseInt(res.out1);
									var out2 = parseInt(res.out2);
									var out3 = parseInt(res.out3);
									var out4 = parseInt(res.out4);
									var out5 = parseInt(res.out5);
									var out6 = parseInt(res.out6);

									if(chassis_wash == 1)
										dijit.byId("chassis_wash").set('checked', true);
									else
										dijit.byId("chassis_wash").set('checked', false);

									if(wheel_wash == 1)
										dijit.byId("wheel_wash").set('checked', true);
									else
										dijit.byId("wheel_wash").set('checked', false);

									if(prewash_2 == 1)
										dijit.byId("prewash_2").set('checked', true);
									else
										dijit.byId("prewash_2").set('checked', false);

									if(van_nozzles == 1)
										dijit.byId("van_nozzles").set('checked', true);
									else
										dijit.byId("van_nozzles").set('checked', false);

									if(ro_water == 1)
										dijit.byId("ro_water").set('checked', true);
									else
										dijit.byId("ro_water").set('checked', false);

									if(wheel_brush == 1)
										dijit.byId("wheel_brush").set('checked', true);
									else
										dijit.byId("wheel_brush").set('checked', false);

									if(buffing_wax == 1)
										dijit.byId("buffing_wax").set('checked', true);
									else
										dijit.byId("buffing_wax").set('checked', false);

									if(chassis_wash == 1)
										dijit.byId("chassis_wash").set('checked', true);
									else
										dijit.byId("chassis_wash").set('checked', false);

									if(wheel_prewash == 1)
										dijit.byId("wheel_prewash").set('checked', true);
									else
										dijit.byId("wheel_prewash").set('checked', false);

									if(tyre_shiner == 1)
										dijit.byId("tyre_shiner").set('checked', true);
									else
										dijit.byId("tyre_shiner").set('checked', false);

									if(opt_scanner == 1)
										dijit.byId("opt_scanner").set('checked', true);
									else
										dijit.byId("opt_scanner").set('checked', false);

									if(biojet_in_use == 1)
										dijit.byId("biojet_in_use").set('checked', true);
									else
										dijit.byId("biojet_in_use").set('checked', false);

									if(air_wax == 1)
										dijit.byId("air_wax").set('checked', true);
									else
										dijit.byId("air_wax").set('checked', false);

									if(option1 == 1)
										dijit.byId("option1").set('checked', true);
									else
										dijit.byId("option1").set('checked', false);

									if(option2 == 1)
										dijit.byId("option2").set('checked', true);
									else
										dijit.byId("option2").set('checked', false);

									if(option3 == 1)
										dijit.byId("option3").set('checked', true);
									else
										dijit.byId("option3").set('checked', false);

									if(option4 == 1)
										dijit.byId("option4").set('checked', true);
									else
										dijit.byId("option4").set('checked', false);

									if(option5 == 1)
										dijit.byId("option5").set('checked', true);
									else
										dijit.byId("option5").set('checked', false);

									if(option6 == 1)
										dijit.byId("option6").set('checked', true);
									else
										dijit.byId("option6").set('checked', false);

									if(option7 == 1)
										dijit.byId("option7").set('checked', true);
									else
										dijit.byId("option7").set('checked', false);

									if(option8 == 1)
										dijit.byId("option8").set('checked', true);
									else
										dijit.byId("option8").set('checked', false);

									if(option9 == 1)
										dijit.byId("option9").set('checked', true);
									else
										dijit.byId("option9").set('checked', false);

									if(option10 == 1)
										dijit.byId("option10").set('checked', true);
									else
										dijit.byId("option10").set('checked', false);

									if(option11 == 1)
										dijit.byId("option11").set('checked', true);
									else
										dijit.byId("option11").set('checked', false);

									if(option12 == 1)
										dijit.byId("option12").set('checked', true);
									else
										dijit.byId("option12").set('checked', false);

									if(drive_in_prewash == 1)
										dijit.byId("drive_in_prewash").set('checked', true);
									else
										dijit.byId("drive_in_prewash").set('checked', false);

									if(in1 == 1)
										dijit.byId("input1").set('checked', true);
									else
										dijit.byId("input1").set('checked', false);

									if(in2 == 1)
										dijit.byId("input2").set('checked', true);
									else
										dijit.byId("input2").set('checked', false);

									if(in3 == 1)
										dijit.byId("input3").set('checked', true);
									else
										dijit.byId("input3").set('checked', false);

									if(in4 == 1)
										dijit.byId("input4").set('checked', true);
									else
										dijit.byId("input4").set('checked', false);

									if(in5 == 1)
										dijit.byId("input5").set('checked', true);
									else
										dijit.byId("input5").set('checked', false);

									if(in6 == 1)
										dijit.byId("input6").set('checked', true);
									else
										dijit.byId("input6").set('checked', false);

									if(out1 == 1)
										dijit.byId("output1").set('checked', true);
									else
										dijit.byId("output1").set('checked', false);

									if(out2 == 1)
										dijit.byId("output2").set('checked', true);
									else
										dijit.byId("output2").set('checked', false);

									if(out3 == 1)
										dijit.byId("output3").set('checked', true);
									else
										dijit.byId("output3").set('checked', false);

									if(out4 == 1)
										dijit.byId("output4").set('checked', true);
									else
										dijit.byId("output4").set('checked', false);

									if(out5 == 1)
										dijit.byId("output5").set('checked', true);
									else
										dijit.byId("output5").set('checked', false);

									if(out6 == 1)
										dijit.byId("output6").set('checked', true);
									else
										dijit.byId("output6").set('checked', false);
								}
							},
							error: function(error)
							{
								console.log(error);
							}
						};

							var deferred = dojo.xhrGet(xhrArgs);

				},
				Save_selections:function()
				{
					 console.log("Save selections pressed");
					 var selections = [];

					 var input1 = dijit.byId("input1").checked;
					 var input2 = dijit.byId("input2").checked;
					 var input3 = dijit.byId("input3").checked;
					 var input4 = dijit.byId("input4").checked;
					 var input5 = dijit.byId("input5").checked;
					 var input6 = dijit.byId("input6").checked;

					 var output1 = dijit.byId("output1").checked;
					 var output2 = dijit.byId("output2").checked;
					 var output3 = dijit.byId("output3").checked;
					 var output4 = dijit.byId("output4").checked;
					 var output5 = dijit.byId("output5").checked;
					 var output6 = dijit.byId("output6").checked;


					var xhrArgs_selections =
						{
							  url: "save_machine_setup_data.php/card_selections",
							  postData: dojo.toJson({"in1":input1,"in2":input2,"in3":input3,"in4":input4,"in5":input5,"in6":input6,"out1":output1,"out2":output2,"out3":output3,"out4":output4,"out5":output5,"out6":output6}),
							  handleAs: "text",
							  load: function(data)
							  {
								if (data)
								{
									var arr = dojo.fromJson(data);
									ShowMessage(arr,3000);
								}
							  },
							  error: function(error)
							  {
								// We'll 404 in the demo, but that's okay.  We don't have a 'postIt' service on the
								// docs server.
								//	dojo.byId("response2").innerHTML = "Message posted.";
									console.log("posted also");
							  }
						};
					var deferred = dojo.xhrPost(xhrArgs_selections);
					setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field

				},

				save_conf_types:function()
				{
				console.log("save_conf_types",MachineSetupForm.getValues(),MachineSetupForm);

					var xhrArgs_values =
						{
							  url: "save_machine_setup_data.php/conf_types",
							  postData: dojo.toJson(MachineSetupForm.getValues()),
							  handleAs: "text"
						};
					var deferred = dojo.xhrPost(xhrArgs_values);
					deferred.then(function(data)
					  {
						 var arr = dojo.fromJson(data);
						 ShowMessage(arr,3000);
					  }, function(err)
					  {
						console.log("error",err);
						html.set(dom.byId("save_conf_types_respond"), " " + err);
					  }, function(update)
					  {
						console.log(update);
					  });

				},
				save_conf_functions:function(self)
				{

				if(self.mode < 1 || self.mode > 4)
				{
					dojo.byId("status_err").innerHTML = "Message:  WRONG OPERATION MODE!";
					setTimeout(function(){dojo.byId("status_err").innerHTML=""},3000); // clear status field
					return;
				}

				dojo.byId("status").innerHTML = "Saving functions. Please wait..";
				var selections = [];
				if(dijit.byId("chassis_wash").get("checked")){selections.push(dijit.byId("chassis_wash").get("value"));}
				if(dijit.byId("wheel_wash").get("checked")){selections.push(dijit.byId("wheel_wash").get("value"));}
				if(dijit.byId("prewash_2").get("checked")){selections.push(dijit.byId("prewash_2").get("value"));}
				if(dijit.byId("van_nozzles").get("checked")){selections.push(dijit.byId("van_nozzles").get("value"));}
				if(dijit.byId("ro_water").get("checked")){selections.push(dijit.byId("ro_water").get("value"));}
				if(dijit.byId("wheel_brush").get("checked")){selections.push(dijit.byId("wheel_brush").get("value"));}
				if(dijit.byId("buffing_wax").get("checked")){selections.push(dijit.byId("buffing_wax").get("value"));}
				if(dijit.byId("wheel_prewash").get("checked")){selections.push(dijit.byId("wheel_prewash").get("value"));}
				if(dijit.byId("tyre_shiner").get("checked")){selections.push(dijit.byId("tyre_shiner").get("value"));}
				if(dijit.byId("opt_scanner").get("checked")){selections.push(dijit.byId("opt_scanner").get("value"));}

				if(dijit.byId("air_wax").get("checked")){selections.push(dijit.byId("air_wax").get("value"));}
				if(dijit.byId("biojet_in_use").get("checked")){selections.push(dijit.byId("biojet_in_use").get("value"));}
				if(dijit.byId("drive_in_prewash").get("checked")){selections.push(dijit.byId("drive_in_prewash").get("value"));}
				if(dijit.byId("option1").get("checked")){selections.push(dijit.byId("option1").get("value"));}
				if(dijit.byId("option2").get("checked")){selections.push(dijit.byId("option2").get("value"));}
				if(dijit.byId("option3").get("checked")){selections.push(dijit.byId("option3").get("value"));}
				if(dijit.byId("option4").get("checked")){selections.push(dijit.byId("option4").get("value"));}
				if(dijit.byId("option5").get("checked")){selections.push(dijit.byId("option5").get("value"));}
				if(dijit.byId("option6").get("checked")){selections.push(dijit.byId("option6").get("value"));}
				if(dijit.byId("option7").get("checked")){selections.push(dijit.byId("option7").get("value"));}
				if(dijit.byId("option8").get("checked")){selections.push(dijit.byId("option8").get("value"));}
				if(dijit.byId("option9").get("checked")){selections.push(dijit.byId("option9").get("value"));}
				if(dijit.byId("option10").get("checked")){selections.push(dijit.byId("option10").get("value"));}
				if(dijit.byId("option11").get("checked")){selections.push(dijit.byId("option11").get("value"));}
				if(dijit.byId("option12").get("checked")){selections.push(dijit.byId("option12").get("value"));}
				console.log("save_conf_functions",selections);
				var xhrArgs =
					{
						  url: "save_machine_setup_data.php/selections",
						  postData: dojo.toJson(selections),
						  handleAs: "text"
					};
					var deferred = dojo.xhrPost(xhrArgs);
					deferred.then(function(data)
					  {
						var arr = dojo.fromJson(data);
						ShowMessage(arr,3000);
						var deferred = dojo.xhrGet(xhrArgs);
						window.location = window.location.href;

					  }, function(err)
					  {
						console.log(err);
						html.set(dom.byId("save_conf_functions_respond"), " " + err);
					  }, function(update)
					  {
						console.log(update);
					  });


				},
				use_ip_conf:function(self)
				{
					var camera_status = SaveIpcameraConf.getValues().camera_status;
					var camera_ip = self.camera_ip.get("value");
					var camera_port = self.camera_port.get("value");
					var camera_quality = self.camera_quality.get("value");
					var camera_fps = self.camera_fps.get("value");
					var camera_width = self.camera_width.get("value");
					var camera_height = self.camera_height.get("value");


					var xhrArgs_set_values =
					{
							url: "manage_camera.php/set_camera_values",
							postData: dojo.toJson({camera_status:camera_status.replace(/\0/g, ''), camera_ip:camera_ip.replace(/\0/g, ''), camera_port:camera_port.replace(/\0/g, ''), camera_quality:camera_quality.replace(/\0/g, '') , camera_fps:camera_fps.replace(/\0/g, ''), camera_width:camera_width.replace(/\0/g, ''), camera_height:camera_height.replace(/\0/g, '')}),
							handleAs: "text"
					};
					var deferred = dojo.xhrPost(xhrArgs_set_values);
					deferred.then(function(value)
					{
						self.camera_ip.set("value", "reading..");
						self.camera_port.set("value", "reading..");

						self.camera_quality.set("value", "reading..");
						self.camera_fps.set("value", "reading..");

						self.camera_width.set("value", "reading..");
						self.camera_height.set("value", "reading..");

						var deferred = dojo.xhrGet(self.xhrArgs_camera_settings);
						
					  }, function(err)
					  {
						console.log(err);
					  });
				},

				save_pass:function(self)
				{
					var pass = self.Password.get("value");

					var xhrArgs_set_password =
						{
							  url: "compare_passwords.php",
							  postData: dojo.toJson({pass:pass}),
							  handleAs: "text"
						};
						if(pass != "reading..")
						{
							var deferred = dojo.xhrPost(xhrArgs_set_password);
							deferred.then(function(value)
							  {
								self.Password.set("value", "reading..");

								var deferred = dojo.xhrGet(self.xhrArgs_get_pass);

							  }, function(err)
							  {
								console.log(err);
							  });
					  }
					  else
					  {
							var deferred = dojo.xhrGet(self.xhrArgs_get_pass);
					  }
				},
				send_washcounters:function(self)
				{
					var xhrArgs_send_washcounters =
					{
						  url: "mail.php",
						  postData: dojo.toJson({data:self.StationData.get("value")}),
						  handleAs: "text"
					};
					var deferred = dojo.xhrPost(xhrArgs_send_washcounters);
					deferred.then(function(value)
					{
						dojo.byId("washcounters_result").innerHTML = value;
					});
				},
				save_washcounters_conf:function(self)
				{
					console.log("save_washcounters_conf",SaveWashcounterConf.getValues(),SaveWashcounterConf);

					var xhrArgs_values =
						{
							  url: "save_machine_setup_data.php/counters_conf",
							  postData: dojo.toJson(SaveWashcounterConf.getValues()),
							  handleAs: "text"
						};
					var deferred = dojo.xhrPost(xhrArgs_values);
					deferred.then(function(value)
					  {
						var arr = dojo.fromJson(value);
						ShowMessage(arr,3000);
						
					  }, function(err)
					  {
						console.log("error",err);
						var arr = dojo.fromJson(value);
						dojo.byId("status").innerHTML = "Message: " + err;
					  }, function(update)
					  {
						console.log(update);
					  });
				},
				sync_washcounters:function(self)
				{
					var c = confirm("Sync washcounter values from the shared memory to database? ");
					if(c)
					{
						var xhrArgs_send_washcounters =
						{
							  url: "sync_washcounters.php",
							  postData: dojo.toJson({data:null}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs_send_washcounters);
						deferred.then(function(value)
						{
							dojo.byId("washcounters_result").innerHTML = value;
						});
					}
					else
						dojo.byId("washcounters_result").innerHTML = "Cancelled..";
				},
				save_email_settings:function(self)
				{
					var station_data = self.StationData.get("value");
					var cc_value = self.EmailCc.get("value");
					var to_value = self.EmailTo.get("value");

					var cc_value2 = self.EmailCc2.get("value");
					var to_value2 = self.EmailTo2.get("value");

					var cc_value3 = self.EmailCc3.get("value");
					var to_value3 = self.EmailTo3.get("value");


					var xhrArgs_set_values =
						{
							  url: "Manage_accounts.php/set_values",
							  postData: dojo.toJson({station_data:station_data.replace(/\0/g, ''), to_value:to_value.replace(/\0/g, ''), to_value2:to_value2.replace(/\0/g, ''), to_value3:to_value3.replace(/\0/g, '') , cc_value:cc_value.replace(/\0/g, ''), cc_value2:cc_value2.replace(/\0/g, ''), cc_value3:cc_value3.replace(/\0/g, '')}),
							  handleAs: "text"
						};
					var deferred = dojo.xhrPost(xhrArgs_set_values);
					deferred.then(function(value)
					  {
						self.StationData.set("value", "reading..");
						self.EmailCc.set("value", "reading..");
						self.EmailTo.set("value", "reading..");

						self.EmailCc2.set("value", "reading..");
						self.EmailTo2.set("value", "reading..");

						self.EmailCc3.set("value", "reading..");
						self.EmailTo3.set("value", "reading..");

						var deferred = dojo.xhrGet(self.xhrArgs_email_settings);
					  }, function(err)
					  {
						console.log(err);
					  });
				}
        });
    });
