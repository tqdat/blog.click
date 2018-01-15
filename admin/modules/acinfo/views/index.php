<?
// echo $this->session->data['user_id'].'<br />';
// echo $this->session->data['fullname'].'<br />';
?>
<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <label>Tên thành viên</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo $rs->fullname?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $rs->email?>">
                </div>
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $rs->username?>">
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" name="password" >
                </div>
                <div class="form-group">
                    <label>Mật khẩu nhắc lại</label>
                    <input type="password" class="form-control" name="password">
                </div>
            </form>
        </div>
    </div>
</div>
