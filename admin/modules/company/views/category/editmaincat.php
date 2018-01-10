<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="catid" value="<?=$rs->catid?>">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Danh mục</td>
        <td><input type="text" name="vdata[catname]" value="<?php echo $rs->catname?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Hiển thị</td>
        <td>
            <input type="radio" name="vdata[published]" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'';?>>Có
            <input type="radio" name="vdata[published]" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=$rs->ordering?>"></td>
    </tr>

</table>
<?php echo form_close();?>