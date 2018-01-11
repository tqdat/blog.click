<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<div class="col-md-6">
    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên ảnh</label>
                <input type="text" name="vdata[ten]" value="<?php echo set_value('vdata[ten]')?>" style="width: 99%;">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Links</label>
                <input type="text" name="vdata[links]" value="<?php echo set_value('vdata[links]')?>" style="width: 99%;">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hiển thị tên slide</label>
                <input type="radio" name="vdata[show_title]" value="1" <?php echo (set_value('vdata[show_title]') == 1)?'checked="checked"':'checked="checked"';?>>Có
                <input type="radio" name="vdata[show_title]" value="0" <?php echo (set_value('vdata[show_title]') == 0)?'checked="checked"':'';?>> Không 
            </div>
        </div><!-- /.box-body -->
    </form>
</div>
<fieldset class="content-right">
    <legend>Thêm ảnh kích thước 990*300 px</legend>
    <div class="img-news">
        <img src="<?=base_url()?>templates/images/img_news_no.png" alt="">
    </div>
    <div align="center"><input type="checkbox" value="1" name="del">Xóa hình</div>
    <div align="center"><input type="file" name="userfile"></div>
</fieldset>



