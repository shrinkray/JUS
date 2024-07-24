(function() {  
tinymce.create('tinymce.plugins.greybox', {  
        init : function(ed, url) {  
            ed.addButton('Greybox', {  
                title : 'Add a grey box',  
                image : url+'/grey.png',  
                onclick : function() {  
                     ed.selection.setContent('[greybox]' + ed.selection.getContent() + '[/greybox]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        } 
    });
    tinymce.PluginManager.add('greybox', tinymce.plugins.greybox);
    tinymce.create('tinymce.plugins.bluebox', {  
        init : function(ed, url) {  
            ed.addButton('Bluebox', {  
                title : 'Add a blue box',  
                image : url+'/blue.png',  
                onclick : function() {  
                     ed.selection.setContent('[bluebox]' + ed.selection.getContent() + '[/bluebox]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        } 
    });
    tinymce.PluginManager.add('bluebox', tinymce.plugins.bluebox);
    })();  