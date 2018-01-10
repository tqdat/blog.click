<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Ngân hàng</td>
        <td>
            <input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td>
            <input type="file" name="userfile"><br>
            <img src="<?=base_url_site()?>data/img/<?=$rs->logo?>" alt="">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Chủ tài khoản</td>
        <td><input type="text" name="vdata[ctk]" value="<?php echo $rs->ctk?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Số tài khoản</td>
        <td><input type="text" name="vdata[stk]" value="<?php echo $rs->stk?>" class="w300"></td>
    </tr> 
</table>
<?php echo form_close();?>
