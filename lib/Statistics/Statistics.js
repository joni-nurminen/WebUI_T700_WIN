require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/Statistics/templates/Statistics.html",
		"dijit/form/Button",
		"dojox/charting/plot2d/StackedAreas",
		"dojox/charting/Chart",
		"dojox/charting/themes/Claro",
		"dojox/charting/plot2d/Columns",
		"dojox/charting/plot2d/Pie",
		 "dojox/charting/widget/Legend",
		"dojox/charting/action2d/Highlight",
		"dojox/charting/plot2d/Lines",
		"dojox/charting/action2d/Tooltip",
		"dojo/_base/xhr",
		"dgrid/OnDemandGrid",
		"dgrid/Selection", 
		"dojo/store/Memory",
		"dojo/store/JsonRest", 
		"dojo/store/Cache", 
		"dojo/json",
		"lib/LangSupport", 
		"dojo/i18n!./lib/nls/resources.js",
		"dijit/registry",
		"dijit/form/DateTextBox",
		"dojox/charting/axis2d/Default"
		
	],
		function(declare, 
				_WidgetBase, 
				_TemplatedMixin, 
				_WidgetsInTemplateMixin, 
				template, 
				Button, 
				StackedAreas,
				Chart, 
				theme, 
				ColumnsPlot, 
				PiePlot,
				Legend,
				Highlight, 
				Lines, 
				Tooltip, 
				xhr,
				Grid,
				Selection,
				Memory,
				JsonRest,
				Cache,
				json,
				LangSupport,
				resources,
				registry)
		{
			return  declare("Statistics", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{

				templateString: template,
				statistics: resources.statistics,
				washcounters: resources.washcounters,
				washcounters_maintenance: resources.washcounters_maintenance,
				postCreate: function() 
				{
				    this.inherited(arguments);
					var domNode = this.domNode;
					var self = this; 
					this.ls = new LangSupport();	
					var chart = new Chart("chartNode");
					var pieChart = new Chart("chartNodePie");
					var timeout; // updKHu
					
					var tabs = registry.byId("pageTabContainer");
					
					tabs.watch("selectedChildWidget", function(name, oval, nval) // page is loaded
					{
						if(nval.id == "statistics") // if page is statistics page
						{
							var deferred = dojo.xhrGet(xhrArgs_statistics);
							timeout = setTimeout(function(){ tabs.selectChild("online_status");
							domClass.add("pageTabContainer_tablist_online_status", "dijitTabChecked dijitChecked"); }, 180000); // 3 min, updKHu v4.7
						}
						else
						{
							console.log("Statistic timeout cleared");
							clearTimeout(timeout);
						}
					});
					
					this.Store_wash_counters = new Memory();
					this.Store_wash_counters2 = new Memory();
					this.Store_wash_counters_maintenance = new Memory();
					this.Store_wash_counters_maintenance2 = new Memory();
					
					 var columns_wash_counters = 
					 [
						 {
							field: "program",
							sortable:false,
							label: resources.program,
							get: function (object) {
									return resources.program+ " "+object.program;
							}
						},
						 {label:resources.washes, field:"sum",sortable:false},
					 ];
					
					// Create grid for wash_counters 1-15
					 this.grid_wash_counter_collection = new (declare([Grid, Selection]))({
						  store: this.Store_wash_counters,
						  columns: columns_wash_counters,
						  selectionMode: "single"
					  }, "grid_wash_counters");	
					  
					  // Create grid for wash_counters 15-30
					 this.grid_wash_counter_collection2 = new (declare([Grid, Selection]))({
						  store: this.Store_wash_counters2,
						  columns: columns_wash_counters,
						  selectionMode: "single"
					  }, "grid_wash_counters2");	
					  
					   // Create grid for wash_counters maintenance 1-15
					 this.grid_wash_counter_collection_maintenance = new (declare([Grid, Selection]))({
						  store: this.Store_wash_counters_maintenance,
						  columns: columns_wash_counters,
						  selectionMode: "single"
					  }, "grid_wash_counters_maintenance");	
					  
					    // Create grid for wash_counters maintenance 15-30
					 this.grid_wash_counter_collection_maintenance2 = new (declare([Grid, Selection]))({
						  store: this.Store_wash_counters_maintenance2,
						  columns: columns_wash_counters,
						  selectionMode: "single"
					  }, "grid_wash_counters_maintenance2");	
					
					
					var xhrArgs_statistics = 
					{
						url: "get_statistics_data.php",
						handleAs: "text",
						load: function(data)
						{
							if (data) 
							{
								var arr = dojo.fromJson(data);

							
								self.Store_wash_counters = new Memory({data:[]});
								self.Store_wash_counters2 = new Memory({data:[]});
								self.Store_wash_counters_maintenance = new Memory({data:[]});
								self.Store_wash_counters_maintenance2 = new Memory({data:[]});
								
								var total = arr[30].sum; // get sum of total washes
								var suspended = arr[31].sum // get sum of suspended washes
								var testData = [];
								var res = total.split(" ");
								var maintenanceData = [parseInt(res[0]), suspended];
											
								
							//	var test_washes = arr[33].test_washes // get sum of test washes
								
								for(var i=0; i < 15; i++) 
								{
									self.Store_wash_counters.put(arr[i]);
									var res = arr[i].sum.split(" ");
									testData.push(parseInt(res[0]));
								}
								for(var i=15; i < 30; i++) 
								{
									self.Store_wash_counters2.put(arr[i]);
									var res = arr[i].sum.split(" ");
									testData.push(parseInt(res[0]));
								}
								
								for(var i=0; i < 15; i++) 
								{
									self.Store_wash_counters_maintenance.put(arr[32].maintenance_washes[i]);
								}
								
								for(var i=15; i < 30; i++) 
								{
									self.Store_wash_counters_maintenance2.put(arr[32].maintenance_washes[i]);
								}
							}
							self.grid_wash_counter_collection.store = self.Store_wash_counters;
							self.grid_wash_counter_collection.refresh();
							
							self.grid_wash_counter_collection2.store = self.Store_wash_counters2;
							self.grid_wash_counter_collection2.refresh();
							
							self.grid_wash_counter_collection_maintenance.store = self.Store_wash_counters_maintenance;
							self.grid_wash_counter_collection_maintenance.refresh();
							
							self.grid_wash_counter_collection_maintenance2.store = self.Store_wash_counters_maintenance2;
							self.grid_wash_counter_collection_maintenance2.refresh();

							dojo.byId("total_washes").innerHTML = "<h2>"+ resources.total_washes  + " <span style=color:black>" + total + "</span></h2>";
							dojo.byId("suspended_washes").innerHTML = "<h2>"+resources.suspended_washes  + " <span style=color:black>" + suspended + "</span></h2>";
						//	dojo.byId("test_washes").innerHTML = "<h2>"+ resources.total_test_washes  + "<span style=color:black>" + test_washes + "</span></h2><br>";
						
						
							// Set the theme
							chart.setTheme(theme);

							// Add the only/default plot
							chart.addPlot("default", {
								type: ColumnsPlot,
								markers: true,
								gap: 5
							});

							// Add axes
							chart.addAxis("x");
							chart.addAxis("y", { vertical: true, fixLower: "major", fixUpper: "major" });

							// Add the series of data
							chart.addSeries("Washes",testData);

							// Highlight!
							new Highlight(chart,"default");

							// Render the chart!
							chart.render();
							
							// Create the chart within it&#x27;s "holding" node
							//pieChart = new Chart("chartNodePie");

							// Set the theme
							pieChart.setTheme(theme);

							// Add the only/default plot
							pieChart.addPlot("default", {
								type: PiePlot, // our plot2d/Pie module reference as type value
								radius: 200,
								fontColor: "black",
								labelOffset: -20
							});

							// Add the series of data
							pieChart.addSeries("Washes",maintenanceData);

							// Render the chart!
							pieChart.render();
							
							// Create the legend
						//	var legend = new Legend({ chart: pieChart }, "legend");
					
							
						},
						error: function(error)
						{
							self.grid_wash_counter_collection.store = self.Store_wash_counters;
							self.grid_wash_counter_collection.refresh();
							
							self.grid_wash_counter_collection2.store = self.Store_wash_counters2;
							self.grid_wash_counter_collection2.refresh();
							
							self.grid_wash_counter_collection_maintenance.store = self.Store_wash_counters_maintenance;
							self.grid_wash_counter_collection_maintenance.refresh();
							
							self.grid_wash_counter_collection_maintenance2.store = self.Store_wash_counters_maintenance2;
							self.grid_wash_counter_collection_maintenance2.refresh();
						}
					}

				
					
					
					/*
					var chartData = [];// = [10000,9200,11811,12000,7662,13887,14200,12222,12000,10009,11288,12099];
					
					// Create the chart within it's "holding" node
					this.chart =  new Chart(this.chartNode3);
					 
					// Set the theme
					this.chart.setTheme(theme);
					 
					// Add the only/default plot
					this.chart.addPlot("default", {
					type: "Lines",
					markers: true
					});
					 
					// Add axes
					this.chart.addAxis("x");
					this.chart.addAxis("y", { min: 0, max: 150, vertical: true, fixLower: "major", fixUpper: "major" });
					 
					// Add the series of data
					this.chart.addSeries("SalesThisDecade",chartData);
					 
					// Render the chart!
					this.chart.render();
					

					var xhrArgs_chart_data = 
						{
								url:"GetChartData.php",
								handleAs:"text",
								timeout: 5000,
								load: function(data) 
								{
									var res = dojo.fromJson(data);
									
									if(testData.length == 30)
									{
										testData.shift();
									}
									testData.push(res.harja);
									self.chart.updateSeries("SalesThisDecade", testData);
								//	console.log(self.chart.series[0].data);
								//	console.log(testData.length);
									self.chart.render();
								}
						}
					var deferred = dojo.xhrGet(xhrArgs_chart_data);
					*/

				/*
					var inter = setInterval(function()
						{
						//console.log("get io data");
							var deferred = dojo.xhrGet(xhrArgs_chart_data);
						}, 200); //time in miliseconds
					
				*/
             }
        });
    });
