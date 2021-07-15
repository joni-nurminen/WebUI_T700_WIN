require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/DebugIOData_Log/templates/DebugIOData_Log.html",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dgrid/OnDemandGrid",
		"dgrid/Selection", 
		"dojo/store/Memory",
		"dojo/store/JsonRest", 
		"dojo/store/Cache", 
		"dojo/json",
		"dojo/i18n!./lib/nls/resources.js"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, theme, xhr, Grid,Selection,Memory,JsonRest,Cache,json,resources)
		{
			return  declare("DebugIOData_Log", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{

				templateString: template,
				system_log : resources.system_log,
				sys_log : resources.sys_log,
				shared_log : resources.shared_log,
				debug_log : resources.debug_log,
				conf_log : resources.conf_log,
				postCreate: function() 
				{
				this.inherited(arguments);
				var self = this;	 

				// connect log buttons
				dojo.connect(this.get_debug_log, "onclick", null, function() { self.read_log("debuglog"); });
				dojo.connect(this.get_conf_log, "onclick", null, function() { self.read_log("conflog"); });
				
				dojo.connect(this.get_sys_log, "onclick", null, function() { self.read_log("syslog"); });
				dojo.connect(this.get_shared_mem_log, "onclick", null, function() { self.read_log("shared_mem_log"); });
				
				this.Store_log = new Memory();
				var columns_log = 
					 [
						 {label:resources.system_log, field:"logrow"},
					 ];
				
				// Create grid for log
					 this.grid_log_collection = new (declare([Grid, Selection]))({
						  store: this.Store_log,
						  columns: columns_log,
						  maxRowsPerPage:5000,
						  selectionMode: "single"
					  }, "grid_log");	
					  
					  this.xhrArgs = 
					{
						url: "get_log_data.php/",
						handleAs: "text",
						load: function(data)
						{
							if (data) 
							{
								var arr = dojo.fromJson(data);
								
								self.Store_log = new Memory({data:[]});
								
								for(var i=0; i < arr.length; i++) 
								{
									self.Store_log.put(arr[i]);
								}
							self.grid_log_collection.store = self.Store_log;
							console.log(self.grid_log_collection.store);
							}
						
							self.grid_log_collection.refresh();
						}
					}
				},
				read_log: function(log)
				{
					this.xhrArgs.url = "get_log_data.php/"+log;
					var deferred = dojo.xhrGet(this.xhrArgs);
					deferred.then(function(value)
					{
						return;
					});
				}
				
        });
    });
