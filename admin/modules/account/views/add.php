<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">   
    <tr>
        <td class="label" style="width: 150px;">Nhóm thành viên</td>
        <td>
            <select name="group_id" style="width: 305px;">
            <?php foreach($listgroup as $g):?>
                <option value="<?php echo $g->group_id?>"><?php echo $g->group_name?></option>
            <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Tên thành viên</td>
        <td><input type="text" class="w300" name="fullname" value="<?php echo set_value('fullname')?>"></td>
    </tr>
    <tr>
        <td class="label">Email</td>
        <td><input type="text" class="w300" name="email" value="<?php echo set_value('email')?>"></td>
    </tr>  
    <tr>
        <td class="label">Tên đăng nhập</td>
        <td><input type="text" class="w300" name="username" value="<?php echo set_value('username')?>"></td>
    </tr>  
    <tr>
        <td class="label">Mật khẩu</td>
        <td><input type="password" class="w300" name="password" value=""></td>
    </tr>  
    <tr>
        <td class="label">Mật khẩu nhắc lại</td>
        <td><input type="password" class="w300" name="re_password" value=""></td>
    </tr> 
    <tr>
        <td class="label">Địa chỉ</td>
        <td><input type="text" class="w300" name="address" value="<?=set_value('address')?>"></td>
    </tr> 
    <tr>
        <td class="label">Điện thoại</td>
        <td><input type="text" class="w300" name="phone" value="<?=set_value('phone')?>"></td>
    </tr>
    <tr>
        <td class="label">Kích hoạt</td>
        <td><input type="radio" name="published" value="0" <?php echo (set_value('published') == 0)?'checked="checked"':'';?>> Không 
        <input type="radio" name="published" value="1" <?php echo (set_value('published') == 1)?'checked="checked"':'checked="checked"';?>>Có</td>
    </tr>
</table>
<?php echo form_close();?>
