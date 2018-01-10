<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="user_id" value="<?php echo $rs->user_id?>">
<div class="row">
    <div class="col-md-6">
        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        <label>Nhóm thành viên</label>
                        <select class="form-control" name="group_id">
                            <?php foreach($listgroup as $g):?>
                                <option value="<?php echo $g->group_id?>" <?php echo ($rs->group_id == $g->group_id)?'selected="selected"':'';?>><?php echo $g->group_name?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tên thành viên </label>
                        <input type="text" name="fullname" class="form-control" value="<?php echo $rs->fullname?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $rs->email?>">
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $rs->username?>">
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
                        <input type="text" name="address" class="form-control" value="<?=$rs->address?>">
                    </div>
                    <div class="form-group">
                        <label>Điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $rs->phone?>">
                    </div>
                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <input type="radio" name="published" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>><span>Không</span> 
                        <input type="radio" name="published" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'';?>><span>Có</span>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
<?php echo form_close();?>
