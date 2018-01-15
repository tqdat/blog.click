<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="row">
  <div class="col-md-12">
    <!-- general form elements disabled -->
    <div class="box box-warning">
      <div class="box-body">
        <form role="form">
          <!-- text input -->
          <div class="form-group">
            <label>Tên website</label>
            <input type="text" name="vdata[site_name]" class="form-control" value="<?=$this->config->item('site_name')?>">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="vdata[site_email]" class="form-control" value="<?=$this->config->item('site_email')?>">
          </div>
          <div class="form-group">
            <label>Facebook</label>
            <input type="text" name="vdata[site_facebook]" class="form-control" value="<?=$this->config->item('site_facebook')?>">
          </div>
          <div class="form-group">
            <label>Skype</label>
            <input type="text" name="vdata[site_skype]" class="form-control" value="<?=$this->config->item('site_skype')?>">
          </div>
          <div class="form-group">
            <label>Google Plus</label>
            <input type="text" name="vdata[site_google]" class="form-control" value="<?=$this->config->item('site_google')?>">
          </div>
          <div class="form-group">
            <label>Từ khóa</label>
            <textarea class="form-control"  rows="2" name="vdata[site_keyword]"><?=$this->config->item('site_keyword')?></textarea>
          </div>
          <div class="form-group">
            <label>Miêu tả</label>
            <textarea class="form-control"  rows="2" name="vdata[site_des]"><?=$this->config->item('site_des')?></textarea>
          </div>
          <div class="form-group">
            <label>Đóng mở website</label>
            <input type="radio" name="site_close" value="0" <?=($this->config->item('site_close') == 0)?'checked="checked"':'';?>> <span>Mở</span>
            <input type="radio" value="1" <?=($this->config->item('site_close') == 1)?'checked="checked"':'';?>> <span>Đóng</span>
          </div>

          <div class="form-group">
            <label>Nội dung đóng site</label>
            <textarea class="form-control"  rows="3" name="vdata[site_close_msg]"><?=$this->config->item('site_close_msg')?></textarea>
          </div>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
<?php echo form_close();?>