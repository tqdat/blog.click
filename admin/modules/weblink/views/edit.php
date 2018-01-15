<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<div class="row">
    <input type="hidden" name="id" value="<?=$rs->id?>">
    <div class="col-md-12">
        <div class="box box-primary">
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Liên kết</label>
                    <input type="text" name="vdata[name]" value="<?php $rs->name?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Link</label>
                    <input type="text" name="vdata[link]" value="<?=$rs->link?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <input type="file" name="userfile"><p>(200 x 130)</p> 
                </div>
            </div><!-- /.box-body -->
        </form>
    </div>
</div>
<?php echo form_close();?>