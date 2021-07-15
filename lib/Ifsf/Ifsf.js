require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/Ifsf/templates/Ifsf.html",
		"dijit/form/Button",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/i18n!./lib/nls/resources.js",
		"dijit/registry",
		"dijit/form/Form",
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Button, theme, xhr,resources,registry)
		{
			return  declare("Ifsf", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				server_lon_addr:resources.server_lon_addr,
				cw_lon_addr: resources.cw_lon_addr,
				ifsf_config: resources.option7,
				cw_lon_dev: resources.cw_lon_dev,
				cw_mode: resources.cw_mode,
				code_veh_ord: resources.code_veh_ord,
				stand_alone_auth: resources.stand_alone_auth,
				ifsf_bus_control: resources.ifsf_bus_control,
				button: resources.set_ifsf_conf,
				postCreate: function() 
				{
					this.inherited(arguments);
					var self = this;	   
					
					var tabs = registry.byId("pageTabContainer");
					
					tabs.watch("selectedChildWidget", function(name, oval, nval) // page is loaded
					{
						if(nval.id == "ifsf") // if page is ifsf page
						{
							var deferred = dojo.xhrGet(self.xhrArgs_get_ifsf_conf);	
						}

					});      
					
					dojo.connect(this.button_save_ifsf_conf, "onclick", null, function() {self.save_ifsf_conf(self); });
					/*
					dojo.connect(this.button_start_ifsf, "onclick", null, function() {self.start_ifsf(self); });
					dojo.connect(this.button_stop_ifsf, "onclick", null, function() {self.stop_ifsf(self); });
					dojo.connect(this.button_restart_ifsf, "onclick", null, function() {self.restart_ifsf(self); });
					*/
					this.Server_lon_addr = registry.byId("server_lon_addr");
					this.Cw_lon_addr = registry.byId("cw_lon_addr");
					this.Cw_lon_dev = registry.byId("cw_lon_dev");
					this.Code_veh_ord = registry.byId("code_veh_ord");
					this.Stand_alone_auth = registry.byId("stand_alone_auth");
					this.Ifsf_bus_control = registry.byId("ifsf_bus_control");
					this.cw_server_uptime = registry.byId("cw_server_uptime");
					this.ifsf_server_uptime = registry.byId("ifsf_server_uptime");
					
					this.xhrArgs_get_ifsf_conf = 
						{
							url: "save_ifsf_conf.php",
							handleAs: "text",
							load: function(data)
							{
								if (data) 
								{
									var arr = dojo.fromJson(data);
									self.Server_lon_addr.set("value", arr.server_lon_addr);
									self.Cw_lon_addr.set("value", arr.cw_lon_addr);
									self.Cw_lon_dev.set("value", arr.cw_lon_dev);
									self.Code_veh_ord.set("value", arr.code_veh_ord);
									self.Stand_alone_auth.set("value", arr.stand_alone_auth);
									self.Ifsf_bus_control.set("value", arr.ifsf_bus_control);
									self.Ifsf_bus_control.set("value", arr.ifsf_bus_control);
									self.cw_server_uptime.set("value", arr.cw_server_uptime);
									self.ifsf_server_uptime.set("value", arr.ifsf_server_uptime);
								}

							}
							
						}
						var deferred = dojo.xhrGet(this.xhrArgs_get_ifsf_conf);
					
				},
				/*
				start_ifsf:function(self) 
				{
					console.log("start_ifsf");
				},
				stop_ifsf:function(self) 
				{
					console.log("stop_ifsf");
				},
				restart_ifsf:function(self) 
				{
					console.log("restart_ifsf");
					 var xhrArgs_set_ifsf_conf = 
						{
							  url: "save_ifsf_conf.php",
							  postData: dojo.toJson({command:"restart_ifsf"}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs_set_ifsf_conf);	
				},
				*/
				save_ifsf_conf:function(self) 
				{		
					dojo.style("button_save_ifsf_conf", {
									  "visibility": "hidden"
									  });
									  
					var serv_lon = self.Server_lon_addr.get("value");
					var cw_lon = self.Cw_lon_addr.get("value");
					var cw_lon_dev = self.Cw_lon_dev.get("value");
					var code_veh = self.Code_veh_ord.get("value");
					var stand_alone = self.Stand_alone_auth.get("value");
					var ifsf_bus = self.Ifsf_bus_control.get("value");
				
					console.log(serv_lon);
				
					    var xhrArgs_set_ifsf_conf = 
						{
							  url: "save_ifsf_conf.php",
							  postData: dojo.toJson({serv_lon:serv_lon,cw_lon:cw_lon,cw_lon_dev:cw_lon_dev,code_veh:code_veh,stand_alone:stand_alone,ifsf_bus:ifsf_bus}),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs_set_ifsf_conf);	
						deferred.then(function(value)
						  {
							
							  
							self.Server_lon_addr.set("value", "reading..");
							self.Cw_lon_addr.set("value", "reading..");
							self.Cw_lon_dev.set("value", "reading..");
							self.Code_veh_ord.set("value", "reading..");
							self.Stand_alone_auth.set("value", "reading..");
							self.Ifsf_bus_control.set("value", "reading..");
							
							
							var deferred = dojo.xhrGet(self.xhrArgs_get_ifsf_conf);
							deferred.then(function(value)
							{
								dojo.style("button_save_ifsf_conf", {
									  "visibility": "visible"
									  });
							}, function(err)
							{
								console.log(err);
							});
							
							console.log("get adataaa");
						  }, function(err)
						  {
							console.log(err);
						  });
						
				}
				
        });
    });
