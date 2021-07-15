require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/SaveToFlash/templates/SaveToFlash.html",
		"dijit/form/Button",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/i18n!./lib/nls/resources.js",
		"dijit/registry",
		"dojo/html",
		"dojo/dom",
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Button, theme, xhr,resources,registry,html,dom)
		{
			return  declare("SaveToFlash", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				save_to_flash: resources.save_to_flash,
				
				postCreate: function() 
				{
					this.inherited(arguments);
					var self = this;
					var old_server_uptime;
					var allowedToStart = true;
					
					var tabs = registry.byId("pageTabContainer");
					
						tabs.watch("selectedChildWidget", function(name, oval, nval)
						{
							if(nval.id == "save_to_flash")
							{
							dojo.style("server_uptime", {
													  "fontSize": "25px",
													  "color": "black"  
													  });
							html.set(dom.byId("server_uptime"), " ");
							var c = confirm(resources.message_save);
								if(c)
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
													console.log("chekki",o_mas,o_sla);
													
													//if((o_mas == 6 || o_mas == 7) || (o_sla== 6 || o_sla == 7))
													if(o_mas == 6 || o_sla == 6)
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
															
															if(o_sla != null)
															{
																switch(o_sla)
																{
																	case 1:operation_mode_s =  resources.operation_mode_1;break;
																	case 2:operation_mode_s =  resources.operation_mode_2;break;
																	case 3:operation_mode_s =  resources.operation_mode_3;break;
																	case 4:operation_mode_s =  resources.operation_mode_4;break;
																	case 5:operation_mode_s =  resources.operation_mode_5;break;
																	case 6:operation_mode_s =  resources.operation_mode_6;break;
																	case 7:operation_mode_s =  resources.operation_mode_7;break;
																	case 8:operation_mode_s =  resources.operation_mode_8;break;
																	case 9:operation_mode_s =  resources.operation_mode_9;break;
																//	default:operation_mode =  resources.operation_mode_0;break;
																}

																
																alert("Wrong operation modes: "+operation_mode+ " and " +operation_mode_s);		
															}
															else
																alert("Wrong operation mode: "+operation_mode);	
																
													allowedToStart = false
													}
													else
													{
														console.log("homma ok");
														allowedToStart = true;
													}
												}
											}
										}
									var deferred = dojo.xhrGet(xhrArgs_get_operation_state);
									deferred.then(function(data)
									{
										this.xhrArgs_flash = 
										{
											url: "save_to_flash.php/use_conf",
											handleAs: "text",
											load: function(data)
											{
												if (data) 
												{ 
													var arr = dojo.fromJson(data);
												}
											}
										}
										if(allowedToStart)
										{
											var deferred = dojo.xhrGet(this.xhrArgs_flash);
											
											var TimerSaveToFlash = setInterval(function()
											{
												var deferred = dojo.xhrGet(xhrArgs_uptime);
											}, 3000); //time in miliseconds
										}
										deferred.then(function(data)
										{

											
										});
									});
								}
								else
								{
									html.set(dom.byId("server_uptime"), resources.message_cancel);
								}
							}

						});          
						
						var xhrArgs_uptime = 
									{
										url: "save_to_flash.php/uptime",
										handleAs: "text",
										load: function(data)
										{
											if (data) 
											{ 
												var arr = dojo.fromJson(data);
												var server_uptime = arr.uptime; // uptime
												
											//	console.log(server_uptime, old_server_uptime);
												if(server_uptime != old_server_uptime) // if shared mem is ok and running
												{
													dojo.style("server_uptime", {
													  "fontSize": "25px",
													  "color": "green"  
													  });
													html.set(dom.byId("server_uptime"), resources.message_server_ok);
													old_server_uptime = server_uptime;
													window.location = window.location.href; // updKHu
												}
												else
												{
													dojo.style("server_uptime", {
													  "fontSize": "25px",
													  "color": "red"  
													  });
													html.set(dom.byId("server_uptime"), resources.message_flashing);
												}
											}
										}
									}
									
									
				}
        });
    });
