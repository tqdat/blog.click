<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 100px;">Tiêu đề</td>
        <td><input type="text" name="vdata[name]" value="<?=$rs->name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Link</td>
        <td><input type="text" name="vdata[link]" value="<?=$rs->link?>" class="w300"></td>
    </tr>    
    <tr>
        <td class="label">File</td>
        <td><input type="file" name="userfile" value=""> (500 x 312)</td>
    </tr>    
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=$rs->ordering?>"></td>
    </tr>
</table>
<?php echo form_close();?>