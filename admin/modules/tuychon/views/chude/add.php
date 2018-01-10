<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Loại lĩnh vực (vi)</td>
        <td>
            <input type="text" name="vi_name" value="<?php echo set_value('vi_name')?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Loại lĩnh vực (en)</td>
        <td>
            <input type="text" name="en_name" value="<?php echo set_value('en_name')?>" class="w300">
        </td>
    </tr> 
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td>
            <input type="text" name="order" value="<?php echo set_value('order')?>" class="w300">
        </td>
    </tr> 
</table>
<?php echo form_close();?>