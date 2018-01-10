<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Hiển thị</td>
        <td><input type="checkbox" name="active" <?=($active == 1)?'checked="checked"':'';?> value="1"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Tên quảng cáo trái</td>
        <td><input type="text" name="adv_left_name" value="<?=$adv_left_name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Link quảng cáo trái</td>
        <td><input type="text" name="adv_left_link" value="<?=$adv_left_link?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Hình quảng cáo trái</td>
        <td><input type="file" name="userfile1"> (width: 120px)</td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Tên quảng cáo phải</td>
        <td><input type="text" name="adv_right_name" value="<?=$adv_right_name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Link quảng cáo phải</td>
        <td><input type="text" name="adv_right_link" value="<?=$adv_right_link?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Hình quảng cáo phải</td>
        <td><input type="file" name="userfile2"> (width: 120px)</td>
    </tr>
</table>
<?php echo form_close();?>
