/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
	// %REMOVE_START%
	// The configuration options below are needed when running CKEditor from source files.
	config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,indentblock,indentlist,smiley,justify,menubutton,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,scayt,stylescombo,tab,table,tabletools,undo,wsc,oembed,widget,lineutils';
	config.skin = 'moono';
   config.language = 'vi';
   config.filebrowserBrowseUrl = '/elfinder/elfinder.php';
   config.height = '200px';
   config.width = '60%';
   //config.extraPlugins = 'oembed';
	// %REMOVE_END%
   // Toolbar
   
   config.toolbar = [
      { name: 'document', items: ['Source'] },
      { name: 'tool', items: ['Image','oembed'] },
      { name: 'clipboard', items: ['-', 'Paste', 'PasteText', 'PasteFromWord', '-',] },
      { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
      { name: 'colors', items: ['TextColor', 'BGColor'] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
      { name: 'links', items: ['Link', 'Unlink'] },
      { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
      { name: 'insert', items: ['Table','Smiley'] },
   ];

};
