<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="id" value="<?=$rs->catid?>">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tiêu đề</td>
        <td><input type="text" name="vdata[catname]" value="<?php echo $rs->catname?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=$rs->ordering?>"></td>
    </tr>

</table>
<?php echo form_close();?>