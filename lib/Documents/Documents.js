require([
	"dojo/_base/declare",
	"dijit/_WidgetBase", 
	"dijit/_TemplatedMixin",  
	"dijit/_WidgetsInTemplateMixin" ,
	"dojo/text!./lib/Documents/templates/Documents.html",
	"dojo/store/Memory", 
	"dijit/form/ComboBox",
	"dojo/store/JsonRest",
	"dojo/store/Cache",
	"dojo/i18n!./lib/nls/resources.js",

	],
		function(declare, _WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin, template, Memory, ComboBox, JsonRest, Cache,resources)
		{
			return  declare("Documents", [_WidgetBase, _TemplatedMixin, _WidgetsInTemplateMixin], 
			{
			
				templateString: template,
				documents: resources.documents,
				select_pdf: resources.select_pdf,
				select_from_list: resources.select_from_list,
				postCreate: function() 
				{
					 this.inherited(arguments);
			
					stateStore = new Cache(new JsonRest({target:"get_pdf_files.php"}), new Memory());

					var comboBox = new ComboBox(
					{
					    id: "PdfSelect",
					    name: "state",
					    value: resources.select_from_list,
					    store: stateStore,
					    searchAttr: "name",
					    onChange: function()
					    {
					      var el = dojo.byId("pdf_wiever");
					      el.src = "lib/css/pdf/"+comboBox.value;
					    },
					}, "PdfSelect");

             	}
        });
    });
