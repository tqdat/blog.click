<?=form_open(base_url().uri_string(),array('id'=>'admin_login'))?>
<div class="msg">
<? if($msg != ''){ echo $msg;}?> 
<?=$this->session->get_flashdata('message')?>
</div>
<div class="item">
    <label>Tên đăng nhập</label>
    <input class="username" type="text" value="<?=set_value('username')?>" name="username">
</div>
<div class="item">
    <label>Mật khẩu</label>
    <input class="password" type="password" name="password">
</div>
<div class="item_bt">
    <input type="submit" value="Đăng nhập" class="bt_login">
    <a href="#" class="lostpass">Quên mật khẩu ?</a>
</div>
<div class="item_bt"></div>
<?=form_close()?>

