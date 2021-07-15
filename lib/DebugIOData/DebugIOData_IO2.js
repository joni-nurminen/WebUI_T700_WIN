require([
	"dojo/_base/declare", 
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/DebugIOData/templates/DebugIOData_IO2.html",
	"dgrid/OnDemandGrid",
	"dgrid/Selection", 
	"dgrid/selector", 
	"dojo/store/Memory",
	"dojo/store/JsonRest", 
	"dojo/json",
	"dojo/store/Cache",
	"lib/LangSupport",
	"dojo/i18n!./lib/nls/resources.js",
	"dojo/ready",
	"dijit/registry",
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Grid,Selection,selector,Memory,JsonRest,json,Cache,LangSupport,resources,ready,registry){
			return  declare("DebugIOData_IO2", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], {
				
				templateString: template,
				card_2 : resources.card_2,
				save_selections : resources.save_selections,
				startup: function() {
				this.inherited(arguments);
				var self = this;	
				this.ls = new LangSupport();	
				
				dojo.connect(this.button_save_selections, "onclick", null, function() { self.Save(); });
				
			//	this.IO1Store = new Memory();
				this.IO2Store = new Cache(new JsonRest({target:"get_debugio_data.php/2_in"}), new Memory());
				
				var tabs = registry.byId("pageTabContainer");
				tabs.watch("selectedChildWidget", function(name, oval, nval) // page is loaded
					{
						if(nval.id == "debug_io") // if page is start washing page
						{
						//    this.IO1Store = new Cache(new JsonRest({target:"get_debugio_data.php/1_in"}), new Memory());
							console.log("io2");
							  self.grid_IO2_collection.refresh();
						}

					});       
					
				// colums for IO2
				 var columns_IO2 = [	 

						 selector({ label: "Select", field:"select" }),
						 {label:resources.input,
						  get: function(object)
								{
									return self.ls.SetLangByLangId("io2_"+object.id);
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
									return self.ls.SetLangByLangId("io2_desc"+object.id);
								}
						 },
						 ];
						 
				// Create grid for IO2
					 this.grid_IO2_collection = new (declare([Grid, Selection]))({
						  store: this.IO2Store,
						  columns: columns_IO2,
						  sortable: false,
						  selectionMode: "multiple"
					  }, "grid_IO2");	
					  
					  self.grid_IO2_collection.refresh();
          
        },
		Save: function()
		{
			var idlist = [];
			
				for (var id in this.grid_IO2_collection.selection)
					{

						idlist.push(this.IO2Store.get(id).id);
					}

					var xhrArgs = 
						{
							  url: "save_debug_io_data.php/2",
							  postData: dojo.toJson(idlist),
							  handleAs: "text"
						};
						var deferred = dojo.xhrPost(xhrArgs);	
					
			
		},
				
		});
});

