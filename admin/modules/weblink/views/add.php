<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 100px;">Liên kết</td>
        <td><input type="text" name="vdata[name]" value="<?php echo set_value('vdata[name]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Link</td>
        <td><input type="text" name="vdata[link]" value="<?=set_value('vdata[link]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Logo</td>
        <td><input type="file" name="userfile"> (200 x 130)</td>
    </tr>
</table>
<?php echo form_close();?>