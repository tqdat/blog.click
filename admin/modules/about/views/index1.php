<?=form_open_multipart(uri_string(),array('id'=>'admindata'))?>
<h4 style="margin: 10px 0px;">Hình ảnh</h4>
<div><input type="file" name="userfile"></div>
<h4 style="margin: 10px 0px;">Giới thiệu ngắn</h4>
<?=vnit_editor($rs->small,'small','abc')?>
<h2 style="margin: 10px 0px;">Giới thiệu</h2>
<?=vnit_editor($rs->content,'content','full')?>
<?=form_close()?>
