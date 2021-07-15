require([
	"dojo/_base/declare", 
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/StartWashing/templates/StartWashing.html", 
	"dojo/html",
    "dgrid/List", 
	"dgrid/OnDemandGrid",
	"dgrid/Selection", 
	"dgrid/editor", 
	"dgrid/Keyboard", 
	"dgrid/tree", 
	"dojo/store/JsonRest", 
    "dojo/store/Observable", 
	"dojo/store/Cache", 
	"dojo/store/Memory", 
	"dojo/dom", 
	"dojo/dom-class",
	"dojo/i18n!./lib/nls/resources.js",
	"lib/LangSupport",
	"dojo/ready",
	"dijit/registry"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, html, List, Grid,Selection,editor,Keyboard,tree,JsonRest,
                    Observable, Cache, Memory, dom, domClass,resources,LangSupport,ready,registry)
		{
			return  declare("StartWashing", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				start_washing: resources.start_washing,
				number : 0,

   				postCreate: function() 
				{
				    this.inherited(arguments);
					var domNode = this.domNode;
					var self = this;	   
					var SelectedButton;		
					var Selectedset;
					this.ls = new LangSupport();	
					var password;
					var mode;
					var maintenance;
					var timeout; // updKHu
					var toimintatila = 0; // updKHu
					

                    dojo.connect(this.button1, "onclick", null, function() { self.selected("1"); });
                    dojo.connect(this.button2, "onclick", null, function() { self.selected("2"); });
                    dojo.connect(this.button3, "onclick", null, function() { self.selected("3"); });
                    dojo.connect(this.button4, "onclick", null, function() { self.selected("4"); });
                    dojo.connect(this.button5, "onclick", null, function() { self.selected("5"); });
                    dojo.connect(this.button6, "onclick", null, function() { self.selected("6"); });
                    dojo.connect(this.button7, "onclick", null, function() { self.selected("7"); });
                    dojo.connect(this.button8, "onclick", null, function() { self.selected("8"); });
                    dojo.connect(this.button9, "onclick", null, function() { self.selected("9"); });
                    dojo.connect(this.button10, "onclick", null, function() { self.selected("10"); });
                    dojo.connect(this.button11, "onclick", null, function() { self.selected("11"); });
                    dojo.connect(this.button12, "onclick", null, function() { self.selected("12"); });
                    dojo.connect(this.button13, "onclick", null, function() { self.selected("13"); });
                    dojo.connect(this.button14, "onclick", null, function() { self.selected("14"); });
                    dojo.connect(this.button15, "onclick", null, function() { self.selected("15"); });     

                    dojo.connect(this.button16, "onclick", null, function() { self.selected("16"); });
                    dojo.connect(this.button17, "onclick", null, function() { self.selected("17"); });
                    dojo.connect(this.button18, "onclick", null, function() { self.selected("18"); });
                    dojo.connect(this.button19, "onclick", null, function() { self.selected("19"); });
                    dojo.connect(this.button20, "onclick", null, function() { self.selected("20"); });
                    dojo.connect(this.button21, "onclick", null, function() { self.selected("21"); });
                    dojo.connect(this.button22, "onclick", null, function() { self.selected("22"); });
                    dojo.connect(this.button23, "onclick", null, function() { self.selected("23"); });
                    dojo.connect(this.button24, "onclick", null, function() { self.selected("24"); });
                    dojo.connect(this.button25, "onclick", null, function() { self.selected("25"); });
                    dojo.connect(this.button26, "onclick", null, function() { self.selected("26"); });
                    dojo.connect(this.button27, "onclick", null, function() { self.selected("27"); });
                    dojo.connect(this.button28, "onclick", null, function() { self.selected("28"); });
                    dojo.connect(this.button29, "onclick", null, function() { self.selected("29"); });
                    dojo.connect(this.button30, "onclick", null, function() { self.selected("30"); });    

                    dojo.connect(this.start,    "onclick", null, function() { self.command("start"); });	
                 //   dojo.connect(this.stop,     "onclick", null, function() { self.command("stop"); });	
                 //   dojo.connect(this.pause,    "onclick", null, function() { self.command("pause"); });	
					
					dojo.connect(this.button_set_1, "onclick", null, function() { self.read_set("1",null); });
					dojo.connect(this.button_set_2, "onclick", null, function() { self.read_set("2",null); });
					dojo.connect(this.button_set_3, "onclick", null, function() { self.read_set("3",null); });
					dojo.connect(this.button_set_4, "onclick", null, function() { self.read_set("4",null); });   				

					dojo.connect(this.keyboard_button1, "onclick", null, function() { self.pressed_key("1"); });    
					dojo.connect(this.keyboard_button2, "onclick", null, function() { self.pressed_key("2"); });   
					dojo.connect(this.keyboard_button3, "onclick", null, function() { self.pressed_key("3"); });   
					dojo.connect(this.keyboard_button4, "onclick", null, function() { self.pressed_key("4"); });   
					dojo.connect(this.keyboard_button5, "onclick", null, function() { self.pressed_key("5"); });   
					dojo.connect(this.keyboard_button6, "onclick", null, function() { self.pressed_key("6"); });   
					dojo.connect(this.keyboard_button7, "onclick", null, function() { self.pressed_key("7"); });   
					dojo.connect(this.keyboard_button8, "onclick", null, function() { self.pressed_key("8"); });   
					dojo.connect(this.keyboard_button9, "onclick", null, function() { self.pressed_key("9"); });   
					dojo.connect(this.keyboard_button0, "onclick", null, function() { self.pressed_key("0"); });   
					dojo.connect(this.keyboard_button_ok, "onclick", null, function() { self.pressed_key("ok"); });   
					dojo.connect(this.keyboard_button_close, "onclick", null, function() { self.pressed_key("close"); });   
					
					
					var tabs = registry.byId("pageTabContainer");
					
					
					this.xhrArgs_buttons = 
						{
							url: "save_washing_program.php/100",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
								//	var self = this;	 
									var arr = dojo.fromJson(data);
							//		self.set_number = arr[0]; // saved set number
							//		console.log(this.set);
									
									for(var j = 1; j<31; j++)
									{
									var str = "button"+j;
									dojo.byId(str).innerHTML = "<div class='prog_button_empty' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+j+"</span></div>";

										for(var i = 1; i<arr.length; i++)
										{
												var type = arr[i].Program_Type;
												var slot = arr[i].SlotNumber;
												var str = "button"+slot;
												
												switch(type)
													{
														case "none": 
															dojo.byId(str).innerHTML = "<div class='prog_button' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
														break;
														case "summer_program": 
															dojo.byId(str).innerHTML = "<div class='prog_button_summer' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
														break;
														case "winter_program": 
															dojo.byId(str).innerHTML = "<div class='prog_button_winter' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
														break;
														case "fast_program": 
															dojo.byId(str).innerHTML = "<div class='prog_button_fast' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
														break;
													}	
										}
											
									}

								}
							}
						}
					
					var deferred = dojo.xhrGet(this.xhrArgs_buttons);	
					
					
					tabs.watch("selectedChildWidget", function(name, oval, nval) // page is loaded
					{
						if(nval.id == "start_washing") // if page is start washing page
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
									console.log("ifsf : " + self.mode + " maintenance: " + self.maintenance );
								}
							}
						}
						var deferred = dojo.xhrGet(this.xhrArgs_get_ifsf_data);	
						deferred.then(function(data)
							{
								if(self.mode == 1 && self.maintenance == 0) // ifsf mode is set -> disable button
								{
								dojo.style("prog_button_start", {
											  "backgroundImage": "url('../lib/css/images/button_play_gray_dis.png')",
											  "height": "50px",
											  "width": "50px",
											  "cursor": "not-allowed" 
											  });	
								}
								else if(self.mode == 1 && self.maintenance == 1) // enable
								{
								dojo.style("prog_button_start", {
											  "backgroundImage": "url('../lib/css/images/button_play_gray.png')",
											  "height": "50px",
											  "width": "50px",
											  "cursor": "pointer"  
											  });	
								}
								else
								{
								dojo.style("prog_button_start", {
											  "backgroundImage": "url('../lib/css/images/button_play_gray.png')",
											  "height": "50px",
											  "width": "50px",
											  "cursor": "pointer"  
											  });	
								}
							});
					
						dojo.byId("status").innerHTML = "COMPARING MEMORY, PLEASE WAIT....";
						
							var color = dojo.style("shared_mem_ok_text").color;
							if(color == "rgb(255, 0, 0)") // offline
							{
								dojo.byId("status").innerHTML = "Message: System is offline...";
								setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
								return;
							}
						
							this.xhrArgs_set_buttons = 
							{
								url: "save_washing_program.php/100",
								handleAs: "text",
								load: function(data)
								{
									if (data) 
									{ 
										var arr = dojo.fromJson(data);
										self.set_number = arr[0]; // saved set number
										self.old_set_number = arr[1] // set number in machine
										var shared_mem_compare = arr[2]; // comaparing status from the shared mems
	
								//		console.log(shared_mem_compare,arr[2]);

								
										if(arr[3].old_sum != null)
											dojo.byId("status").innerHTML = "Message: " + shared_mem_compare.sum +" <- checksum -> " + arr[3].old_sum;
										else
											dojo.byId("status").innerHTML = "Message: " + shared_mem_compare.sum;
										
										if(arr[0] != arr[1])
										{
											var set_db;
											var set_mach;
											
											if(arr[0] == 1)
												set_db = "A";
											if(arr[0] == 2)
												set_db = "B";	
											if(arr[0] == 3)
												set_db = "C";
											if(arr[0] == 4)
												set_db = "D";
												
											if(arr[1] == 1)
												set_mach = "A";
											if(arr[1] == 2)
												set_mach = "B";	
											if(arr[1] == 3)
												set_mach = "C";
											if(arr[1] == 4)
												set_mach = "D";
												
											var c = confirm("Loaded set in database is : " +set_db+ " and set in machine is : " + set_mach+" Do you want to sync?");	
											if(c) 	
											{
												console.log("setnumber ", self.set_number);
												self.read_set(self.set_number, null); // show saved set
											}
											else
											{
												console.log(self.old_set_number);
												
													var xhrArgs_load_set = 
													{
														  url: "import_database.php/"+self.old_set_number,
														  postData: dojo.toJson({load_set:self.old_set_number}),
														  handleAs: "text"
													};
												var deferred = dojo.xhrPost(xhrArgs_load_set); // load set to database
											
												self.set_number = self.old_set_number; // saved old set number
											//	var deferred = dojo.xhrGet(self.xhrArgs_buttons);		
											}
										}
																	
										if(arr[3].old_sum != null)
										{

											if(shared_mem_compare.sum != arr[3].old_sum)
											{
												alert("Shared memory compare status : FAIL");
												self.read_set(self.set_number, null); // show saved set
											}
										}
										
										if(shared_mem_compare != null && shared_mem_compare == "false")
										{
											alert("Shared memory compare status : "+shared_mem_compare);
											self.read_set(self.set_number, null); // show saved set
										}

								
										var deferred = dojo.xhrGet(self.xhrArgs_buttons);	
									}
									setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
									timeout = setInterval(function() { // check operation mode in 5 s time period, updKHu
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
															toimintatila = res.operation_mode;
															if (toimintatila == 6)
															{
																//alert("Jepulis tila 6"); // Online välilehdelle kun pesua pukkaa, updKHu
																toimintatila = 3;          // Alustus IDLE:een jotta nappi näkyy heti kun palataan pesun jälkeen, updKHu v4.8
																tabs.selectChild("online_status");
																domClass.add("pageTabContainer_tablist_online_status", "dijitTabChecked dijitChecked");
															}   // Lisätty huoltotila (9), updKHu v4.8
															if (toimintatila == 3 || toimintatila == 4 || toimintatila == 9)
																dojo.style("prog_button_start", {"visibility": "visible"});
															else
																dojo.style("prog_button_start", {"visibility": "hidden"});
														}
														else
															toimintatila = 0;
													}
											}
											var deferred = dojo.xhrGet(xhrArgs);
										},5000);
									console.log("Start Washing: 5 s timer setted");
								}
							}
							
							var deferred = dojo.xhrGet(this.xhrArgs_set_buttons);	
							deferred.then(function(data)
							{
								
							
								self.read_set(self.set_number, "ok"); // show saved set
							/*	var xhrArgs_get_set = 
								{
									  url: "import_database.php/get",
									  postData: dojo.toJson({load_set:"get"}),
									  handleAs: "text"
								};
						
							var deferred = dojo.xhrPost(xhrArgs_get_set); */
								
							});
						}
						else
						{
							console.log("Start Washing: 5 s timer cleared");
							clearInterval(timeout); // updKHu
						}

					});       
					
					
					/*
					deferred.then(function(data)
					{
					//	alert(self.set_number);
							self.read_set(self.set_number); // show saved set
					});
*/
                     

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
					// Create grid for wash program 
					 this.grid = new (declare([Grid, Selection]))({
						  store: this.ProgramLineStore,
						  columns: columns_wash_program,
						  selectionMode: "single"
					//	  query: {button:1}
					  }, "grid_start_washing");	 
		      /*
                    this.grid = new (declare([Grid, Selection, Keyboard]))({
                          store: myStore,
                          columns: columns,
                         query: {button:1}
                      }, "grid_start_washing");
					  */
					this.buttons = [null,
						this.button1,this.button2,this.button3,this.button4,this.button5,this.button6,this.button7,this.button8,this.button9,this.button10,
						this.button11,this.button12,this.button13,this.button14,this.button15,this.button16,this.button17,this.button18,this.button19,this.button20,
						this.button21,this.button22,this.button23,this.button24,this.button25,this.button26,this.button27,this.button28,this.button29,this.button30
					];
					this.selected_button = false;
				
			            // slotnumber 1 selected by default
					self.selected("1");	
				//    domClass.add(this.buttons[parseInt(1)], "selected_program");

                },
				 pressed_key: function(key) 
                {
					html.set(dom.byId("key_text"),""); // clear text
					if(key == "ok")
					{
						var code = this.password;
						var xhrArgs = 
						{
							url: "compare_passwords.php/",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
									var arr = dojo.fromJson(data);

									if(code == arr.pass) // compare passwords
									{
										html.set(dom.byId("key_text"),"Password OK!"); 
										
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
													console.log(o_mas,o_sla);
													
													if(o_mas != null) // 
													{
													
														if((o_mas == 4 && o_sla == null) || (o_mas == 3 && o_sla == null) || (o_mas == 9 && o_sla == null)) // operation mode is customer entry and machine type is single -> allow start
														{
															
															var xhrArgs = 
																{
																	url: "run_command.php",
																	postData: dojo.toJson({run_command:"start", type:"single", prog_number:self.SelectedButton}),
																	handleAs: "text"
																};
																	var deferred = dojo.xhrPost(xhrArgs);
																console.log("start singelemachine wash");
														}
														else if((o_mas != 4 && o_sla == null) || (o_mas != 3 && o_sla == null ) || (o_mas != 9 && o_sla == null)) // give error popup
														{
														
															switch(o_mas)
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
															
															alert("Wrong operation mode: "+operation_mode+". Should be in customer entry mode");		
														}
														
														if((o_mas == 4 && o_sla == 4) || (o_mas == 3 && o_sla == 3) || (o_mas == 9 && o_sla == 9)) // operation mode is customer entry in both machines -> allow start
														{
															var xhrArgs = 
																{
																	url: "run_command.php",
																	postData: dojo.toJson({run_command:"start", type:"twin", prog_number:self.SelectedButton}),
																	handleAs: "text"
																};
																	var deferred = dojo.xhrPost(xhrArgs);
															console.log("start twinmachine wash");
														}
														else if((o_mas != 4 && o_sla != null) || (o_mas != 3 && o_sla != null) || (o_mas != 9 && o_sla != null)) // give error popup
														{
														
															switch(o_mas)
															{
																case 1:operation_mode_mas =  resources.operation_mode_1;break;
																case 2:operation_mode_mas =  resources.operation_mode_2;break;
																case 3:operation_mode_mas =  resources.operation_mode_3;break;
																case 4:operation_mode_mas =  resources.operation_mode_4;break;
																case 5:operation_mode_mas =  resources.operation_mode_5;break;
																case 6:operation_mode_mas =  resources.operation_mode_6;break;
																case 7:operation_mode_mas =  resources.operation_mode_7;break;
																case 8:operation_mode_mas =  resources.operation_mode_8;break;
																case 9:operation_mode_mas =  resources.operation_mode_9;break;
															//	default:operation_mode =  resources.operation_mode_0;break;
															}
															
															switch(o_sla)
															{
																case 1:operation_mode_sla =  resources.operation_mode_1;break;
																case 2:operation_mode_sla =  resources.operation_mode_2;break;
																case 3:operation_mode_sla =  resources.operation_mode_3;break;
																case 4:operation_mode_sla =  resources.operation_mode_4;break;
																case 5:operation_mode_sla =  resources.operation_mode_5;break;
																case 6:operation_mode_sla =  resources.operation_mode_6;break;
																case 7:operation_mode_sla =  resources.operation_mode_7;break;
																case 8:operation_mode_sla =  resources.operation_mode_8;break;
																case 9:operation_mode_sla =  resources.operation_mode_9;break;
															//	default:operation_mode =  resources.operation_mode_0;break;
															}
															
																alert("Wrong operation mode(s). Master :"+operation_mode_mas+" Slave :"+operation_mode_sla + ". Machines should be in customer entry mode");		
														}
													}
												}
											}
										};
									var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
									setTimeout(function(){
										dojo.style("keyboard_start_wash", {
										  "display": "none"
										  });
						  
										  dojo.style("overlay", {
										  "display": "none"
										  });
										},1000); // hide overlay and keyboard
									}
									else
									{
										html.set(dom.byId("key_text"), "Wrong password! ("+code+")");
									}
								}
							},
							error: function(error)
							{
								console.log("error",error);
							}
						}
						var deferred = dojo.xhrGet(xhrArgs);
						
						this.password = null;
						  return;
					}
					if(key == "close")
					{
						  dojo.style("keyboard_start_wash", {
						  "display": "none"
						  });
						  
						  dojo.style("overlay", {
						  "display": "none"
						  });
						  /*
						  dojo.style("set_buttons", {
						  "display": "block"
						  });
						  */
						  this.password = null;
						  return;
					}
					
					if(this.password == null)
						this.password = key;
					else
						this.password += key;
						
					console.log(this.password);
				},
                selected: function(button) 
                {
				console.log("selected ", button);
						 var self = this;
						 SelectedButton = button;
					   // remove default selection
						domClass.remove(this.buttons[parseInt(1)], "selected_program");
						
						var id = "button" + SelectedButton;

						for(var j = 1; j<31; j++)
						{
							var idc = "button"+j;
							dojo.style(idc, {
							  "color": "black",
							  "fontSize": "18px"
							  });
						}			
						
						dojo.style(id, {
							  "color": "green",
							  "fontSize": "30px"
							  });
					   					   
						dojo.byId("header_status").innerHTML = "Program number <b>" + button + "</b> is selected<br>" + dojo.byId("header_status").innerHTML;
						var ProgramLine = [];
						this.ProgramLineStore = new Memory({data:ProgramLine});
						
						var xhrArgs = 
						{
							url: "save_washing_program.php/"+button,
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{

									var arr = dojo.fromJson(data);
									if(arr != null)
									{
										for(var i=0; i < arr.length; i++) 
										{
											self.ProgramLineStore.put(arr[i]);
										}
									}
								}
								self.grid.store = self.ProgramLineStore;
								self.grid.refresh();

							},
							error: function(error)
							{
								self.grid.store = self.ProgramLineStore;
								self.grid.refresh();
							}
						}
						var deferred = dojo.xhrGet(xhrArgs);
						
					   //        this.grid.query={button:button};
					   //        this.grid.refresh();
							   
							   if (this.selected_button)
							   {

								domClass.remove(this.selected_button, "selected_program");
							   }
								this.selected_button = this.buttons[parseInt(button)];
								domClass.add(this.selected_button, "selected_program");

                },
				read_set: function(set,state)
				{
				
								
					var self = this;	  

					dojo.style("button_set_1", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue.png')",
								  "height": "50px",
								  "width": "50px"  
								  });
					
					dojo.style("button_set_2", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue.png')",
								  "height": "50px",
								  "width": "50px"  
								  });
					
					dojo.style("button_set_3", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue.png')",
								  "height": "50px",
								  "width": "50px"  
								  });
					
					dojo.style("button_set_4", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue.png')",
								  "height": "50px",
								  "width": "50px"  
								  });					
				
				
					id = "button_set_" + set;
					if(state == "ok")
					{
						
						dojo.style(id, {
										  "backgroundImage": "url('../lib/css/images/button_set_green.png')",
										  "height": "50px",
										  "width": "50px"  
										  });
					}
					else
					{
						var set_d;
						if(set == 1)
							set_d = "A";
						if(set == 2)
							set_d = "B";	
						if(set == 3)
							set_d = "C";
						if(set == 4)
							set_d = "D";
							
						var c = confirm("Load set " +set_d+ "?");	
						if(c) // save set	
						{
								this.xhrArgs_mode_get_operationmode = 
								{
									url: "save_washing_program.php/operationmode",
									handleAs: "text",
									load: function(data)
									{
										if (data) 
										{ 

										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_mode_get_operationmode);
								deferred.then(function(data)
										{
											if(data) 
											{
												var arr = dojo.fromJson(data);

												if(arr.mode == 9 || arr.mode == 2 || arr.mode == 3) // if mode is maintenance, idle or closed
												{
													console.log("operationmode ok -> load set to database");
													dojo.byId("status").innerHTML = "Message: Operationmode ok -> load set to database";
													var deferred = dojo.xhrPost(xhrArgs_load_set); // if operatiommode is ok -> load set to database
													deferred.then(function(data)
													{
														console.log("set loaded to database -> sync set to shared memory");
														dojo.byId("status").innerHTML = "Message: Set loaded to database -> sync set to shared memory";
														var deferred = dojo.xhrGet(xhrArgs_mode_sync);	
														deferred.then(function(data)
														{
															console.log("set synced to shared memory -> update synced set data to database");
															dojo.byId("status").innerHTML = "Message: Set synced to shared memory -> update synced set data to database";
															var deferred = dojo.xhrPost(self.xhrArgs_sync_sets);	
															deferred.then(function(data)
															{
																console.log("data updated to database");
																dojo.byId("status").innerHTML = "Message: Data updated to database";

																		dojo.style("button_set_1", {
																					  "background-image": "url('../lib/css/images/button_set_blue.png')",
																					  "height": "50px",
																					  "width": "50px"  
																					  });
																		
																		dojo.style("button_set_2", {
																					  "background-image": "url('../lib/css/images/button_set_blue.png')",
																					  "height": "50px",
																					  "width": "50px"  
																					  });
																		
																		dojo.style("button_set_3", {
																					  "background-image": "url('../lib/css/images/button_set_blue.png')",
																					  "height": "50px",
																					  "width": "50px"  
																					  });
																		
																		dojo.style("button_set_4", {
																					  "background-image": "url('../lib/css/images/button_set_blue.png')",
																					  "height": "50px",
																					  "width": "50px"  
																					  });					
																	
																	
																		// show everything when sync is done
																		dojo.style("maindiv_startwashing", 
																		{
																		  "visibility": "visible",
																		  "overflow": "visible",								  
																		});
																		
																		dojo.style("loadingOverlay", {"display": "none"}); // hide loading gif
																		
																		var deferred =  dojo.xhrGet(xhrArgs_buttons_refresh); // refresh buttons
																		dojo.query(".prog_button_start").style("visibility", "visible");
																	//	dojo.query(".prog_button_stop").style("visibility", "visible");
																	//	dojo.query(".prog_button_pause").style("visibility", "visible");
																		dojo.byId("sync").innerHTML = "<span style='font-size:1px; visibility:visible; text-align:center; width:100%;'></span>";
																		
																		// tämä myöskin 3 kertaa ny
																		this.xhrArgs_set_buttons_ = 
																		{
																			url: "save_washing_program.php/100",
																			handleAs: "text",
																			load: function(data)
																			{
																				if (data) 
																				{ 
																					var arr = dojo.fromJson(data);
																					self.set_number_new = arr[0]; // saved set number
																				
																				}
																			}
																		}
																		var deferred = dojo.xhrGet(this.xhrArgs_set_buttons_);	
																		deferred.then(function(data)
																		{
																			id = "button_set_" + self.set_number_new;	
																			dojo.style(id, {
																						  "background-image": "url('../lib/css/images/button_set_green.png')",
																						  "height": "50px",
																						  "width": "50px"  
																						  });
																		
																		});							
																	
																
															});	
														
														});	
														
														
													});				
												}
												else // wrong operationmode give alert and cancel operation
												{
													if(arr.mode != null)
													{
														switch(arr.mode)
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
															dojo.byId("sync").innerHTML = "<span style='font-size:1px; visibility:hidden; text-align:center; width:100%;'></span>";
															dojo.style("maindiv_startwashing", 
															{
															  "visibility": "visible",
															  "overflow": "visible",								  
															});
															alert("Command not Allowed ! Wrong Operation mode : "+operation_mode + " Operation cancelled..");		
															dojo.query(".prog_button_start").style("visibility", "visible");
															dojo.style("loadingOverlay", {"display": "none"}); // hide loading gif

													}
												}
											}
										});		
										
							
								var c = confirm("Press ok to start sync set : " +set_d);
								if(c)
								{								
									dojo.style("maindiv_startwashing", 
									{
									  "visibility": "hidden",
									  "overflow": "hidden",								  
									});
									// hide everything
									dojo.query(".prog_button_start").style("visibility", "hidden");
								//	dojo.query(".prog_button_stop").style("visibility", "hidden");
								//	dojo.query(".prog_button_pause").style("visibility", "hidden");
								//	dojo.byId("sync").innerHTML = "<span style='font-size:32px; visibility:visible; text-align:center; width:100%;'><b>Sync in progress.. Please wait<b></span>";
									
								//	dojo.byId("sync").innerHTML = "<span style=' background-image: url(../css/images/loading-x.gif);  background-repeat: no-repeat;  background-position: center center; width:100%; height: 100%; visibility:visible;'></span>";
								    dojo.style("loadingOverlay", {"display": "block"});
																		
								}
								else
								{
								// tämäkin on nyt 2 kertaa
										this.xhrArgs_set_buttons_ = 
										{
											url: "save_washing_program.php/100",
											handleAs: "text",
											load: function(data)
											{
												if (data) 
												{ 
													var arr = dojo.fromJson(data);
													self.set_number_new = arr[0]; // saved set number
												
												}
											}
										}
										var deferred = dojo.xhrGet(this.xhrArgs_set_buttons_);	
										deferred.then(function(data)
										{
											id = "button_set_" + self.set_number_new;	
											dojo.style(id, {
														  "background-image": "url('../lib/css/images/button_set_green.png')",
														  "height": "50px",
														  "width": "50px"  
														  });
										
										});		
										return;
								}	
							
								// tämä viritys o ny 2 kertaa täällä 						
								var xhrArgs_buttons_refresh = 
								{
									url: "save_washing_program.php/100",
									handleAs: "text",
									load: function(data)
									{
										if (data) 
										{
										//	var self = this;	 
											var arr = dojo.fromJson(data);
									//		self.set_number = arr[0]; // saved set number
									//		console.log(this.set);
											
											for(var j = 1; j<31; j++)
											{
											var str = "button"+j;
											dojo.byId(str).innerHTML = "<div class='prog_button_empty' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+j+"</span></div>";
											
												for(var i = 1; i<arr.length; i++)
												{

														var type = arr[i].Program_Type;
														var slot = arr[i].SlotNumber;
														var str = "button"+slot;
														
														switch(type)
															{
																case "none": 
																	dojo.byId(str).innerHTML = "<div class='prog_button' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
																break;
																case "summer_program": 
																	dojo.byId(str).innerHTML = "<div class='prog_button_summer' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
																break;
																case "winter_program": 
																	dojo.byId(str).innerHTML = "<div class='prog_button_winter' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
																break;
																case "fast_program": 
																	dojo.byId(str).innerHTML = "<div class='prog_button_fast' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+slot+"</span></div>";
																break;
															}	
												}
													
											}

										}
									}
								}
					
							var xhrArgs_load_set = 
								{
									  url: "import_database.php/"+set,
									  postData: dojo.toJson({load_set:set}),
									  handleAs: "text"
								};
								
							this.xhrArgs_sync_sets = 
								{
									  url: "save_washing_program.php/sync_sets",
									  postData: dojo.toJson({sync_sets:"sync_sets"}),
									  handleAs: "text"
								};
							
							var xhrArgs_mode_sync = 
							{
								url: "save_washing_program.php/sync",
								handleAs: "text",
								load: function(data)
								{
									if (data) 
									{ 
									console.log("start syncing..");
									}
								}
							};
						//	var deferred = dojo.xhrGet(this.xhrArgs_sync_sets);	
							/*
							this.xhrArgs_mode_sync = 
								{
									url: "save_washing_program.php/sync",
									handleAs: "text",
									load: function(data)
									{
										if (data) 
										{ 
											var arr = dojo.fromJson(data);

											if(arr.mode != null)
											{
												switch(arr.mode)
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
													dojo.byId("sync").innerHTML = "<span style='font-size:1px; visibility:hidden; text-align:center; width:100%;'></span>";
													dojo.style("maindiv_startwashing", 
													{
													  "visibility": "visible",
													  "overflow": "visible",								  
													});
													alert("Command not Allowed ! Wrong Operation mode : "+operation_mode + " Operation cancelled..");		
													dojo.query(".prog_button_start").style("visibility", "visible");

											}
											else
											{
												var deferred = dojo.xhrPost(xhrArgs_load_set); // load set to database
												deferred.then(function(data)
													{
														
								
														var deferred = dojo.xhrPost(self.xhrArgs_sync_sets);	
														console.log("set loaded...syncing sets", self.xhrArgs_sync_sets);
													});				
	

	
												if(arr.sync_done == "done")
												{
													dojo.style("button_set_1", {
																  "background-image": "url('../lib/css/images/button_set_blue.png')",
																  "height": "50px",
																  "width": "50px"  
																  });
													
													dojo.style("button_set_2", {
																  "background-image": "url('../lib/css/images/button_set_blue.png')",
																  "height": "50px",
																  "width": "50px"  
																  });
													
													dojo.style("button_set_3", {
																  "background-image": "url('../lib/css/images/button_set_blue.png')",
																  "height": "50px",
																  "width": "50px"  
																  });
													
													dojo.style("button_set_4", {
																  "background-image": "url('../lib/css/images/button_set_blue.png')",
																  "height": "50px",
																  "width": "50px"  
																  });					
												
												
													// show everything when sync is done
													dojo.style("maindiv_startwashing", 
													{
													  "visibility": "visible",
													  "overflow": "visible",								  
													});
													var deferred =  dojo.xhrGet(xhrArgs_buttons_refresh); // refresh buttons
													dojo.query(".prog_button_start").style("visibility", "visible");
												//	dojo.query(".prog_button_stop").style("visibility", "visible");
												//	dojo.query(".prog_button_pause").style("visibility", "visible");
													dojo.byId("sync").innerHTML = "<span style='font-size:1px; visibility:visible; text-align:center; width:100%;'></span>";
													
													// tämä myöskin 3 kertaa ny
													this.xhrArgs_set_buttons_ = 
													{
														url: "save_washing_program.php/100",
														handleAs: "text",
														load: function(data)
														{
															if (data) 
															{ 
																var arr = dojo.fromJson(data);
																self.set_number_new = arr[0]; // saved set number
															
															}
														}
													}
													var deferred = dojo.xhrGet(this.xhrArgs_set_buttons_);	
													deferred.then(function(data)
													{
														id = "button_set_" + self.set_number_new;	
														dojo.style(id, {
																	  "background-image": "url('../lib/css/images/button_set_green.png')",
																	  "height": "50px",
																	  "width": "50px"  
																	  });
													
													});							
												}
											
											}
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_mode_sync);	

								*/
								
									var deferred = dojo.xhrGet(this.xhrArgs_buttons); // refresh buttons	
								
									// tämä myöskin 2 kertaa ny
									this.xhrArgs_set_buttons_ = 
									{
										url: "save_washing_program.php/100",
										handleAs: "text",
										load: function(data)
										{
											if (data) 
											{ 
												var arr = dojo.fromJson(data);
												self.set_number_new = arr[0]; // saved set number
											
											}
										}
									}
									var deferred = dojo.xhrGet(this.xhrArgs_set_buttons_);	
									deferred.then(function(data)
									{
										id = "button_set_" + self.set_number_new;	
										dojo.style(id, {
													  "background-image": "url('../lib/css/images/button_set_green.png')",
													  "height": "50px",
													  "width": "50px"  
													  });
									
									});							
						}
						else // show old set if cancel is pressed
						{
	
							this.xhrArgs_set_buttons_ = 
							{
								url: "save_washing_program.php/100",
								handleAs: "text",
								load: function(data)
								{
									if (data) 
									{ 
										var arr = dojo.fromJson(data);
										self.set_number_new = arr[0]; // saved set number
									
									}
								}
							}
							var deferred = dojo.xhrGet(this.xhrArgs_set_buttons_);	
							deferred.then(function(data)
							{
								id = "button_set_" + self.set_number_new;	
								dojo.style(id, {
											  "background-image": "url('../lib/css/images/button_set_green.png')",
											  "height": "50px",
											  "width": "50px"  
											  });
							
							});		

						}
					}
				},
                command: function(command) 
                {
						switch(command)
						{
							case "start":
							
								if(this.mode == 1 && this.maintenance == 1) // if mode is ifsf maintenance is set
								{
									dojo.style("keyboard_start_wash", {
									"display": "block"
									});
									
									dojo.style("overlay", {
									"display": "block"
									});
									/*
									dojo.style("set_buttons", {
									"display": "none"
									});
									*/
									
									return;
								}
							
						         
								   if(this.mode == 1)
								   {
									   alert("Manual start is not allowed when IFSF is activated.");		
									   return;
								   }
									
									 
							
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
												var o_mas = arr.operation_mode_master;
												var o_sla = arr.operation_mode_slave;
											
												
												if(o_mas != null) // 
												{

													if((o_mas == 4 && o_sla == null) || (o_mas == 3 && o_sla == null) || (o_mas == 9 && o_sla == null)) // operation mode is customer entry or idle and machine type is single -> allow start
													{
														
														var xhrArgs = 
															{
																url: "run_command.php",
																postData: dojo.toJson({run_command:command, type:"single", prog_number:SelectedButton}),
																handleAs: "text"
															};
																var deferred = dojo.xhrPost(xhrArgs);
															console.log("start singelemachine wash" + SelectedButton);
													}
													else if((o_mas != 4 && o_sla == null) || (o_mas != 3 && o_sla == null) || (o_mas != 9 && o_sla == null)) // give error popup
													{
													
														switch(o_mas)
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
														
															alert("Wrong operation mode: "+operation_mode+". Should be in customer entry mode");		
													}

													if(o_mas == 4 && o_sla == 4 || o_mas == 3 && o_sla == 3 || o_mas == 9 && o_sla == 9) // operation mode is customer entry in both machines -> allow start
													{
														var xhrArgs = 
															{
																url: "run_command.php",
																postData: dojo.toJson({run_command:command, type:"twin", prog_number:SelectedButton}),
																handleAs: "text"
															};
																var deferred = dojo.xhrPost(xhrArgs);
														console.log("start twinmachine wash nro: "  + SelectedButton);
													}
													else if((o_mas != 4 && o_sla != null && o_sla != 4) || (o_mas != 3 && o_sla != null && o_sla != 3) || (o_mas != 9 && o_sla != null && o_sla != 9)) // give error popup
													{
													
														switch(o_mas)
														{
															case 1:operation_mode_mas =  resources.operation_mode_1;break;
															case 2:operation_mode_mas =  resources.operation_mode_2;break;
															case 3:operation_mode_mas =  resources.operation_mode_3;break;
															case 4:operation_mode_mas =  resources.operation_mode_4;break;
															case 5:operation_mode_mas =  resources.operation_mode_5;break;
															case 6:operation_mode_mas =  resources.operation_mode_6;break;
															case 7:operation_mode_mas =  resources.operation_mode_7;break;
															case 8:operation_mode_mas =  resources.operation_mode_8;break;
															case 9:operation_mode_mas =  resources.operation_mode_9;break;
														//	default:operation_mode =  resources.operation_mode_0;break;
														}
														
														switch(o_sla)
														{
															case 1:operation_mode_sla =  resources.operation_mode_1;break;
															case 2:operation_mode_sla =  resources.operation_mode_2;break;
															case 3:operation_mode_sla =  resources.operation_mode_3;break;
															case 4:operation_mode_sla =  resources.operation_mode_4;break;
															case 5:operation_mode_sla =  resources.operation_mode_5;break;
															case 6:operation_mode_sla =  resources.operation_mode_6;break;
															case 7:operation_mode_sla =  resources.operation_mode_7;break;
															case 8:operation_mode_sla =  resources.operation_mode_8;break;
															case 9:operation_mode_sla =  resources.operation_mode_9;break;
														//	default:operation_mode =  resources.operation_mode_0;break;
														}
														
															alert("Wrong operation mode(s). Master :"+operation_mode_mas+" Slave :"+operation_mode_sla + ". Machines should be in customer entry mode");		
													}
												}
											}
										}
									};
									
									var xhrArgs = 
									{
										url: "compare_passwords.php/",
										handleAs: "text",
										load: function(data)
										{
											if (data) 
											{
												var arr = dojo.fromJson(data);
												console.log("passu",arr.pass);
												if(arr.pass == 0000) // compare passwords
												{
													 dojo.style("keyboard_start_wash", {
													  "display": "none"
													  });
													  
													console.log("salasanaa ei tarvi kysya");
													var c = confirm("Start program number " + SelectedButton + "?");	
													if(c) 	
													{
														var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
													}
												}
												else
												{
														
												dojo.style("keyboard_start_wash", {
													  "display": "block"
													  });
													  
												dojo.style("overlay", {
													  "display": "block"
													  });

												}
											}
										},
										error: function(error)
										{
											console.log("error",error);
										}
									}
									var deferred = dojo.xhrGet(xhrArgs);
								
								
									
								
							break;
							case "stop":
							var c = confirm("Stop program: " +self.SelectedButton + " ?");
								if(c)
								{
									var xhrArgs = 
									{
									url: "run_command.php",
									postData: dojo.toJson({run_command:command, type:"twin", prog_number:self.SelectedButton}),
									handleAs: "text"
									};
									var deferred = dojo.xhrPost(xhrArgs);
								}
							break;
							case "pause":
							var c = confirm("Pause program: " +self.SelectedButton + " ?");
								if(c)
								{
									var xhrArgs = 
									{
									url: "run_command.php",
									postData: dojo.toJson({run_command:command, type:"twin", prog_number:self.SelectedButton}),
									handleAs: "text"
									};
									var deferred = dojo.xhrPost(xhrArgs);
								}
							break;
						}
                }
			}
        );
        });
    
