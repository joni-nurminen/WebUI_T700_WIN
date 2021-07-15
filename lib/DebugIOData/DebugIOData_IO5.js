require([
	"dojo/_base/declare", 
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/DebugIOData/templates/DebugIOData_IO5.html",
	"dgrid/OnDemandGrid",
	"dgrid/Selection", 
	"dgrid/selector", 
	"dojo/store/Memory",
	"dojo/store/JsonRest", 
	"dojo/json",
	"dojo/store/Cache",
	"dojo/i18n!./lib/nls/resources.js",
	"lib/LangSupport",
	"dojo/ready",
	"dijit/registry",
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Grid,Selection,selector,Memory,JsonRest,json,Cache,resources,LangSupport,ready,registry){
			return  declare("DebugIOData_IO5", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], {
				
				templateString: template,
				card_5 : resources.card_5,
				save_selections : resources.save_selections,
				startup: function() {
				this.inherited(arguments);
				var self = this;	
				this.ls = new LangSupport();	
				
				dojo.connect(this.button_save_selections, "onclick", null, function() { self.Save(); });
				
			//	this.IO5Store = new Memory();
				this.IO5Store = new Cache(new JsonRest({target:"get_debugio_data.php/5_in"}), new Memory());
				
				var tabs = registry.byId("pageTabContainer");
				tabs.watch("selectedChildWidget", function(name, oval, nval) // page is loaded
					{
						if(nval.id == "debug_io") // if page is start washing page
						{
						//    this.IO1Store = new Cache(new JsonRest({target:"get_debugio_data.php/1_in"}), new Memory());
							console.log("io5");
							  self.grid_IO5_collection.refresh();
						}

					});       
					
				// colums for IO5
				 var columns_IO5 = [	 

						 selector({ label:resources.select, field:"select" }),
						 {label:resources.input,
						  get: function(object)
								{
									return self.ls.SetLangByLangId("io5_"+object.id);
								}
							},
						 {
							label:resources.state,
							field: "state",
							sortable: false,
							get: function(object)
								{
										// get current io-state
										this.data = object.state;
								},
							formatter: function(icon) // show red ar gray lamp
							{
								if(this.data == 1)
									return '<div class="icon" style="background-image:url(lib/css/images/button_green.png); width: 25px; height:25px;">&nbsp;</div>';
								else
									return '<div class="icon" style="background-image:url(lib/css/images/button_gray.png); width: 25px; height:25px;">&nbsp;</div>';
							}
						},
						 {label:resources.description,
						  get: function(object)
								{
									return self.ls.SetLangByLangId("io5_desc"+object.id);
								}
								},
						 ];
						 
				// Create grid for IO5
					 this.grid_IO5_collection = new (declare([Grid, Selection]))({
						  store: this.IO5Store,
						  columns: columns_IO5,
						  sortable: false,
						  selectionMode: "multiple"
					  }, "grid_IO5");	
					  
					  self.grid_IO5_collection.refresh();
          
        },
		Save: function()
		{
			var idlist = [];
			
				for (var id in this.grid_IO5_collection.selection)
					{

						idlist.push(this.IO5Store.get(id).id);
					}

					var xhrArgs = 
						{
							  url: "save_debug_io_data.php/5",
							  postData: dojo.toJson(idlist),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
					
			
		},
				
		});
});

