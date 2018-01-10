<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="catid" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Danh mục</td>
        <td><input type="text" name="vdata[catname]" value="<?php echo set_value('vdata[catname]')?>" class="w300"></td>

    </tr>
    <tr>
        <td class="label">Hiển thị</td>
        <td>
            <input type="radio" name="vdata[published]" value="1" <?php echo (set_value('vdata[published]') == 1)?'checked="checked"':'checked="checked"';?>>Có
            <input type="radio" name="vdata[published]" value="0" <?php echo (set_value('vdata[published]') == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=set_value('vdata[ordering]')?>"></td>
    </tr>

</table>
<?php echo form_close();?>