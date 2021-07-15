require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/EditParameters/templates/EditParameters.html",
		"dijit/form/Button",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/store/JsonRest", 
		"dojo/store/Memory",
		"dojo/store/Cache", 
		"dgrid/OnDemandGrid",
		"dgrid/Selection", 
		"dgrid/Keyboard", 
		"dgrid/editor",
		"dijit/form/NumberSpinner",
		"dijit/registry",
		"dijit/form/FilteringSelect",
		"dojo/ready",
		"dojo/i18n!./lib/nls/resources.js",
		"dojo/dom",
		"dojo/html",
		"lib/LangSupport", 
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Button, 
			theme, xhr,JsonRest,Memory,Cache, Grid,Selection, Keyboard,editor, NumberSpinner,registry,
			FilteringSelect,ready,resources,dom,html,LangSupport)
		{
			return  declare("EditParameters", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				parameters: resources.parameters,
				select_param: resources.select_param,
				select_inv: resources.select_inv,
				reset_to_defaults: resources.reset_to_defaults,
				measurements: resources.measurements,
				machine_height: resources.machine_height,
				machine_height_kh: resources.machine_height_kh,
				hall_length: resources.hall_length,
				bay_dimensions: resources.bay_dimensions,
				reset_high_measuring: resources.reset_high_measuring,
				save_parameters: resources.save_parameters,
				inverter1: resources.inverter1,
				inverter2: resources.inverter2,
				inverter3: resources.inverter3,
				inverter4: resources.inverter4,
				reset_parameters: resources.reset_parameters,
				reset_gantry: resources.reset_gantry,
				reset_lift: resources.reset_lift,
				reset_brush: resources.reset_brush,
				reset_rotate: resources.reset_rotate,
				get_value: resources.get_value,
				set_value: resources.set_value,
				search: resources.search,
				postCreate: function() 
				{
					this.inherited(arguments);
					var domNode = this.domNode;
					var self = this;	
					var page;
					this.ls = new LangSupport();
					var spinnerValueId;
					var spinnerValueValue;
					var par_quantity = 135; // updKHu v4.7

					dojo.connect(this.button_save_selections, "onclick", null, function() { self.Save(); });	
						
					
					dojo.connect(this.button_inverter1, "onclick", null, function() { self.Inverter1(self); });
					dojo.connect(this.button_inverter2, "onclick", null, function() { self.Inverter2(self); });
					dojo.connect(this.button_inverter3, "onclick", null, function() { self.Inverter3(self); });
					dojo.connect(this.button_inverter4, "onclick", null, function() { self.Inverter4(self); });
					dojo.connect(this.button_reset_parameters, "onclick", null, function() { self.Reset_parameters(); });
					dojo.connect(this.button_reset_gantry_inv, "onclick", null, function() { self.Reset_gantry_inv(); });		
					dojo.connect(this.button_reset_lift_inv, "onclick", null, function() { self.Reset_lift_inv(); });		
					dojo.connect(this.button_reset_brush_inv, "onclick", null, function() { self.Reset_brush_inv(); });		
					dojo.connect(this.button_reset_rotate_inv, "onclick", null, function() { self.Reset_rotate_inv(); });		
					dojo.connect(this.button_reset_high_measuring, "onclick", null, function() { self.Reset_high_measuring(); });		
					dojo.connect(this.button_bay_dimensions, "onclick", null, function() { self.Show_bay_dimensions(); });					
					
					dojo.connect(this.button_get_value, "onclick", null, function() { self.Get_value_inv(self); });		
					dojo.connect(this.button_set_value, "onclick", null, function() { self.Set_value_inv(self); });	
					dojo.connect(this.button_search_value, "onclick", null, function() { self.Search(self); });	
						   	   
					var ProgramLine = [];
					this.ProgramLineStore = new Memory({data:ProgramLine});
					
					var ProgramLineInv1 = [];
					this.ProgramLineStoreInv1 = new Memory({data:ProgramLineInv1});
						
						var DefaultsStore = new Memory({
							data: [
								{name:"Nothing", id_d:"1"},
								{name:"Parameters", id_d:"2"},
								{name:"Gantry-inv", id_d:"3"},
								{name:"Lift-inv", id_d:"4"}
							]
						});
						
						var ParametersStore = new Memory({
							data: [
								{name:resources.param_1, get: function(object)
										{
											return self.ls.SetLangByLangId("param_1");
										}, id:"1"},
								{name:resources.param_2, get: function(object)
										{
											return self.ls.SetLangByLangId("param_2");
										}, id:"2"},
								{name:resources.param_3, get: function(object)
										{
											return self.ls.SetLangByLangId("param_3");
										}, id:"3"},
								{name:resources.param_4, get: function(object)
										{
											return self.ls.SetLangByLangId("param_4");
										}, id:"4"},
								{name:resources.param_5, get: function(object)
										{
											return self.ls.SetLangByLangId("param_5");
										}, id:"5"},
								{name:resources.param_6, get: function(object)
										{
											return self.ls.SetLangByLangId("param_6");
										}, id:"6"},
								{name:resources.param_7, get: function(object)
										{
											return self.ls.SetLangByLangId("param_7");
										}, id:"7"},
								{name:resources.param_8, get: function(object)
										{
											return self.ls.SetLangByLangId("param_8");
										}, id:"8"},
								{name:resources.param_9, get: function(object)
										{
											return self.ls.SetLangByLangId("param_9");
										}, id:"9"},
								{name:resources.param_10, get: function(object)
										{
											return self.ls.SetLangByLangId("param_10");
										}, id:"10"},
								{name:resources.param_11, get: function(object)
										{
											return self.ls.SetLangByLangId("param_11");
										}, id:"11"},
								{name:resources.param_12, get: function(object)
										{
											return self.ls.SetLangByLangId("param_12");
										}, id:"12"},
								{name:resources.param_13, get: function(object)
										{
											return self.ls.SetLangByLangId("param_13");
										}, id:"13"},
								{name:resources.param_14, get: function(object)
										{
											return self.ls.SetLangByLangId("param_14");
										}, id:"14"},
								{name:resources.param_15, get: function(object)
										{
											return self.ls.SetLangByLangId("param_15");
										}, id:"15"},
								{name:resources.param_16, get: function(object)
										{
											return self.ls.SetLangByLangId("param_16");
										}, id:"16"},
								{name:resources.param_17, get: function(object)
										{
											return self.ls.SetLangByLangId("param_17");
										}, id:"17"},
								{name:resources.param_18, get: function(object)
										{
											return self.ls.SetLangByLangId("param_18");
										}, id:"18"},
								{name:resources.param_19, get: function(object)
										{
											return self.ls.SetLangByLangId("param_19");
										}, id:"19"},
								{name:resources.param_20, get: function(object)
										{
											return self.ls.SetLangByLangId("param_20");
										}, id:"20"}
					//			{name:"Address search", id:"21"}
							]
						});
						
						ready(function()
						{
						
							var filteringSelect = new FilteringSelect({
								id: "id",
								name: "param",
								value: "select..",
								store: ParametersStore,
								searchAttr: "name",
								onChange: function(value)
								{
									dojo.style("buttons_table", {
									  "visibility": "hidden"
									  });
									  dojo.style("grid_editparameters", {
									  "visibility": "visible",
									  "height":"530px"
									  });
									   dojo.style("grid_editinverters", {
									  "visibility": "hidden",
									  "height":"0px"
									  });
									  dojo.style("grid_editinverters2", {
									  "visibility": "hidden",
									  "height":"0px"
									  });
									   dojo.style("grid_editinverters3", {
									  "visibility": "hidden",
									  "height":"0px"
									  });
									   dojo.style("grid_editinverters4", {
									  "visibility": "hidden",
									  "height":"0px"
									  });
									    dojo.style("grid_search", {
									  "visibility": "hidden",
									  "height":"0px"
									  }); 
									  
									var xhrArgs = 
									{
										url: "get_editparams_data.php/"+value,
										handleAs: "text",
										load: function(data)
										{
											if (data) 
											{
												var arr = dojo.fromJson(data);

												self.ProgramLineStore = new Memory({data:[]});
												for(var i=0; i < arr.length; i++) 
												{
													if(arr[i].langid == 0)
													{
														par_quantity = arr[i].value;
														continue;
													}
													if(arr[i].langid > par_quantity)
														break; // Parametrien max määrä 135 vai 150 ? updKHu v4.7
													if(arr[i].ischanged == 1 || arr[i].ischanged == null)
														self.ProgramLineStore.put(arr[i]);
												}
												
											}
																					
													self.grid_editparams_collection.store = self.ProgramLineStore;
													self.grid_editparams_collection.refresh();
											

										},
										error: function(error)
										{
											self.grid_editparams_collection.store = self.ProgramLineStore;
											self.grid_editparams_collection.refresh();
										}
									}

									var deferred = dojo.xhrGet(xhrArgs);	
								
								},
							}, "ParamSelect");
							
						});
						

					Store_parameters = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());
					var columns_parameters = 
					[
						{label:resources.id, field:"langid",sortable:true},
						{label:resources.parameter, field:"param",sortable:false, get: function(object)
								{
									return self.ls.SetLangByLangId("paramid_"+object.langid);
								}
						},
						{label:resources.default_value, field:"default_value",sortable:true},
						editor({label:resources.value,sortable:false, field: 'value',
						editorArgs: { style: 'width: 85px; height: 55px;' , constraints: {min:0, max:500000, places:0}}}, NumberSpinner)
										
					];
					
					this.grid_editparams_collection = new (declare([Grid, Selection]))({
							  store: Store_parameters,
							  columns: columns_parameters,
							  selectionMode: 'single'
						  }, "grid_editparameters");
						  
					Store_parameters_inv1 = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());	  
					var columns_parameters_inv1 = 
					[
						editor({label:resources.id, field: 'langid',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner),
						{label:resources.parameter, field:"param"},
						{label:resources.default_value, field:"default_value"},
						editor({label:resources.value, field: 'value',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner)
										
					];
							
					this.grid_editparams_collection_inv1 = new (declare([Grid, Selection, Keyboard]))({
							  store: Store_parameters_inv1,
							  columns: columns_parameters_inv1,
							  selectionMode: 'single'
						  }, "grid_editinverters");    
						  
					Store_parameters_inv2 = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());	  
					var columns_parameters_inv2 = 
					[
						editor({label:resources.id, field: 'langid',
						editorArgs: { style: 'width: 85px; height: 55px;' ,intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner),
						{label:resources.parameter, field:"param"},
						{label:resources.default_value, field:"default_value"},
						editor({label:resources.value, field: 'value',
						editorArgs: { style: 'width: 85px; height: 55px;' ,intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner)
										
					];
							
					this.grid_editparams_collection_inv2 = new (declare([Grid, Selection, Keyboard]))({
							  store: Store_parameters_inv2,
							  columns: columns_parameters_inv2,
							  selectionMode: 'single'
						  }, "grid_editinverters2");    	
					
						  
					Store_parameters_inv3 = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());	  
					var columns_parameters_inv3 = 
					[
						editor({label:resources.id, field: 'langid',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner),
						{label:resources.parameter, field:"param"},
						{label:resources.default_value, field:"default_value"},
						editor({label:resources.value, field: 'value',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner)
										
					];
							
					this.grid_editparams_collection_inv3 = new (declare([Grid, Selection, Keyboard]))({
							  store: Store_parameters_inv3,
							  columns: columns_parameters_inv3,
							  selectionMode: 'single'
						  }, "grid_editinverters3");    
					
						  
					Store_parameters_inv4 = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());	  
					var columns_parameters_inv4 = 
					[
						editor({label:resources.id, field: 'langid',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner),
						{label:resources.parameter, field:"param"},
						{label:resources.default_value, field:"default_value"},
						editor({label:resources.value, field: 'value',
						editorArgs: { style: 'width: 85px; height: 55px;',intermediateChanges:true , constraints: {min:0, max:5000, places:0}}}, NumberSpinner)
										
					];
							
					this.grid_editparams_collection_inv4 = new (declare([Grid, Selection, Keyboard]))({
							  store: Store_parameters_inv4,
							  columns: columns_parameters_inv4,
							  selectionMode: 'single'
						  }, "grid_editinverters4");
						  
					Store_search = new Cache(new JsonRest({target:"get_editparams_data.php"}), new Memory());	  
					var columns_search = 
					[
						editor({label:resources.id, field: 'langid',
						editorArgs: { style: 'width: 85px; height: 55px;' ,intermediateChanges:true, constraints: {min:0, max:135, places:0}}}, NumberSpinner),
						{label:resources.parameter,  field:"param", get: function(object)
								{
									return self.ls.SetLangByLangId("paramid_"+object.langid);
								}
						},
						{label:resources.default_value, field:"default_value"},
						editor({label:resources.value, field: 'value', editorArgs: { style: 'width: 85px; height: 55px;' ,intermediateChanges:true, constraints: {min:0, max:500000, places:0}}}, NumberSpinner)
										
					];
							
					this.grid_editparams_collection_search = new (declare([Grid, Selection, Keyboard]))({
							  store: Store_search,
							  columns: columns_search,
							  selectionMode: 'single'
						  }, "grid_search");    

					this.grid_editparams_collection_search.on("dgrid-datachange", function(evt)
					{
						if(evt.cell.column.id == 0) // id is changed
						{
							self.spinnerValueId = evt.value;
							console.log("search id changed: ", evt.oldValue, " -> ", evt.value);
						}
						if(evt.cell.column.id == 3) // value is changed
						{
							self.spinnerValueValue = evt.value;
							console.log("search value changed: ", evt.oldValue, " -> ", evt.value);
						}

					});
					
					this.grid_editparams_collection_inv1.on("dgrid-datachange", function(evt)
					{
						if(evt.cell.column.id == 0) // id is changed
						{
							self.spinnerValueId = evt.value;
							console.log("inv1 id changed: ", evt.oldValue, " -> ", evt.value);
						}
						if(evt.cell.column.id == 3) // value is changed
						{
							self.spinnerValueValue = evt.value;
							console.log("inv1 value changed: ", evt.oldValue, " -> ", evt.value);
						}

					});
					
					this.grid_editparams_collection_inv2.on("dgrid-datachange", function(evt)
					{
						if(evt.cell.column.id == 0) // id is changed
						{
							self.spinnerValueId = evt.value;
							console.log("inv2 id changed: ", evt.oldValue, " -> ", evt.value);
						}
						if(evt.cell.column.id == 3) // value is changed
						{
							self.spinnerValueValue = evt.value;
							console.log("inv2 value changed: ", evt.oldValue, " -> ", evt.value);
						}

					});
					
					this.grid_editparams_collection_inv3.on("dgrid-datachange", function(evt)
					{
						if(evt.cell.column.id == 0) // id is changed
						{
							self.spinnerValueId = evt.value;
							console.log("inv3 id changed: ", evt.oldValue, " -> ", evt.value);
						}
						if(evt.cell.column.id == 3) // value is changed
						{
							self.spinnerValueValue = evt.value;
							console.log("inv3 value changed: ", evt.oldValue, " -> ", evt.value);
						}

					});
					
					this.grid_editparams_collection_inv4.on("dgrid-datachange", function(evt)
					{
						if(evt.cell.column.id == 0) // id is changed
						{
							self.spinnerValueId = evt.value;
							console.log("inv4 id changed: ", evt.oldValue, " -> ", evt.value);
						}
						if(evt.cell.column.id == 3) // value is changed
						{
							self.spinnerValueValue = evt.value;
							console.log("inv4 value changed: ", evt.oldValue, " -> ", evt.value);
						}

					});

				},
		Save: function()
		{
			values = {};
			values_arr = [];
			var lastSelected = this.grid_editparams_collection._lastSelected.id;
			var rowIndeksi = this.grid_editparams_collection._lastSelected.rowIndex;
			var n=lastSelected.split("-");
			var selectedId = n[n.length-1];

			
			var dirtyObj = this.grid_editparams_collection.dirty[selectedId];
			values.value = dirtyObj.value;
			values.langid = this.grid_editparams_collection.store.data[rowIndeksi].langid;
			values.command = "set";
			values_arr[0] = values;
			console.log(values);
			
//			var c = confirm("Set parameter value to : " +values.value+ "?"); // updKHu v4.7
			var c = confirm("Set parameter number:" + values.langid + " to :" + values.value + " ?");
				if(c) // save set	
				{
					dojo.byId("status").innerHTML = "Saving parameter(s). Please wait..";
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson(values_arr),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
							var arr = dojo.fromJson(response);
							dojo.byId("status").innerHTML = "Message: " + arr.response;	
							setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
						});
				}
		},
		Inverter1: function(self)
		{

			dojo.style("buttons_table", {
				  "visibility": "visible"
				  });
			dojo.style("grid_editparameters", {
				  "visibility": "hidden",
				  "height":"0px"
				  });  
			dojo.style("grid_editinverters", {
				  "visibility": "visible",
				   "height":"100px"
				  });  
			dojo.style("grid_editinverters2", {
				  "visibility": "hidden",
				  "height":"0px"
				  }); 
			dojo.style("grid_editinverters3", {
				  "visibility": "hidden",
				  "height":"0px"
				  }); 
			dojo.style("grid_editinverters4", {
				  "visibility": "hidden",
				  "height":"0px"
				  }); 
				   
		  dojo.style("grid_search", {
		  "visibility": "hidden",
		  "height":"0px"
		  }); 


							  
			var xhrArgs_inv1 = 
			{
				url: "get_editparams_data.php/22",
				handleAs: "text",
				load: function(data)
				{
					if (data) 
					{
						var arr = dojo.fromJson(data);

						self.ProgramLineStoreInv1 = new Memory({data:[]});
						
						for(var i=0; i < arr.length; i++) 
						{
							self.ProgramLineStoreInv1.put(arr[i]);
						}
						
					}
							self.grid_editparams_collection_inv1.store = self.ProgramLineStoreInv1;
							self.grid_editparams_collection_inv1.refresh();
				},
				error: function(error)
				{
					self.grid_editparams_collection_inv1.store = self.ProgramLineStoreInv1;
					self.grid_editparams_collection_inv1.refresh();
				}
			}

			var deferred = dojo.xhrGet(xhrArgs_inv1);	
			
			console.log("inverter1");
			page = "inv1";
		},
		Inverter2: function(self)
		{
			dojo.style("buttons_table", {
					  "visibility": "visible"
					  });
				dojo.style("grid_editparameters", {
					  "visibility": "hidden",
					  "height":"0px"
					  });  
				dojo.style("grid_editinverters", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters2", {
					  "visibility": "visible",
					   "height":"100px"
					  });  
				dojo.style("grid_editinverters3", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters4", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_search", {
					  "visibility": "hidden",
					  "height":"0px"
					  }); 

								  
				var xhrArgs_inv2 = 
				{
					url: "get_editparams_data.php/23",
					handleAs: "text",
					load: function(data)
					{
						if (data) 
						{
							var arr = dojo.fromJson(data);

							self.ProgramLineStoreInv2 = new Memory({data:[]});
							
							for(var i=0; i < arr.length; i++) 
							{
								self.ProgramLineStoreInv2.put(arr[i]);
							}
							
						}
								self.grid_editparams_collection_inv2.store = self.ProgramLineStoreInv2;
								self.grid_editparams_collection_inv2.refresh();
					},
					error: function(error)
					{
						self.grid_editparams_collection_inv2.store = self.ProgramLineStoreInv2;
						self.grid_editparams_collection_inv2.refresh();
					}
				}

				var deferred = dojo.xhrGet(xhrArgs_inv2);	

			console.log("inverter2");
			page = "inv2";
		},
		Inverter3: function(self)
		{
				dojo.style("buttons_table", {
					  "visibility": "visible"
					  });
				dojo.style("grid_editparameters", {
					  "visibility": "hidden",
					  "height":"0px"
					  });  
				dojo.style("grid_editinverters", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters2", {
					  "visibility": "hidden",
					   "height":"0px"
					  });  
				dojo.style("grid_editinverters3", {
					  "visibility": "visible",
					   "height":"100px"
					  });   
				dojo.style("grid_editinverters4", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_search", {
					  "visibility": "hidden",
					  "height":"0px"
					  }); 
			var xhrArgs_inv3 = 
				{
					url: "get_editparams_data.php/25",
					handleAs: "text",
					load: function(data)
					{
						if (data) 
						{
							var arr = dojo.fromJson(data);

							self.ProgramLineStoreInv3 = new Memory({data:[]});
							
							for(var i=0; i < arr.length; i++) 
							{
								self.ProgramLineStoreInv3.put(arr[i]);
							}
							
						}
								self.grid_editparams_collection_inv3.store = self.ProgramLineStoreInv3;
								self.grid_editparams_collection_inv3.refresh();
					},
					error: function(error)
					{
						self.grid_editparams_collection_inv3.store = self.ProgramLineStoreInv3;
						self.grid_editparams_collection_inv3.refresh();
					}
				}

				var deferred = dojo.xhrGet(xhrArgs_inv3);	
			console.log("inverter 3");
			page = "inv3";
		},
		Inverter4: function(self)
		{
				dojo.style("buttons_table", {
					  "visibility": "visible"
					  });
				dojo.style("grid_editparameters", {
					  "visibility": "hidden",
					  "height":"0px"
					  });  
				dojo.style("grid_editinverters", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters2", {
					  "visibility": "hidden",
					   "height":"0px"
					  });  
				dojo.style("grid_editinverters3", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters4", {
					  "visibility": "visible",
					   "height":"100px"
					  });   
				dojo.style("grid_search", {
					  "visibility": "hidden",
					  "height":"0px"
					  }); 
			var xhrArgs_inv4 = 
				{
					url: "get_editparams_data.php/26",
					handleAs: "text",
					load: function(data)
					{
						if (data) 
						{
							var arr = dojo.fromJson(data);

							self.ProgramLineStoreInv4 = new Memory({data:[]});
							
							for(var i=0; i < arr.length; i++) 
							{
								self.ProgramLineStoreInv4.put(arr[i]);
							}
							
						}
								self.grid_editparams_collection_inv4.store = self.ProgramLineStoreInv4;
								self.grid_editparams_collection_inv4.refresh();
					},
					error: function(error)
					{
						self.grid_editparams_collection_inv4.store = self.ProgramLineStoreInv4;
						self.grid_editparams_collection_inv4.refresh();
					}
				}

				var deferred = dojo.xhrGet(xhrArgs_inv4);	
			console.log("inverter 4");
			page = "inv4";
		},
		Reset_parameters: function()
		{
			var c = confirm("Do you want to reset parameters to Factory Default values ?");	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting  all parameters  to factory defaults";
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command_param:"params_reset",command:"set",value:0x1C,langid:0xF1}]),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
							var arr = dojo.fromJson(response);
							dojo.byId("status").innerHTML = "Message: " + response;	
							setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
						});
				}
			console.log("Reset_parameters");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Reset_gantry_inv: function()
		{
			var c = confirm('Do you want to reset Gantry-Converter to Factory Default values ?');	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting  gantry-Converter  to factory defaults";	
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command:"set", command_param:"gantry_reset",value:0xA1,langid:0xDE}]),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
						var arr = dojo.fromJson(response);
						dojo.byId("status").innerHTML = "Message: " + response;	
						});
				}
			console.log("Reset_gantry_inv");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Reset_lift_inv: function()
		{
			var c = confirm("Do you want to reset Lift-Converter to Factory Default values ?");	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting  Lift-Converter to factory defaults";	
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command:"set", command_param:"lift_reset",value:0xA2,langid:0xDE}]),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
							var arr = dojo.fromJson(response);
						dojo.byId("status").innerHTML = "Message: " + response;	
						});
				}
			console.log("Reset_lift_inv");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Reset_brush_inv: function()
		{
			var c = confirm("Do you want to reset Brush-Converter to Factory Default values ?");	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting  brush-Converter to factory defaults";	
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command:"set", command_param:"brush_reset",value:0xA3,langid:0xDE}]),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
						//	alert('returned ' + response);
						var arr = dojo.fromJson(response);
						dojo.byId("status").innerHTML = "Message: " + response;	
						});
				}
			console.log("Reset_brush_inv");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Reset_rotate_inv: function()
		{
			var c = confirm("Do you want to reset Rotate-Converter to Factory Default values ?");	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting rotate-converter to factory defaults";	
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command:"set", command_param:"rotate_reset",value:0xA4,langid:0xDE}]),
							  handleAs: "text",
							  load: function(data)
							  {
								if (data) 
								{ 
								//	var arr = dojo.fromJson(data);
								//	console.log("asasas",data);									
								}
								
						//		dojo.byId("status").innerHTML = data;
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
						deferred.then(function(response)
						{
							var arr = dojo.fromJson(response);
							dojo.byId("status").innerHTML = "Message: " + response;	
						});
				}
			console.log("Reset_rotate_inv");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Show_bay_dimensions: function()
		{
			var xhrArgs_meas = 
			{
				url: "get_editparams_data.php/meas",
				handleAs: "text",
				load: function(data)
				{
					if (data) 
					{
						var arr = dojo.fromJson(data);
						console.log("measdata ", arr);
						dojo.byId("machineHeight").innerHTML = arr.machine_height + " cm";	
						dojo.byId("machineHeightKh").innerHTML = arr.machine_height_kh + " cm";	
						dojo.byId("hallLength").innerHTML = arr.hall_length + " cm";	
					}

				}

			}

			 var deferred = dojo.xhrGet(xhrArgs_meas);	
			
			 var vis = dojo.style("bay_dimensions_div", "visibility");
			 console.log(vis);
			 
			 if(vis == "visible")
			 {
				dojo.query(".bay_dimensions_div").style("visibility", "hidden");
				dojo.query(".bay_dimensions_div").style("height", "0px");
			}
			 else
			 {
				dojo.query(".bay_dimensions_div").style("visibility", "visible");
					dojo.query(".bay_dimensions_div").style("height", "auto");
				}
		},
		Reset_high_measuring: function()
		{
			var c = confirm("Do you want to reset high measuring ?");	
				if(c) 	
				{
					dojo.byId("status").innerHTML = "Message: " + "Resetting high measuring";	
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson([{command:"set", command_param:"high_reset"}]),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
							var arr = dojo.fromJson(response);
							dojo.byId("status").innerHTML = "Message: " + response;	
							setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
						});
				}
			console.log("reset high measuring");
			setTimeout(function(){dojo.byId("status").innerHTML=""},5000); // clear information field
		},
		Get_value_inv: function(self)
		{
			values = {};
			values_arr = [];

			if(page == "search") // search button is pressed
			{
			//	console.log(self.grid_editparams_collection_inv1.store.data[0].langid);
			
				var defaultValue = self.grid_editparams_collection_search.store.data[0].langid;
				console.log(self.grid_editparams_collection_search);
				console.log(self.grid_editparams_collection_search._lastSelected);
				if(self.grid_editparams_collection_search._lastSelected != null) // nochange on spinner, use defaultvalue
				{
					var lastSelected = self.grid_editparams_collection_search._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_search._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_search.dirty[selectedId];
					
					if(dirtyObj.langid == null)
						dirtyObj.langid = defaultValue;
					
					values.value = dirtyObj.value;
					values.langid = dirtyObj.langid;
				}
				else
				{
					console.log("defaultValue " , defaultValue);
					values.langid = defaultValue;
				}
					
					
			}
			if(page == "inv1") // inverter1 button is pressed
			{
			//	console.log(self.grid_editparams_collection_inv1.store.data[0].langid);
				var defaultValue = self.grid_editparams_collection_inv1.store.data[0].langid;
				
				if(self.grid_editparams_collection_inv1._lastSelected != null) // nochange on spinner, use defaultvalue
				{
					var lastSelected = self.grid_editparams_collection_inv1._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv1._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv1.dirty[selectedId];
					values.value = dirtyObj.value;
					values.langid = dirtyObj.langid;
				}
				else
				{
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = defaultValue;
				}

			}
			if(page == "inv2") // inverter2 button is pressed
			{
				var defaultValue = self.grid_editparams_collection_inv2.store.data[0].langid;
					
				if(self.grid_editparams_collection_inv2._lastSelected != null) // nochange on spinner, use defaultvalue
				{
					var lastSelected = self.grid_editparams_collection_inv2._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv2._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv2.dirty[selectedId];
					values.value = dirtyObj.value;
					values.langid = dirtyObj.langid;
				}
				else
				{
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = defaultValue;
				}
			}
			if(page == "inv3") // inverter3 button is pressed
			{
				var defaultValue = self.grid_editparams_collection_inv3.store.data[0].langid;
					
				if(self.grid_editparams_collection_inv3._lastSelected != null) // nochange on spinner, use defaultvalue
				{
					var lastSelected = self.grid_editparams_collection_inv3._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv3._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv3.dirty[selectedId];
					values.value = dirtyObj.value;
					values.langid = dirtyObj.langid;
				}
				else
				{
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = defaultValue;
				}
			}
			if(page == "inv4") // inverter4 button is pressed
			{
				var defaultValue = self.grid_editparams_collection_inv4.store.data[0].langid;
					
				if(self.grid_editparams_collection_inv4._lastSelected != null) // nochange on spinner, use defaultvalue
				{
					var lastSelected = self.grid_editparams_collection_inv4._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv4._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv4.dirty[selectedId];
					values.value = dirtyObj.value;
					values.langid = dirtyObj.langid;
				}
				else
				{
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = defaultValue;
				}
			}
			
			values.command = "get";
			values.page = page;
			values_arr[0] = values;
			console.log(values);

			
			if(page != "search")
				var c = confirm("Get "+page+" value from index : " +values.langid+ "?");	
			else
				c = true;
				
				if(c) // save set	
				{

					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson(values_arr),
							  handleAs: "text",
							  load: function(data)
								{
									if (data) 
									{
										//	console.log("send..");
											var deferred = dojo.xhrGet(self.xhrArgs_getdata);		
											dojo.byId("status").innerHTML = "Message:  Reading data, please wait...";	
									}

								},
								error: function(error)
								{
									alert(error);
								}
						}
						var deferred = dojo.xhrPost(xhrArgs);	
				}
			
			if(page == "search")
			{
				console.log("search :", values.langid);
				console.log(self.spinnerValueId);
				
				if(self.spinnerValueId != null)
					values.langid = self.spinnerValueId;
							
				this.xhrArgs_getdata = 
				{
					url: "get_editparams_data.php/search",
					handleAs: "text",
					content: {
							  key1: values.langid
							},
					load: function(data)
					{
						if (data) 
						{
							self.ProgramLineStoreSearch = new Memory({data:[]});
							
							var arr = dojo.fromJson(data);
							console.log(arr);

							self.ProgramLineStoreSearch.put(arr);
							self.grid_editparams_collection_search.store = self.ProgramLineStoreSearch;
							html.set(dom.byId("inverter_response"), "ID: " + arr.langid + "   Default value : " + arr.default_value + "   Value : " + arr.value);
							self.grid_editparams_collection_search.refresh();
						}
						//	self.grid_editparams_collection_search.refresh();


					},
					error: function(error)
					{
						alert(error);
					}
			
				}
					setTimeout(function(){dojo.byId("inverter_response").innerHTML=""},3000); // clear information field
					setTimeout(function(){dojo.byId("status").innerHTML=""},3000); // clear status field
			}
			else // inverter
			{
				this.xhrArgs_getdata = 
				{
					url: "get_editparams_data.php/response",
					handleAs: "text",
					content: {
							  langid: values.langid,
							  page: page,
							  command: "set"
							},
					load: function(data)
					{
						if (data) 
						{
							var arr = dojo.fromJson(data);
							console.log(arr.response);
						//	html.set(dom.byId("inverter_response"), " " + arr.response);
							dojo.byId("status").innerHTML = "";	
							
							
							var res = arr.response.split("|");
							
							if(page == "inv1")
							{
								self.grid_editparams_collection_inv1.store.data[0].param = "Gantry inverter parameter is : "+res[0]+"("+res[1]+ " = "+ res[2]+")";
								self.grid_editparams_collection_inv1.store.data[0].value=res[2];
								self.grid_editparams_collection_inv1.refresh();
							}
							else if(page == "inv2")
							{
								self.grid_editparams_collection_inv2.store.data[0].param = "Lift inverter parameter is : "+res[0]+"("+res[1]+ " = "+ res[2]+")";
								self.grid_editparams_collection_inv2.store.data[0].value=res[2];
								self.grid_editparams_collection_inv2.refresh();
							}
							else if(page == "inv3")
							{
								self.grid_editparams_collection_inv3.store.data[0].param =  "Brush inverter parameter is : "+res[0]+"("+res[1]+ " = "+ res[2]+")";
								self.grid_editparams_collection_inv3.store.data[0].value=res[2];
								self.grid_editparams_collection_inv3.refresh();
							}
							else if(page == "inv4")
							{
								self.grid_editparams_collection_inv4.store.data[0].param =  "Rotate inverter parameter is : "+res[0]+"("+res[1]+ " = "+ res[2]+")";
								self.grid_editparams_collection_inv4.store.data[0].value=res[2];
								self.grid_editparams_collection_inv4.refresh();
							}
							
						
							
							//setTimeout(function(){dojo.byId("inverter_response").innerHTML=""},3000); // clear information field
						}

					},
					error: function(error)
					{
						alert(error);
					}
				}
			}

		},
		Set_value_inv: function(self)
		{
			values = {};
			values_arr = [];
			if(page == "search")
			{
			var lastSelected = self.grid_editparams_collection_search.store.data[0].id;

			
				if(self.grid_editparams_collection_search._lastSelected == null)
				{
					var dirtyObj = self.grid_editparams_collection_search.store.data[0];
				}
				else
				{
					var dirtyObj = self.grid_editparams_collection_search.store.data[0];
					
					if(self.grid_editparams_collection_search.dirty[lastSelected].value)
						 dirtyObj.value = self.grid_editparams_collection_search.dirty[lastSelected].value;
						 
					if(self.grid_editparams_collection_search.dirty[lastSelected].langid)
						 dirtyObj.langid = self.grid_editparams_collection_search.dirty[lastSelected].langid;
				}
			
				console.log("dirtyObj ", dirtyObj);
				console.log(self.grid_editparams_collection_search.dirty[selectedId]);
				console.log(self.grid_editparams_collection_search.store.data[0]);
			}
			if(page == "inv1")
			{
				if(self.grid_editparams_collection_inv1._lastSelected != null)
				{
					var lastSelected = self.grid_editparams_collection_inv1._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv1._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv1.dirty[selectedId];
				}
				else
				{
					if(self.spinnerValueValue != null)
						values.value = self.spinnerValueValue;
					else	
						values.value = dirtyObj.value;
					
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = dirtyObj.langid;
				}
			}
			if(page == "inv2")
			{
				if(self.grid_editparams_collection_inv2._lastSelected != null)
				{
					var lastSelected = self.grid_editparams_collection_inv2._lastSelected.id;
					var rowIndeksi = self.grid_editparams_collection_inv2._lastSelected.rowIndex;
					var n=lastSelected.split("-");
					var selectedId = n[n.length-1];
					var dirtyObj = self.grid_editparams_collection_inv2.dirty[selectedId];
				}
				else
				{
					if(self.spinnerValueValue != null)
						values.value = self.spinnerValueValue;
					else	
						values.value = dirtyObj.value;
					
					if(self.spinnerValueId != null)
						values.langid = self.spinnerValueId;
					else
						values.langid = dirtyObj.langid;
				}
			}
			
				
			if(self.spinnerValueValue != null)
				values.value = self.spinnerValueValue;
			else	
				values.value = dirtyObj.value;
			
			if(self.spinnerValueId != null)
				values.langid = self.spinnerValueId;
			else
				values.langid = dirtyObj.langid;
				
			values.command = "set";
			values.page = page;
			values_arr[0] = values;
			console.log(values);
			
			var c = confirm("("+page+"). Set ID: "+values.langid+" value to : " +values.value+ "?");	
				if(c) // save set	
				{
					var xhrArgs = 
						{
							  url: "get_editparams_data.php",
							  postData: dojo.toJson(values_arr),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
						deferred.then(function(response)
						{
							console.log(response);
						});
				}
			console.log("Set_value_inv");
			setTimeout(function(){dojo.byId("status").innerHTML=""},3000); // clear status field
		},
		Search: function(self)
		{
			page = "search";
				if(self.spinnerValue != null)
					values.langid = self.spinnerValue;
					
			dojo.style("buttons_table", {
					  "visibility": "visible"
					  });
				dojo.style("grid_editparameters", {
					  "visibility": "hidden",
					  "height":"0px"
					  });  
				dojo.style("grid_editinverters", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters2", {
					  "visibility": "hidden",
					   "height":"0px"
					  });  
				dojo.style("grid_editinverters3", {
					  "visibility": "hidden",
					   "height":"0px"
					  });   
				dojo.style("grid_editinverters4", {
					  "visibility": "hidden",
					   "height":"0px"
					  });  
				dojo.style("grid_search", {
					  "visibility": "visible",
					   "height":"100px"
					  });  
				  
			var xhrArgs_search = 
				{
					url: "get_editparams_data.php/24",
					handleAs: "text",
					load: function(data)
					{
						if (data) 
						{
							var arr = dojo.fromJson(data);

							self.ProgramLineStoreSearch = new Memory({data:[]});
							
							for(var i=0; i < arr.length; i++) 
							{
								self.ProgramLineStoreSearch.put(arr[i]);
							}
							
						}
								self.grid_editparams_collection_search.store = self.ProgramLineStoreSearch;
								self.grid_editparams_collection_search.refresh();
					},
					error: function(error)
					{
						self.grid_editparams_collection_search.store = self.ProgramLineStoreSearch;
						self.grid_editparams_collection_search.refresh();
					}
				}

				var deferred = dojo.xhrGet(xhrArgs_search);	
		}
			
			});
    });
