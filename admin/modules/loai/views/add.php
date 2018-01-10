<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tên loại</td>
        <td>
            <input type="text" name="vdata[ten_loai]" value="<?php echo set_value('vdata[ten_loai]')?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo set_value('vdata[ordering]')?>" class="w100"></td>
    </tr> 
</table>
<?php echo form_close();?>
