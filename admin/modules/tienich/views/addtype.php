<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tiêu đề</td>
        <td><input type="text" name="vdata[type_name]" value="<?php echo set_value('vdata[type_name]')?>" class="w300"></td>
    </tr>
</table>
<?php echo form_close();?>