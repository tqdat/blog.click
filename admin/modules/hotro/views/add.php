<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề</label>
                    <input type="text" name="vdata[title]" value="<?php echo $rs->title?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tên</label>
                    <input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nick Yahoo</label>
                    <input type="text" name="vdata[nick]" value="<?php echo $rs->nick?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nick Skype</label>
                    <input type="text" name="vdata[skype]" value="<?php echo $rs->skype?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" name="vdata[phone]" value="<?php echo $rs->phone?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" name="vdata[email]" value="<?php echo $rs->email?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sắp xếp</label>
                    <input type="text" name="vdata[ordering]" value="<?php echo $rs->ordering?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Hình ảnh</label>
                    <input type="file" name="userfile">
                    <?if($rs->images != ''){?>
                    <br>
                    <img src="<?=base_url_site()?>data/support/<?=$rs->images?>" alt="">
                    <?}?>
                </div>
            </div><!-- /.box-body -->
        </form>
    </div>
</div>
<?php echo form_close();?>

