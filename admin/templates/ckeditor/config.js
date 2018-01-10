/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
   config.height = 170;
   config.filebrowserBrowseUrl = base_url+'templates/ckeditor/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = base_url+'templates/ckeditor/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = base_url+'templates/ckeditor/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = base_url+'templates/ckeditor/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = base_url+'templates/ckeditor/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = base_url+'templates/ckeditor/kcfinder/upload.php?type=flash';
   config.toolbar = 'full';
   config.toolbar = 'basic';
 
    config.toolbar_full =
    [
        { name: 'document', items : [ 'Source','-','Preview' ] },
        { name: 'clipboard', items : [ 'Cut','Copy','PasteFromWord','-','Undo','Redo' ] },
       /* { name: 'editing', items : [ 'Find','Replace','SpellChecker', 'Scayt' ] },      */
        { name: 'insert', items : [ 'Image','Flash','jwplayer','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
        
        { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
        { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
        { name: 'links', items : [ 'Link','Unlink'] },
       /* 
        '/',  */
        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
        { name: 'colors', items : [ 'TextColor','BGColor' ] },
        { name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] }
    ]; 
 
};
