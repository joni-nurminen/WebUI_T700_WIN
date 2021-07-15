require([
	"dojo/_base/declare", "dijit/_WidgetBase", "dijit/_TemplatedMixin",  "dijit/_WidgetsInTemplateMixin" ,
		"dojo/text!./lib/Admin/templates/Admin.html",
		"dijit/form/Button",
		"dojox/charting/themes/ThreeD",
		"dojo/_base/xhr",
		"dojo/i18n!./lib/nls/resources.js",
		"dojox/charting/axis2d/Default"
	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Button, theme, xhr,resources)
		{
			return  declare("Admin", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
				templateString: template,
				accounts: resources.accounts,
				password: resources.password,
				admin:resources.admin,
				tm: resources.tm,
				importer: resources.importer,
				operator: resources.operator,
				chain: resources.chain,
				wap: resources.wap,
				button: resources.button,
				postCreate: function() 
				{
					this.inherited(arguments);
					var self = this;	   
					
				}
        });
    });
