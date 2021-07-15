// tm1243 app.js
// Microteam 2012-11-30
define([
		"dojo/_base/declare",
        "dojo/_base/fx",
		"dojo/_base/lang",
        "dojo/dom",
        "dojo/dom-style",
		"dojo/date/stamp",
		"dojox/socket",
		"dojo/parser",
        "dijit/registry",
		"dojo/i18n!./lib/nls/resources.js",
	], 
	function(declare, fx, lang, dom, domStyle, stamp, socket, parser, registry,resources) {
    return declare(null, {
        registry : registry,
        props : null,
        signals : {},
        bos : {},
        gos : {},
		
        constructor: function(props){ 
            this.props = props;
            this.init();
        },
        
		init: function(){
            try 
            {
                this.applyDataId(document.documentElement);                
            } 
            catch(e) { console.log('init '+e); }
		},
        
        
        endOverlay: function(id,fade) { 
            var node = dom.byId(id)
            if(!fade) { domStyle.set(node,'display','none'); }
            else { fx.fadeOut({ node:node, onEnd:function(node){ domStyle.set(node, 'display', 'none'); } }).play(); }
        },
        
        bind: function(name,obj){
            var gnam = this.grpName(name);
            var bo = this.bos[name] || (this.bos[name]=[]);
            var go = this.gos[gnam] || (this.gos[gnam]=[]);
            if(obj!=null) { bo.push(obj); go.push(obj); }
            return bo;
        },
        
        getBind: function(name){ return this.bos[name];
        },
        
        getBindGroup: function(name){ return this.gos[this.grpName(name)];
        },
        
        selectBind: function(name){ 
            var grp=this.getBindGroup(name); 
            for(var i=0; i<grp.length; i++) 
            {
                if(grp[i].unselect) grp[i].unselect();
            }
            var bo=this.getBind(name); 
            for(var i=0; i<bo.length; i++) 
            {
                if(bo[i].select) bo[i].select();
            }
        },
        
        grpName: function(name){ 
            var i; 
            if((i=name.lastIndexOf('.'))>0) { return name.substring(0,i); }
            if((i=name.lastIndexOf('/'))>0) { return name.substring(0,i); }
            return '';
        },

        applyDataId: function(elem)
        {
            var i = 0;
            for(var node=elem.firstChild; node; node=node.nextSibling) if(node.nodeType==1)
            {
                var id = node.getAttribute("data-id");
                if(id) 
                {
                    node.innerHTML = this.getDataById(id);
                }
                else this.applyDataId(node);                
            }
            return i;
        },
        
        getDataById: function(id) // language strings etc. content
        {
            return id; // TODO: implement
        },
        
        queryNode : function(node,path) // TODO: proper
        {
            for(var pat=path.split('/'),i=0,j,s; i<pat.length && node; i++)
            {
                if((s=pat[i])=='..') node=node.parentNode;
                else
                {
                    node=node.querySelector(s);
                }
            }
            return node;
        },
		
        idDump : function(){ var a=app.registry.toArray(),s='',i=0; for(;i<a.length;i++) s+=a[i].id+'  '; return s; 
        }
        
    });		
});