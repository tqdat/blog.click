<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tỉnh, Thành phố</td>
        <td><input type="text" name="vdata[city_name]" value="<?php echo set_value('vdata[city_name]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td><input type="file" name="userfile"></td>
    </tr>    
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo set_value('vdata[ordering]')?>" class="w300"></td>
    </tr>    
</table>
<?php echo form_close();?>