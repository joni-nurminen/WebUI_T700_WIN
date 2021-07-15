require([
	"dojo/_base/declare", 
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/EditPrograms/templates/EditPrograms.html",
	"dgrid/OnDemandGrid",
	"dgrid/Selection", 
	"dgrid/selector", 
	"dojo/store/Memory",
	"dojo/store/JsonRest", 
	"dojo/json",
	"dojo/dom-class",
	"dojo/io-query",
	"dojo/store/Cache", 
	"dijit/form/NumberSpinner",
	"dgrid/editor",
	"dgrid/Keyboard",
	"dojo/when",
	"dojo/html",
	"dojo/dom",
	"dojo/i18n!./lib/nls/resources.js",
	"lib/LangSupport", 
	"dijit/registry",
	"dojo/dom-construct",
	"dojo/domReady!",
	
	
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Grid,Selection,selector,Memory,JsonRest,json,domClass,ioQuery,Cache,NumberSpinner,editor,Keyboard, when,html,dom,resources,LangSupport,registry,domConstruct)
		{
			return  declare("EditPrograms", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				mainprogram: resources.mainprogram,
				sideprogram: resources.sideprogram,
				pass_style: resources.pass_style,
				washing_program: resources.washing_program,
				select_prog_type: resources.select_prog_type,
				special: resources.special,
				summer: resources.summer,
				winter: resources.winter,
				fast: resources.fast,
				load_save_set: resources.load_save_set,
				postCreate: function() 
				{

				    this.inherited(arguments);
					var domNode = this.domNode;
					var self = this;	
					var SelectedSlotNumber;
					var SelectedSet;
					this.ls = new LangSupport();
					var row = {};

					
					    // Connect buttons
					    dojo.connect(this.edit_button1, "onclick", null, function() { self.slotselected("1",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button2, "onclick", null, function() { self.slotselected("2",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button3, "onclick", null, function() { self.slotselected("3",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button4, "onclick", null, function() { self.slotselected("4",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button5, "onclick", null, function() { self.slotselected("5",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button6, "onclick", null, function() { self.slotselected("6",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button7, "onclick", null, function() { self.slotselected("7",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button8, "onclick", null, function() { self.slotselected("8",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button9, "onclick", null, function() { self.slotselected("9",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button10, "onclick", null, function() { self.slotselected("10",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button11, "onclick", null, function() { self.slotselected("11",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button11, "onclick", null, function() { self.slotselected("11",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button12, "onclick", null, function() { self.slotselected("12",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button13, "onclick", null, function() { self.slotselected("13",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button14, "onclick", null, function() { self.slotselected("14",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button15, "onclick", null, function() { self.slotselected("15",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });     

					    dojo.connect(this.edit_button16, "onclick", null, function() { self.slotselected("16",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button17, "onclick", null, function() { self.slotselected("17",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button18, "onclick", null, function() { self.slotselected("18",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button19, "onclick", null, function() { self.slotselected("19",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button20, "onclick", null, function() { self.slotselected("20",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button21, "onclick", null, function() { self.slotselected("21",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button22, "onclick", null, function() { self.slotselected("22",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button23, "onclick", null, function() { self.slotselected("23",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button24, "onclick", null, function() { self.slotselected("24",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button25, "onclick", null, function() { self.slotselected("25",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button26, "onclick", null, function() { self.slotselected("26",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button27, "onclick", null, function() { self.slotselected("27",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button28, "onclick", null, function() { self.slotselected("28",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button29, "onclick", null, function() { self.slotselected("29",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });
					    dojo.connect(this.edit_button30, "onclick", null, function() { self.slotselected("30",	self.grid_mainprogram_collection,	self.grid_sideprogram_collection); });    
						
						dojo.connect(this.button_load_set_1, "onclick", null, function() { self.load_set("1"); });
					    dojo.connect(this.button_load_set_2, "onclick", null, function() { self.load_set("2"); });
					    dojo.connect(this.button_load_set_3, "onclick", null, function() { self.load_set("3"); });
					    dojo.connect(this.button_load_set_4, "onclick", null, function() { self.load_set("4"); });    
						
						dojo.connect(this.button_save_set_1, "onclick", null, function() { self.save_set("1"); });
					    dojo.connect(this.button_save_set_2, "onclick", null, function() { self.save_set("2"); });
					    dojo.connect(this.button_save_set_3, "onclick", null, function() { self.save_set("3"); });
					    dojo.connect(this.button_save_set_4, "onclick", null, function() { self.save_set("4"); });    
						
					
					
					
						var tabs = registry.byId("pageTabContainer");
					
						tabs.watch("selectedChildWidget", function(name, oval, nval)
						{
							if(nval.id == "edit_programs")
							{
								dojo.style("maindiv_editprograms",{"display": "none"});
								dojo.style("loadingOverlay", {"display": "block"});
					
								this.xhrArgs_buttons = 
								{
									url: "save_washing_program.php/100",
									handleAs: "text",
									load: function(data)
									{
										if (data) 
										{ 
											var arr = dojo.fromJson(data);
											self.set_number = arr[0]; // saved set number
											console.log(self.set_number);									
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_buttons);	
								deferred.then(function(data)
								{
								//	alert(self.set_number);
									self.load_set(self.set_number); // show saved set
								});
								
								// update module information from the shared memory
								this.xhrArgs_getmodules = 
								{
									url: "get_modules_from_sharedmem.php",
									handleAs: "text",
									load: function(data)
									{
										if (data) 
										{ 
											var arr = dojo.fromJson(data);
											console.log(arr.message);	
											var color = dojo.style("shared_mem_ok_text").color;

											if(color == "rgb(255, 0, 0)") // offline
												dojo.byId("status").innerHTML = "Message: System is offline..." ;
											else // online
												dojo.byId("status").innerHTML = "Message: " + arr.message;											
										}
									}
								}
								var deferred = dojo.xhrGet(this.xhrArgs_getmodules);	
								deferred.then(function(data)
								{
								//	alert(self.set_number);
								//	self.load_set(self.set_number); // show saved set
								});
								setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
							}
							
						});          
					
				
						this.xhrArgs_buttons = 
						{
							url: "save_washing_program.php/100",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
									var arr = dojo.fromJson(data);
								//	self.set_number = arr[0]; // saved set number
									
									for(var j = 1; j<31; j++)
									{
									var str = "edit_button"+j;
									dojo.byId(str).innerHTML = "<div class='prog_button_empty' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+j+"</span></div>";
									
										for(var i = 1; i<arr.length; i++)
										{

												var type = arr[i].Program_Type;
												var slot = arr[i].SlotNumber;
												var str = "edit_button"+slot;
												
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
					/*
					deferred.then(function(data)
					{
						
							self.load_set(self.set_number); // show saved set
					});
					*/
					// get Mainprograms from the database
					 this.ProgramsStore_main = new Cache(new JsonRest({target:"get_editprograms_data.php/"}), new Memory());
					// console.log(this.ProgramsStore_main);
					

					var columns_main = [
						//   {label: resources.grid_header_main_program, field:"MainProgram"},
						 
						   {label: resources.mainprogram,
								get: function(object)
								{
								
									return self.ls.SetLangByLangId(object.LangId);
								}
						    },
						   editor({label: resources.speed, field: 'Speed_MainProgram',sortable:false,
						   editorArgs: { style: 'width: 55px; visibility: hidden; height: 0px;' ,value: 9, constraints: {min:0, max:9, places:0}}}, NumberSpinner),
						   editor({label: resources.cmr, field: 'Cmr_MainProgram',sortable:false,
						   editorArgs: { style: 'width: 55px; visibility: hidden; height: 0px;' ,value: 50, constraints: {min:0, max:100, places:0}}}, NumberSpinner)	


					];
					// get Sideprograms from the database
					ProgramsStore_side = new Cache(new JsonRest({target:"get_editprograms_data.php"}), new Memory());

					var columns_side = [
					selector({
							selectorType: 'checkbox',
							sortable:false,
							label: " "}
					), 
					{
						field: "SideProgram",
						sortable:false,
						label: resources.sideprogram,
						get: function (object) 
						{
						//		console.log(object);

								return self.ls.SetLangByLangId(object.LangId);
								
						}
					},
					editor({
							label: resources.cmr,
							sortable:false,
							field: 'Cmr_SideProgram',
							editorArgs: {
									style: 'width: 55px; visibility: hidden; height: 0px;',
									value: 50,
									constraints: {
											min: 0,
											max: 100,
											places: 0
									}
							}
					}, NumberSpinner)
				];
					
				 
						  
					// get PassStyles from the database
					ProgramsStore_pass = new Cache(new JsonRest({target:"get_editprograms_data.php"}), new Memory());
					var columns_pass = [
					{label:resources.pass, field:"PassStyle",sortable:false,
					get: function(object)
								{
								//	console.log(object);
										
									//return self.ls.SetLangByLangId(object.LangId);
									return object.PassStyle;
								}}

					];
					
					     // Create grid for pass styles
					this.grid_pass_style_collection = new (declare([Grid, Selection]))({
						  store: this.ProgramsStore_pass,
						  columns: columns_pass,
						  selectionMode: "single"
						  //query: {prg:'pass'}
					  }, "grid_pass_style");
						
						  
					  // Create grid for sideprograms
						this.grid_sideprogram_collection = new (declare([Grid, Selection]))({
							  store: this.ProgramsStore_side,
							  columns: columns_side,
							//  autoSave: true,
							  selectionMode: 'multiple'
							//  query: {prg:'side'}
						  }, "grid_sideprogram");
						  
						// Create grid for mainprograms
					    this.grid_mainprogram_collection = new (declare([Grid, Selection,Keyboard]))({
						  store: this.ProgramsStore_main,
						  columns: columns_main,
						 // autoSave: true,
						  selectionMode: "single",
					//	  query: {button:0}
					      }, "grid_mainprogram");

					 
						  
						  
							
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
					 this.grid_wash_program_collection = new (declare([Grid, Selection]))({
						  store: this.ProgramLineStore,
						  columns: columns_wash_program,
						  selectionMode: "single"
					//	  query: {button:1}
					  }, "grid_wash_program");	
					  
					  // Create grid for copied wash program 
					 this.grid_copied_wash_program_collection = new (declare([Grid, Selection]))({
						  store: this.ProgramLineStoreCopied,
						  columns: columns_wash_program,
						  selectionMode: "single"
					//	  query: {button:1}
					  }, "grid_copied_wash_program");	
					  
					  //button array
					this.buttons = [null,
						this.edit_button1,this.edit_button2,this.edit_button3,this.edit_button4,this.edit_button5,this.edit_button6,this.edit_button7,this.edit_button8,this.edit_button9,this.edit_button10,
						this.edit_button11,this.edit_button12,this.edit_button13,this.edit_button14,this.edit_button15,this.edit_button16,this.edit_button17,this.edit_button18,this.edit_button19,this.edit_button20,
						this.edit_button21,this.edit_button22,this.edit_button23,this.edit_button24,this.edit_button25,this.edit_button26,this.edit_button27,this.edit_button28,this.edit_button29,this.edit_button30
						];
					this.selected_button = false;
					
					// First program is selected by default
					self.slotselected("1");	
									
					  
					  this.grid_mainprogram_collection.on("dgrid-select", function(event)
						{
							/*
							var objekti = self.grid_mainprogram_collection.store.get(event.rows[0].data.LangIdMain);
							console.log("main Object ", objekti);
							
							objekti.Speed_MainProgram = event.rows[0].data.Speed_MainProgram;
							objekti.Cmr_MainProgram = event.rows[0].data.Cmr_MainProgram;
							
							console.log("uus objekti ", objekti);
							
							self.grid_mainprogram_collection.store.put(objekti, {overwrite: true}); // set speed and cmr information to mainprogram from the selected row
							self.grid_mainprogram_collection.refresh();
							*/
							/*
							var len = self.grid_wash_program_collection.store.data.length;
							var i = 0;
							for (i=0;i<len;i++)
							{
								if(self.grid_wash_program_collection.store.data[i].LangIdMain == event.rows[0].data.id)
								{
									console.log(self.grid_wash_program_collection.store.data[i].LangIdMain);
									self.grid_mainprogram_collection.store.data[i].Cmr_MainProgram = event.rows[0].data.Cmr_MainProgram;
								}
							}
							*/
						//	self.grid_mainprogram_collection.store.data[i].Cmr_SideProgram = self.grid_mainprogram_collection.store.data[selected].Cmr_SideProgram4
						//	console.log("grid_mainprogram_collection");
							self.mainSelected(event, self.grid_wash_program_collection);
							self.grid_mainprogram_collection.row(event.rows[0].data.id).element.scrollIntoView();

						});
					   this.grid_mainprogram_collection.on("dgrid-deselect", function(event)
						{
							self.mainDeSelected(event);
							
						});
					  this.grid_sideprogram_collection.on("dgrid-select", function(event)
						{
							/*
							var array = []; 
							// get real cmr values from the washing editor
							array.push(self.grid_wash_program_collection.store.data[0].Cmr_SideProgram1);
							array.push(self.grid_wash_program_collection.store.data[0].Cmr_SideProgram2);
							array.push(self.grid_wash_program_collection.store.data[0].Cmr_SideProgram3);
							array.push(self.grid_wash_program_collection.store.data[0].Cmr_SideProgram4);
							array.push(self.grid_wash_program_collection.store.data[0].Cmr_SideProgram5);
					
							console.log("array "+ array);

							var len = self.grid_sideprogram_collection.store.data.length;
							var i = 0;
							for (i=0;i<len;i++)
							{
								if(typeof array[i] !== 'undefined')
									self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = array[i];
							}
							
							
							console.log("grid_sideprogram_collection ", self.grid_sideprogram_collection.store.data);
							*/
							self.sideSelected(event);

						});
					  this.grid_sideprogram_collection.on("dgrid-deselect", function(event)
						{
							self.sideDeSelected(event);
						});
					  this.grid_wash_program_collection.on("dgrid-select", function(event)
						{
								
							/*
							var objekti = self.grid_mainprogram_collection.store.get(event.rows[0].data.LangIdMain);
							console.log("main Object ", objekti);


							objekti.Speed_MainProgram = event.rows[0].data.Speed_MainProgram;
							objekti.Cmr_MainProgram = event.rows[0].data.Cmr_MainProgram;
							
							console.log("uus objekti ", objekti);
							
							self.grid_mainprogram_collection.store.put(objekti, {overwrite:true}); // set speed and cmr information to mainprogram from the selected row
							
							
							
							self.grid_mainprogram_collection.clearSelection(); // clear selections
							*/
							//self.grid_mainprogram_collection.refresh();
							//self.grid_mainprogram_collection.refresh();
							self.mainSelected(event, self.grid_mainprogram_collection);

					
							//self.grid_mainprogram_collection.select(event.rows[0].data.LangIdMain); // select row from the mainprograms
						//	self.grid_mainprogram_collection.row(event.rows[0].data.LangIdMain).element.scrollIntoView();

						});
					


						dojo.connect(this.move_line, "onclick", null, function() 
						{self.move_pressed(	self.grid_mainprogram_collection, 
										self.grid_sideprogram_collection, 
										self.grid_wash_program_collection,
										self.grid_pass_style_collection,
										self.ProgramLineStore); });	
						
						dojo.connect(this.copy_program, "onclick", null, function() 
						{self.copy_program_pressed(); });	
						
						dojo.connect(this.show_copied_program, "onclick", null, function() 
						{self.show_copied_program_pressed(self.grid_copied_wash_program_collection, self.ProgramLineStoreCopied); });	
						
						dojo.connect(this.hide_copied_program, "onclick", null, function() 
						{self.hide_copied_program_pressed(); });		
						
						dojo.connect(this.paste_program, "onclick", null, function() 
						{self.paste_program_pressed(); });		
						
						dojo.connect(this.save_program, "onclick", null, function() 
						{self.save_pressed(); });		
						
						dojo.connect(this.remove_line, "onclick", null, function() 
						{self.remove_line_pressed(); });		
						
						dojo.connect(this.copy_line, "onclick", null, function() 
						{self.copy_line_pressed(); });		
						
						dojo.connect(this.paste_line_up, "onclick", null, function() 
						{self.paste_line_pressed_up(); });		
						
						dojo.connect(this.paste_line_mid, "onclick", null, function() 
						{self.paste_line_pressed_mid(); });		
						
						dojo.connect(this.paste_line_down, "onclick", null, function() 
						{self.paste_line_pressed_down(); });		
						
						dojo.connect(this.remove_all, "onclick", null, function() 
						{self.remove_all_pressed(); });								
										
			    },
				
				load_set: function(set)
				{
				//	dojo.style("maindiv_editprograms",{"display": "none"});
				//	dojo.style("loadingOverlay", {"display": "block"});

					
					dojo.style("button_load_set_1", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue_small.png')",
								  "height": "30px",
								  "width": "30px"  
								  });
					
					dojo.style("button_load_set_2", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue_small.png')",
								  "height": "30px",
								  "width": "30px"  
								  });
					
					dojo.style("button_load_set_3", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue_small.png')",
								  "height": "30px",
								  "width": "30px"  
								  });
					
					dojo.style("button_load_set_4", {
								  "backgroundImage": "url('../lib/css/images/button_set_blue_small.png')",
								  "height": "30px",
								  "width": "30px"  
								  });					
				
				id = "button_load_set_" + set;
				
			
				//var c = confirm("Load set " + set+" ?");
									
			//		if(c)	// load saved set	
					//{
						var xhrArgs = 
						{
							  url: "import_database.php/"+set,
							  postData: dojo.toJson({load_set:set}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);
					//	alert("import set " + set);
						var deferred = dojo.xhrGet(this.xhrArgs_buttons); // refresh buttons
						deferred.then(function(data)
								{
									dojo.style("maindiv_editprograms",{"display": "block"});
									dojo.style("loadingOverlay", {"display": "none"});

								});
						
						dojo.style(id, {
									 // "backgroundImage": "url('../lib/css/images/button_set_green_small.png')",
									  "backgroundImage": "url('../lib/css/images/button_set_green_small.png')",
									  "height": "30px",
									  "width": "30px"  
									  });
									  /*
					this.old_set = id;				  
					}	
					else // if cancelled select old one
					{
						dojo.style(this.old_set, {
									  "background-image": "url('../dev_versio/lib/css/images/button_set_green_small.png')",
									  "height": "30px",
									  "width": "30px"  
									  });
					}*/

					SelectedSet = set;
					console.log(SelectedSet);
				},
				save_set: function(set)
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
							
				var c = confirm("Save set " + set_d+ " to database ??");
									
					if(c) // save set	
					{
					/*
						var c = confirm("Start sync ?");
						if(c)
						{
							dojo.style("maindiv_editprograms", 
							{
							  "visibility": "hidden",
							  "overflow": "hidden",								  
							});
							// hide everything
							dojo.query(".move_line_button").style("visibility", "hidden");
							dojo.query(".dijitSpinner").style("visibility", "hidden");
							dojo.query("input.dijitReset.dijitInputField.dijitSpinnerButtonInner").style("height", "auto");
							dojo.query(".dijitSpinner").style("height", "0px");
							
							dojo.byId("sync").innerHTML = "<span style='font-size:32px; visibility:visible; text-align:center; width:100%;'><b>Sync in progress.. Please wait<b></span>";
						}
						else
						{
							return;
						}	
						*/
						var xhrArgs = 
						{
							  url: "export_database.php/"+set,
							  postData: dojo.toJson({save_set:set}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
	/*
						this.xhrArgs_mode = 
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
												dojo.style("maindiv_editprograms", 
												{
												  "visibility": "visible",
												  "overflow": "visible",								  
												});
												alert("Command not Allowed ! Wrong Operation mode : "+operation_mode + " Operation cancelled..");		

										}
										else
										{
											
											if(arr.sync_done == "done")
											{
												// show everything when sync is done
												dojo.style("maindiv_editprograms", 
												{
												  "visibility": "visible",
												  "overflow": "visible",								  
												});
												
												dojo.byId("sync").innerHTML = "<span style='font-size:1px; visibility:visible; text-align:center; width:100%;'></span>";

											}

										}
									}
								}
							}
								var deferred = dojo.xhrGet(this.xhrArgs_mode);	
							*/
						
					}	
				},
				slotselected: function(button, main_prog_grid, side_prog_grid) 
				{
					console.log("slot ", button, main_prog_grid);

					if(main_prog_grid)
					{
						main_prog_grid.clearSelection();
					//	main_prog_grid.refresh();
					}
					if(side_prog_grid)
					{
						side_prog_grid.clearSelection();
						side_prog_grid.refresh();
					}
					
				   // get selected slotnumber
				   this.SelectedSlotNumber = button;
				   var self = this;
				   // remove default selection
				   domClass.remove(this.buttons[parseInt(1)], "selected_program");
					
						var id = "edit_button" + button;

						for(var j = 1; j<31; j++)
						{
							var idc = "edit_button"+j;
							dojo.style(idc, {
							  "color": "black",
							  "fontSize": "18px"
							  });
						}			
						
						dojo.style(id, {
							  "color": "green",
							  "fontSize": "30px"
							  });

				   if (this.selected_button)
					domClass.remove(this.selected_button, "selected_program");
				   this.selected_button = this.buttons[parseInt(button)];
				   domClass.add(this.selected_button, "selected_program");
						   
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
									
								if(arr == null)
								{
									self.grid_wash_program_collection.store = self.ProgramLineStore;
									self.grid_wash_program_collection.refresh();
									dojo.query(".copy_program_button").style("visibility", "hidden");
									dojo.query(".copy_line").style("visibility", "hidden");
									dojo.query(".paste_line_up").style("visibility", "hidden");
									dojo.query(".paste_line_mid").style("visibility", "hidden");
									dojo.query(".paste_line_down").style("visibility", "hidden");
									dojo.query(".remove_line").style("visibility", "hidden");
									dojo.query(".save_program").style("visibility", "hidden");
									dojo.query(".remove_all").style("visibility", "hidden");
									dojo.query(".paste_program_button").style("visibility", "visible");
									dojo.query(".show_copied_program_button").style("visibility", "visible");
									return;
								}
								
								dojo.query(".paste_line_up").style("visibility", "hidden");
								dojo.query(".paste_line_mid").style("visibility", "hidden");
								dojo.query(".paste_line_down").style("visibility", "hidden");
								dojo.query(".copy_line").style("visibility", "hidden");
								dojo.query(".remove_line").style("visibility", "hidden");
								dojo.query(".save_program").style("visibility", "visible");
								dojo.query(".remove_all").style("visibility", "visible");
									
								dojo.query(".copy_program_button").style("visibility", "visible");
								dojo.query(".paste_program_button").style("visibility", "hidden");
								dojo.query(".draglistarea_blue_copy_program").style("visibility", "hidden");
								dojo.query(".draglistarea_blue_copy_program").style("height", "0px");
								var Program_Type =  arr[0].Program_Type; 
								
									switch(Program_Type)
										{
											case "none": dijit.byId("none").set('checked', true); break;
											case "summer_program": dijit.byId("summer_program").set('checked', true); break;
											case "winter_program": dijit.byId("winter_program").set('checked', true); break;
											case "fast_program": dijit.byId("fast_program").set('checked', true); break;
										}
								
								if(arr != null)
								{
									for(var i=0; i < arr.length; i++) 
									{
										self.ProgramLineStore.put(arr[i]);
									}
								}
							}
							self.grid_wash_program_collection.store = self.ProgramLineStore;
							self.grid_wash_program_collection.refresh();

						},
						error: function(error)
						{
							self.grid_wash_program_collection.store = self.ProgramLineStore;
							self.grid_wash_program_collection.refresh();
						}
					}

					var deferred = dojo.xhrGet(xhrArgs);	

					  dojo.byId("header_status").innerHTML = "Save slot <b>" + button + "</b> is selected<br>" +  dojo.byId("header_status").innerHTML;

				},
				mainSelected : function(event, collection) 
				{
					console.log("mainSelected", event.grid.id, collection.id);

					if(event.grid.id == "grid_wash_program")
					{
						console.log("grid_wash_program");
					//	collection.select(event.rows[0].data.LangIdMain); // select row from the mainprograms
					//	self.grid_mainprogram_collection.select(event.rows[0].data.LangIdMain);
						console.log("main selected", collection.selection);
						dojo.query(".copy_line").style("visibility", "visible");
						dojo.query(".paste_line_up").style("visibility", "visible");
						dojo.query(".paste_line_mid").style("visibility", "visible");
						dojo.query(".paste_line_down").style("visibility", "visible");
						dojo.query(".remove_line").style("visibility", "visible");
						
						this.xhrArgs_getMainProgramList = 
						{
							url: "get_editprograms_data.php?prg=main",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{

								}
							}
						}
						var deferred = dojo.xhrGet(this.xhrArgs_getMainProgramList);
						deferred.then(function(data)
						{
							var arr = dojo.fromJson(data);
							self.grid_mainprogram_collection.store = new Memory({data:arr});
							console.log(" main store",self.grid_mainprogram_collection.store);
						//	self.grid_mainprogram_collection.refresh();
							self.grid_mainprogram_collection.clearSelection(); // clear selections
						
							for(var i = 0; i<self.grid_mainprogram_collection.store.data.length; i++)
							{
								if(self.grid_mainprogram_collection.store.data[i].LangId == event.rows[0].data.LangIdMain)
								{
									self.grid_mainprogram_collection.store.data[i].Cmr_MainProgram = event.rows[0].data.Cmr_MainProgram;
									self.grid_mainprogram_collection.store.data[i].Speed_MainProgram = event.rows[0].data.Speed_MainProgram;
								}
							}
							self.grid_mainprogram_collection.refresh();
							self.grid_mainprogram_collection.select(event.rows[0].data.LangIdMain);
							
							console.log(" main store",self.grid_mainprogram_collection.store);
							 
						});				
												
					}
					if(event.grid.id == "grid_mainprogram")
					{
					//	collection.clearSelection();
						console.log("grid_mainprogram");
					//	self.grid_sideprogram_collection.clearSelection();

					}

				//		event.grid.refresh();
				
						console.log("event.rows[0].data.id = " + event.rows[0].data.id);
						self = this;	
						this.xhrArgs_getSideProgramList = 
						{
						    url: "get_editprograms_data.php?button="+(event.rows[0].data.id)+"&prg=side",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
									self.grid_pass_style_collection.clearSelection();
									 
									var arr = dojo.fromJson(data);
									self.grid_sideprogram_collection.store = new Memory({data:arr});
									console.log(" side store",self.grid_sideprogram_collection.store);
									self.grid_sideprogram_collection.refresh();
									
									if(self.grid_wash_program_collection._lastSelected == null)
										var selected = event.rows[0].data.LangIdMain;
									else
										var selected = self.grid_wash_program_collection._lastSelected.rowIndex;
									
									
									console.log("selected LangIdMain",selected+1);
									
									self.grid_sideprogram_collection.clearSelection();

									if(self.grid_wash_program_collection.selection[selected+1])
									{
										for(var i = 0; i<self.grid_sideprogram_collection.store.data.length; i++)
										{
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram1)
												self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = self.grid_wash_program_collection.store.data[selected].Cmr_SideProgram1
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram2)
												self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = self.grid_wash_program_collection.store.data[selected].Cmr_SideProgram2
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram3)
												self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = self.grid_wash_program_collection.store.data[selected].Cmr_SideProgram3
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram4)
												self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = self.grid_wash_program_collection.store.data[selected].Cmr_SideProgram4
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram5)
												self.grid_sideprogram_collection.store.data[i].Cmr_SideProgram = self.grid_wash_program_collection.store.data[selected].Cmr_SideProgram5
										}
										self.grid_sideprogram_collection.refresh();
										for(var i = 0; i<self.grid_sideprogram_collection.store.data.length; i++)
										{											
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram1)
												self.grid_sideprogram_collection.select(self.grid_sideprogram_collection.store.data[i].id);
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram2)
												self.grid_sideprogram_collection.select(self.grid_sideprogram_collection.store.data[i].id);
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram3)
												self.grid_sideprogram_collection.select(self.grid_sideprogram_collection.store.data[i].id);
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram4)
												self.grid_sideprogram_collection.select(self.grid_sideprogram_collection.store.data[i].id);
											if(self.grid_sideprogram_collection.store.data[i].SideProgram == self.grid_wash_program_collection.store.data[selected].SideProgram5)
												self.grid_sideprogram_collection.select(self.grid_sideprogram_collection.store.data[i].id);
										}
										
									}
									else
										self.grid_sideprogram_collection.clearSelection();
										
								}
							}
						}

				
						
					var deferred = dojo.xhrGet(this.xhrArgs_getSideProgramList);	
					deferred.then(function(data)
					{
					
						this.xhrArgs_PassStyles = 
						{
							url: "get_editprograms_data.php?button="+(event.rows[0].data.id)+"&prg=pass",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
			
								}
							}
						}
						var deferred = dojo.xhrGet(this.xhrArgs_PassStyles);	
						deferred.then(function(data)
						{
							var arr = dojo.fromJson(data);
							self.grid_pass_style_collection.store = new Memory({data:arr});
							
							 self.grid_pass_style_collection.refresh();
							 self.grid_pass_style_collection.clearSelection();
							 self.grid_pass_style_collection.select(1);
							 
								var pass_style =  self.grid_wash_program_collection.store.data[self.grid_wash_program_collection._lastSelected.rowIndex].PassStyle;

								
								for(var i=0;i<self.grid_pass_style_collection.store.data.length; i++)
								{
									//console.log("row : ", i ," pass: ", self.grid_pass_style_collection.store.data[i].PassStyle);
									if(self.grid_pass_style_collection.store.data[i].PassStyle == pass_style)
									{
										 self.grid_pass_style_collection.clearSelection();
									//	 console.log("select row " , i+1 , " passtyle ", pass_style);
										 self.grid_pass_style_collection.select(i+1);
									}
								}

						});
					
					});

						
					
					dojo.query(".dijitSpinner", event.rows[0].element).style("visibility", "visible");
					dojo.query(".copy_program_button").style("visibility", "hidden");
					dojo.query(".show_copied_program_button").style("visibility", "hidden");
					dojo.query(".paste_program_button").style("visibility", "hidden");
					dojo.query("input.dijitReset.dijitInputField.dijitSpinnerButtonInner", event.rows[0].element).style("height", "50px");
					dojo.query(".dijitSpinner", event.rows[0].element).style("height", "auto");
					dojo.query(".move_line_button").style("visibility", "visible");

				
										
						
				},
				mainDeSelected : function(event) 
				{
					dojo.query(".move_line_button").style("visibility", "hidden");
					dojo.query(".copy_program_button").style("visibility", "visible");
					dojo.query(".dijitSpinner", event.rows[0].element).style("visibility", "hidden");
					dojo.query("input.dijitReset.dijitInputField.dijitSpinnerButtonInner", event.rows[0].element).style("height", "auto");
					dojo.query(".dijitSpinner", event.rows[0].element).style("height", "0px");
				},
				sideSelected : function(event) 
				{
					//console.log("side selected", event);
					for(var i = 0; i < event.rows.length; i++)
					{
					//	console.log(event.rows[i].id);
						dojo.query(".dijitSpinner", event.rows[i].element).style("visibility", "visible");
						dojo.query("input.dijitReset.dijitInputField.dijitSpinnerButtonInner", event.rows[i].element).style("height", "50px");
						dojo.query(".dijitSpinner", event.rows[i].element).style("height", "auto");
					}
					

				},
				sideDeSelected : function(event) 
				{
					dojo.query(".dijitSpinner", event.rows[0].element).style("visibility", "hidden");
					dojo.query("input.dijitReset.dijitInputField.dijitSpinnerButtonInner", event.rows[0].element).style("height", "auto");
					dojo.query(".dijitSpinner", event.rows[0].element).style("height", "0px");
				},
				// Save created washingprogram to database
				save_pressed:  function()
				{

					var type = ProgramType.getValues();
					type = type.Program_Type;
					
			//		var set_number = ProgramSet.getValues();
			//		set_number = set_number.Program_Set;
				
					var program = [];
					
					var c = confirm("Save program to slot " + this.SelectedSlotNumber + " "
									+"Program type: " + type);
									
						if(c)
						{
							dojo.byId("status").innerHTML = "Starting to sync, Please wait..";
						
							var Parameters = [];
								if( this.grid_wash_program_collection.store.data.length == 0)
								{
								var xhrArgs = 
										{
											  url: "save_washing_program.php",
											  postData: dojo.toJson({deleteall:"delete", SlotNumber:this.SelectedSlotNumber}),
											  handleAs: "text",
											  load: function(data)
											  {
												if (data) 
												{ 
													var arr = dojo.fromJson(data);
													console.log(arr[0].message);									
												}
												dojo.byId("status").innerHTML = arr[0].message;
											  }
										  
										};
										var deferred = dojo.xhrPost(xhrArgs);	
								}

								console.log("delete send..");
								console.log("program len :", this.grid_wash_program_collection.store.data.length);
								
								
							for (var i=0; i< this.grid_wash_program_collection.store.data.length; i++)
							{
							   program.push( {	
										SlotNumber:			this.SelectedSlotNumber,
										id:					this.grid_wash_program_collection.store.data[i].id, 
										Direction:			this.grid_wash_program_collection.store.data[i].Direction,
										MainProgram:		this.grid_wash_program_collection.store.data[i].MainProgram,
										LangIdMain: 		this.grid_wash_program_collection.store.data[i].LangIdMain,
										Speed_MainProgram:	this.grid_wash_program_collection.store.data[i].Speed_MainProgram,
										Cmr_MainProgram:	this.grid_wash_program_collection.store.data[i].Cmr_MainProgram,
										PassStyle:			this.grid_wash_program_collection.store.data[i].PassStyle,
										SideProgram1:		this.grid_wash_program_collection.store.data[i].SideProgram1,
										LangIdSide1: 		this.grid_wash_program_collection.store.data[i].LangIdSide1,
										Cmr_SideProgram1:	this.grid_wash_program_collection.store.data[i].Cmr_SideProgram1,
										SideProgram2:		this.grid_wash_program_collection.store.data[i].SideProgram2,
										LangIdSide2: 		this.grid_wash_program_collection.store.data[i].LangIdSide2,
										Cmr_SideProgram2:	this.grid_wash_program_collection.store.data[i].Cmr_SideProgram2,
										SideProgram3:		this.grid_wash_program_collection.store.data[i].SideProgram3,
										LangIdSide3: 		this.grid_wash_program_collection.store.data[i].LangIdSide3,
										Cmr_SideProgram3:	this.grid_wash_program_collection.store.data[i].Cmr_SideProgram3,
										SideProgram4:		this.grid_wash_program_collection.store.data[i].SideProgram4,
										LangIdSide4: 		this.grid_wash_program_collection.store.data[i].LangIdSide4,
										Cmr_SideProgram4:	this.grid_wash_program_collection.store.data[i].Cmr_SideProgram4,
										SideProgram5:		this.grid_wash_program_collection.store.data[i].SideProgram5,
										LangIdSide5: 		this.grid_wash_program_collection.store.data[i].LangIdSide5,
										Cmr_SideProgram5:	this.grid_wash_program_collection.store.data[i].Cmr_SideProgram5,
										Program_Type:		type,
										Set_Number:			0
										
								});
							}
						//	program.push(type); // add savingtype. winter, summer, or fast
								console.log("ohjelma",program);
								var xhrArgs = 
									{
										  url: "save_washing_program.php",
										  postData: dojo.toJson(program),
										  handleAs: "text",
										  load: function(data)
										  {
											if (data) 
											{ 
												var arr = dojo.fromJson(data);
												console.log(arr[0].message);									
											}
											dojo.byId("status").innerHTML = arr[0].message;
									      }
									};
									if(program != null)
										var deferred = dojo.xhrPost(xhrArgs);	
										
									console.log("program send..",program);
									// refresh buttons
									this.xhrArgs_buttons = 
										{
											url: "save_washing_program.php/100",
											handleAs: "text",
											load: function(data)
											{
												if (data) 
												{
													var arr = dojo.fromJson(data);
												//	self.set_number = arr[0]; // saved set number
													
													for(var j = 1; j<31; j++)
													{
													var str = "edit_button"+j;
													dojo.byId(str).innerHTML = "<div class='prog_button_empty' id='"+str+"' data-dojo-attach-point='"+str+"'><span class='text_'>"+j+"</span></div>";
													
														for(var i = 1; i<arr.length; i++)
														{

																var type = arr[i].Program_Type;
																var slot = arr[i].SlotNumber;
																var str = "edit_button"+slot;
																
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
									
									
								//	var deferred = dojo.xhrGet(this.xhrArgs_buttons); // refresh buttons
								//	dojo.byId("header_status").innerHTML = "Program is saved to slotnumber <b>"  + this.SelectedSlotNumber+"</b><br>" + dojo.byId("header_status").innerHTML;
								this.save_set(SelectedSet);
								console.log(SelectedSet);
								setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field

						}
				},
				copy_program_pressed:  function()
				{
					console.log("copy proram pressed : ", this.SelectedSlotNumber);
					
						var xhrArgs = 
						{
							  url: "save_washing_program.php",
							  postData: dojo.toJson({copy:"copy_program",copy_slot:this.SelectedSlotNumber}),
							  handleAs: "text",
							  load: function(data)
							  {
									if (data) 
									{ 
										var arr = dojo.fromJson(data);
										console.log(arr);									
									}
									dojo.byId("status").innerHTML = arr.copy_done;
									console.log("posted");
							  },
							  error: function(error)
							  {
								// We'll 404 in the demo, but that's okay.  We don't have a 'postIt' service on the
								// docs server.
								//	dojo.byId("response2").innerHTML = "Message posted.";
									console.log("posted also");
							  }
						};
						var deferred = dojo.xhrPost(xhrArgs);
					
					dojo.query(".draglistarea_blue_copy_program").style("visibility", "hidden");
					dojo.query(".draglistarea_blue_copy_program").style("height", "0px");
					setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
				},
				paste_program_pressed:  function(grid_copied_wash_program_collection, ProgramLineStoreCopied)
				{
					console.log("paste_program_pressed ", this.SelectedSlotNumber);
					var c = confirm("Paste program to slot " + this.SelectedSlotNumber);
									
					if(c)
					{
						var xhrArgs = 
						{
							  url: "save_washing_program.php",
							  postData: dojo.toJson({copy:"copy_program_to_set", copy_slot:this.SelectedSlotNumber}),
							  handleAs: "text",
							  load: function(data)
							  {
										if (data) 
										{ 
											var arr = dojo.fromJson(data);
											console.log(arr);									
										}
										dojo.byId("status").innerHTML = arr.copy_done;
										console.log("posted");
							  },
							  error: function(error)
							  {
								// We'll 404 in the demo, but that's okay.  We don't have a 'postIt' service on the
								// docs server.
								//	dojo.byId("response2").innerHTML = "Message posted.";
									console.log("posted also");
							  }
							  
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						var deferred = dojo.xhrGet(this.xhrArgs_buttons); // refresh buttons
						this.save_set(SelectedSet);
						
						setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
					}
				},
				hide_copied_program_pressed:  function()
				{
					console.log("hide_copied_program_button_pressed");
					dojo.query(".show_copied_program_button").style("visibility", "visible");
					dojo.query(".hide_copied_program_button").style("visibility", "hidden");
					dojo.query(".draglistarea_blue_copy_program").style("visibility", "hidden");
					dojo.query(".draglistarea_blue_copy_program").style("height", "0px");
				},
				show_copied_program_pressed:  function(grid_copied_wash_program_collection, ProgramLineStoreCopied)
				{
					console.log("show_copied_program_pressed");
					
					console.log(dojo.query(".show_copied_program_button")[0].style.visibility);
					console.log(dojo.query(".hide_copied_program_button")[0].style.visibility);
					
					dojo.query(".show_copied_program_button").style("visibility", "hidden");
					dojo.query(".hide_copied_program_button").style("visibility", "visible");
					
					
					var ProgramLine = [];
					var ProgramLineStoreCopied = new Memory({data:ProgramLine});
					
					var xhrArgs = 
					{
						url: "save_washing_program.php/get_copied_program",
						handleAs: "text",
						load: function(data)
						{

							if (data) 
							{					
								var arr = dojo.fromJson(data);
								if(arr == null)
								{
									grid_copied_wash_program_collection.store = ProgramLineStoreCopied;
									grid_copied_wash_program_collection.refresh();
									return;
								}
								/*
								var Program_Type =  arr[0].Program_Type; 
								
									switch(Program_Type)
										{
											case "none": dijit.byId("none").set('checked', true); break;
											case "summer_program": dijit.byId("summer_program").set('checked', true); break;
											case "winter_program": dijit.byId("winter_program").set('checked', true); break;
											case "fast_program": dijit.byId("fast_program").set('checked', true); break;
										}
								*/

								if(arr != null)
								{
								
									for(var i=0; i < arr.length; i++) 
									{
										console.log(arr[i]);
										ProgramLineStoreCopied.put(arr[i]);
									}
								}
							}

							grid_copied_wash_program_collection.store = ProgramLineStoreCopied;
							grid_copied_wash_program_collection.refresh();

						},
						error: function(error)
						{
							grid_copied_wash_program_collection.store = ProgramLineStoreCopied;
							grid_copied_wash_program_collection.refresh();
						}
					}

					var deferred = dojo.xhrGet(xhrArgs);	
					
					dojo.query(".draglistarea_blue_copy_program").style("visibility", "visible");
					dojo.query(".draglistarea_blue_copy_program").style("height", "auto");
				},
				remove_all_pressed:  function()
				{
					var self = this;
					var c = confirm("Remove all lines");
						if(c)
						{
							
							var ProgramLine = [];
							self.ProgramLineStore = new Memory({data:ProgramLine});
							self.grid_wash_program_collection.store = self.ProgramLineStore;
					/*	for (var i = 0; i < this.grid_wash_program_collection.store.data.length; i++)
						{
					//	console.log(this.grid_wash_program_collection.store.data[i].id);
							this.ProgramLineStore.remove(this.grid_wash_program_collection.store.data[i].id);
							
						} */
							this.grid_wash_program_collection.refresh();	
					}
					
				},
				// copy selected line
				copy_line_pressed:  function()
				{
				
				
					for (var id in this.grid_wash_program_collection.selection)
					{
				//		var c = confirm("Copy selected line " + id + " ?");
				//		if(c)
				//		{
				//			console.log(id, "copied");
				//			console.log(this.grid_wash_program_collection.store.data[id-1]);

							this.row = this.deepCopy(this.grid_wash_program_collection.store.data[id-1]);
							dojo.byId("status").innerHTML = "Line number "+id+" copied";	
				//		}
					}
				
				setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
				},
				// paste selected line
				paste_line_pressed_up:  function()
				{
					console.log("paste line pressed up", this.grid_wash_program_collection.selection);
					for (var id in this.grid_wash_program_collection.selection)
					{
						console.log("row id : "+ id+  " copied row id : "+ this.row.id);
						this.row.id = id; // set id to be same as selected row id was

						console.log("copied row ",this.deepCopy(this.row));
						console.log("old store ",this.ProgramLineStore);
						
						var o ={};
						o = this.deepCopy(this.row);
						o.id=99;

						var data = this.grid_wash_program_collection.store.data;
						var newStore  = new Memory();
						console.log(data);
						var origlength = data.length;						
						var i = 0;
												
						//Find selected id and copy 2 new items
						for(i = 0; i < origlength; i++)
						{
							if((i+1) == id)
							{
								newStore.add(o);	
								newStore.add(data[i]);																																				
							}
							else
							{								
								newStore.add(data[i]);							
							}
						}
						//update id of remaining
						for(i=0; i < newStore.data.length; i++)
						{
								newStore.data[i].id = i+1;																
						}
						
						console.log("uus data ",newStore);
						
						
					
					console.log("new store ",this.ProgramLineStore);
					this.grid_wash_program_collection.store = newStore;
					this.grid_wash_program_collection.refresh();	
					self.save_pressed();
					self.slotselected(this.SelectedSlotNumber);	
					dojo.byId("status").innerHTML = "Line pasted up";
					setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
					}
				},
				paste_line_pressed_mid:  function()
				{
					console.log("paste line pressed mid", this.grid_wash_program_collection.selection);
					for (var id in this.grid_wash_program_collection.selection)
					{
						console.log("row id : "+ id+  " copied row id : "+ this.row.id);
						this.row.id = id; // set id to be same as selected row id was

						console.log("copied row ",this.deepCopy(this.row));
						console.log("old store ",this.ProgramLineStore);
						
						var o ={};
						o = this.deepCopy(this.row);
						//o.id=id;

						var obj={};
						obj = this.grid_wash_program_collection.store.get(id);
						
						obj.Cmr_MainProgram = o.Cmr_MainProgram;
						obj.Cmr_SideProgram1 = o.Cmr_SideProgram1;
						obj.Cmr_SideProgram2 = o.Cmr_SideProgram2;
						obj.Cmr_SideProgram3 = o.Cmr_SideProgram3;
						obj.Cmr_SideProgram4 = o.Cmr_SideProgram4;
						obj.Cmr_SideProgram5 = o.Cmr_SideProgram5;
					//	obj.Direction
						obj.LangIdMain = o.LangIdMain;
						obj.LangIdSide1 = o.LangIdSide1;
						obj.LangIdSide2 = o.LangIdSide2;
						obj.LangIdSide3 = o.LangIdSide3;
						obj.LangIdSide4 = o.LangIdSide4;
						obj.LangIdSide5 = o.LangIdSide5;
						obj.MainProgram = o.MainProgram;
						obj.PassStyle = o.PassStyle;
					//	obj.Program_Type
					//	obj.Set_Number
						obj.SideProgram1 = o.SideProgram1;
						obj.SideProgram2 = o.SideProgram2;
						obj.SideProgram3 = o.SideProgram3;
						obj.SideProgram4 = o.SideProgram4;
						obj.SideProgram5 = o.SideProgram5;
					//	obj.SlotNumber
						obj.Speed_MainProgram = o.Speed_MainProgram;
						
					}

					this.grid_wash_program_collection.refresh();	

					dojo.byId("status").innerHTML = "Line pasted mid";
					setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
					
				},
				paste_line_pressed_down:  function()
				{
					console.log("paste line pressed down", this.grid_wash_program_collection.selection);
					for (var id in this.grid_wash_program_collection.selection)
					{
						console.log("row id : "+ id+  " copied row id : "+ this.row.id);
						this.row.id = id; // set id to be same as selected row id was

						console.log("copied row ",this.deepCopy(this.row));
						console.log("old store ",this.ProgramLineStore);
						
						var o ={};
						o = this.deepCopy(this.row);
						o.id=0;

						var data = this.grid_wash_program_collection.store.data;
						var newStore  = new Memory();
						console.log(data);
						var origlength = data.length;						
						var i = 0;
												
						//Find selected id and copy 2 new items
						for(i = 0; i < origlength; i++)
						{
							if((i+1) == id)
							{
								newStore.add(data[i]);	
								newStore.add(o);																												
							}
							else
							{								
								newStore.add(data[i]);							
							}
						}
						//update id of remaining
						for(i=0; i < newStore.data.length; i++)
						{
								newStore.data[i].id = i+1;																
						}
						
						console.log("uus data ",newStore);
						
						
					}
					console.log("new store ",this.ProgramLineStore);
					this.grid_wash_program_collection.store = newStore;
					this.grid_wash_program_collection.refresh();	
					self.save_pressed();
					self.slotselected(this.SelectedSlotNumber);	
					dojo.byId("status").innerHTML = "Line pasted down";
					setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
				},
				remove_line_pressed:  function()
				{
					for (var id in this.grid_wash_program_collection.selection)
					{
						var c = confirm("Remove selected line " + id + " ?");
						if(c)
						{
							this.ProgramLineStore.remove(id);
							
							// Arto's kikkakutonen
							var data = this.grid_wash_program_collection.store.data;
							for (var i =parseInt(id)-1; i < data.length; i++)
							{
								data[i].id--;
								data[i].Index--;
							}

							// Arto's kikkakutonen
							this.grid_wash_program_collection.refresh();	
							var newStore  = new Memory();
							for(var i = 0; i < data.length; i++)
								newStore.put(data[i]);
							this.ProgramLineStore = newStore;
							this.grid_wash_program_collection.store = newStore;
							
							dojo.byId("status").innerHTML = "Line number "+id+" removed";
						}
					}
				setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
			//	dojo.byId("header_status").innerHTML = "Line number <b> "  + id + "</b> is removed<br>" + dojo.byId("header_status").innerHTML;
				},
				// collect selected data from the grids
				move_pressed : function(grid_mainprogram_collection, grid_sideprogram_collection, grid_wash_program_collection, grid_pass_style_collection, ProgramLineStore) 
				{				
					
					var ProgramLineObj = null;
					var SideProgs=new Array(); 
					var side=new Array(); 
					var count = 0;
					
					//collect data by selection from the mainprogram grid
			//		console.log(grid_mainprogram_collection);
					for (var id in grid_mainprogram_collection.selection)
					{

						var main = null;
						for (var drtId in grid_mainprogram_collection.dirty) 
						{
							if (drtId == id) 
							{
								main = {};
								var defaultObj = grid_mainprogram_collection.store.get(id);
								var defaultSpeed = defaultObj.Speed_MainProgram;
								var defaultCmr = defaultObj.Cmr_MainProgram;
								
							
								var dirtyObj = grid_mainprogram_collection.dirty[drtId];
									console.log(defaultSpeed, defaultCmr,dirtyObj.Cmr_MainProgram);
								main.id = drtId;
								
								if(dirtyObj.Speed_MainProgram != null)
									main.Speed_MainProgram = dirtyObj.Speed_MainProgram;
								else
									main.Speed_MainProgram = defaultSpeed;
									
								if(dirtyObj.Cmr_MainProgram != null)
									main.Cmr_MainProgram = dirtyObj.Cmr_MainProgram;
								else
									main.Cmr_MainProgram = defaultCmr;
								
								main.MainProgram = grid_mainprogram_collection.store.get(id).MainProgram;
								main.LangIdMain = grid_mainprogram_collection.store.get(id).LangId;
								
								console.log(main.Speed_MainProgram, main.Cmr_MainProgram);
								break;
							}
						}
						if (main == null) 
						{
							main = {};							
							var oldObj = grid_mainprogram_collection.store.get(id);
							main.id = oldObj.id;
							main.Speed_MainProgram = oldObj.Speed_MainProgram;
							main.Cmr_MainProgram = oldObj.Cmr_MainProgram;
							main.MainProgram = oldObj.MainProgram;
							main.LangIdMain = oldObj.LangId;
							
			//				console.log(main.Speed_MainProgram, main.Cmr_MainProgram);
						}

					}	
					ProgramLineObj = main;
					ProgramLineObj.id = ProgramLineStore.data.length+1;
					for (var id in grid_wash_program_collection.selection){
						ProgramLineObj.id = id;					
					}
					
				
					//collect data by selection from the sideprogram grid
					console.log(grid_sideprogram_collection);

					for (var id in grid_sideprogram_collection.selection)
					{
						SideProgs[count] = id;
						side[count] = null;

						for (var drtId in grid_sideprogram_collection.dirty) 
						{
							if (drtId == id) 
							{	
								var dirtyObj = grid_sideprogram_collection.dirty[drtId];
							//	console.log(dirtyObj.Cmr_SideProgram);
							//	console.log(dirtyObj,grid_sideprogram_collection.store.get(id).LangId, grid_sideprogram_collection.store.get(id).SideProgram);
								
								var defaultObj = grid_sideprogram_collection.store.get(id);
								
					
								side[count] = {};
								side[count].Cmr_SideProgram = grid_sideprogram_collection.dirty[drtId].Cmr_SideProgram;
								side[count].id = drtId;
								side[count].SideProgram = grid_sideprogram_collection.store.get(id).SideProgram;
								side[count].LangId = grid_sideprogram_collection.store.get(id).LangId;

								break;
							}
						}
						if (side[count] == null) 
						{
							side[count] = grid_sideprogram_collection.store.get(id);
						}
						count++;
						
					}			
					
				//	console.log(SideProgs.length);
					for(var i=0; i<SideProgs.length;i++)
					{
						console.log(side[i].LangId);
						switch (i) 
						{
							case 0:
								ProgramLineObj.LangIdSide1 = side[i].LangId;
								ProgramLineObj.SideProgram1 = side[i].SideProgram;
								ProgramLineObj.Cmr_SideProgram1 = side[i].Cmr_SideProgram;

								break;
							case 1:
								ProgramLineObj.LangIdSide2 = side[i].LangId;
								ProgramLineObj.SideProgram2 = side[i].SideProgram;
								ProgramLineObj.Cmr_SideProgram2 = side[i].Cmr_SideProgram;

								break;
							case 2:
								ProgramLineObj.LangIdSide3 = side[i].LangId;
								ProgramLineObj.SideProgram3 = side[i].SideProgram;
								ProgramLineObj.Cmr_SideProgram3 = side[i].Cmr_SideProgram;

								break;
							case 3:
								ProgramLineObj.LangIdSide4 = side[i].LangId;
								ProgramLineObj.SideProgram4 = side[i].SideProgram;
								ProgramLineObj.Cmr_SideProgram4 = side[i].Cmr_SideProgram;
								break;			
							case 4:
								ProgramLineObj.LangIdSide5 = side[i].LangId;
								ProgramLineObj.SideProgram5 = side[i].SideProgram;
								ProgramLineObj.Cmr_SideProgram5 = side[i].Cmr_SideProgram;
								break;											
						}
					}
					
				
					for (var id in grid_pass_style_collection.selection)
					{
						if(grid_pass_style_collection.store.data.length > 0)
							ProgramLineObj.PassStyle = grid_pass_style_collection.store.get(id).PassStyle;
					}
					
					ProgramLineObj.Index = ProgramLineObj.id;
					
					if(ProgramLineObj.id % 2)
					{
						ProgramLineObj.Direction = "<<<";
					//	dojo.query(".grid_wash_program", grid_pass_style_collection.rows[0].element).style("color", "red");
						}
					else
						ProgramLineObj.Direction = ">>>";
					
					
					ProgramLineStore.put(ProgramLineObj,{override:true});
				
				
					grid_wash_program_collection.refresh();	
					dojo.query(".save_program").style("visibility", "visible");
					dojo.query(".remove_all").style("visibility", "visible");

				},
				deepCopy : function (oldValue) 
				{ 
				  var newValue;
				  strValue = JSON.stringify(oldValue);
				  return newValue = JSON.parse(strValue);
				}
				
			    

			});		
    });
