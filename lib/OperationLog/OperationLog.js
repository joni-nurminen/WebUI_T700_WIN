require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/OperationLog/templates/OperationLog.html",
		"dijit/form/Button",
		"dojox/charting/plot2d/StackedAreas",
		"dojox/charting/Chart",
		"dojox/charting/themes/ThreeD",
		"dojox/charting/plot2d/Pie",
		"dojox/charting/action2d/Tooltip",
		"dojox/charting/action2d/MoveSlice", 
		"dojo/_base/xhr",
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Button, StackedAreas, Chart, theme, Pie, Tooltip, MoveSlice, xhr)
		{
			return  declare("OperationLog", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{

				clickName : "hhei",
				templateString: template,
				startup: function() {
				this.inherited(arguments);
             }
        });
    });
