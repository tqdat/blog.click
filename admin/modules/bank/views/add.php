<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Ngân hàng</td>
        <td>
            <input type="text" name="vdata[name]" value="<?php echo set_value('vdata[name]')?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td><input type="file" name="userfile"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Chủ tài khoản</td>
        <td><input type="text" name="vdata[ctk]" value="<?php echo set_value('vdata[ctk]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Số tài khoản</td>
        <td><input type="text" name="vdata[stk]" value="<?php echo set_value('vdata[stk]')?>" class="w300"></td>
    </tr> 
</table>
<?php echo form_close();?>
