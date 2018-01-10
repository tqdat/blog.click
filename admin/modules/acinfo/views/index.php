<?
echo $this->session->data['user_id'].'<br />';
echo $this->session->data['fullname'].'<br />';
?>
<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">   
    <tr>
        <td class="label" style="width: 150px;">Tên thành viên</td>
        <td><input type="text" class="w200" name="fullname" value="<?php echo $rs->fullname?>"></td>
    </tr>
    <tr>
        <td class="label">Email</td>
        <td><input type="text" class="w200" name="email" value="<?php echo $rs->email?>"></td>
    </tr>  
    <tr>
        <td class="label">Tên đăng nhập</td>
        <td><input type="text" class="w200" name="username" value="<?php echo $rs->username?>"></td>
    </tr>  
    <tr>
        <td class="label">Mật khẩu</td>
        <td><input type="password" class="w200" name="password" value=""></td>
    </tr>  
    <tr>
        <td class="label">Mật khẩu nhắc lại</td>
        <td><input type="password" class="w200" name="re_password" value=""></td>
    </tr> 
</table>
<?php echo form_close();?>
