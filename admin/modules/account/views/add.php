<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="row">
    <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        <label>Nhóm thành viên</label>
                        <select class="form-control" name="group_id">
                            <?php foreach($listgroup as $g):?>
                                <option value="<?php echo $g->group_id?>"><?php echo $g->group_name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tên thành viên </label>
                        <input type="text" name="fullname" class="form-control" value="<?php echo set_value('fullname')?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo set_value('email')?>">
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control" value="<?php echo set_value('username')?>">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu nhắc lại</label>
                        <input type="password" name="re_password" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo set_value('address')?>">
                    </div>
                    <div class="form-group">
                        <label>Điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo set_value('phone')?>">
                    </div>
                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <input type="radio" name="published" value="0" <?php echo (set_value('published') == 0)?'checked="checked"':'';?>><span>Không</span> 
                        <input type="radio" name="published" value="1" <?php echo (set_value('published') == 1)?'checked="checked"':'checked="checked"';?>><span>Có</span> 
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
<?php echo form_close();?>
