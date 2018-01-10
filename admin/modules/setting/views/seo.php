<?=form_open(uri_string(),array('id'=>'admindata'))?>
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-body">
            <form role="form">
                <input type="hidden" name="seocode" value="1">
                <div class="form-group">
                    <label>Bing</label>
                    <input type="text" name="cf_yahoo" class="form-control" value="<?php echo $cf_yahoo?>">
                </div>
                <div class="form-group">
                    <label>Alexa Code</label>
                    <input type="text" name="cf_alexa" class="form-control" value="<?php echo $cf_alexa?>">
                </div>
                <div class="form-group">
                    <label>Google Webmaster Code</label>
                    <input type="text" name="cf_google_webmaster" class="form-control" value="<?php echo $cf_google_webmaster?>">
                </div>
                <div class="form-group">
                    <label>Google Analytics Code</label>
                    <input type="text" name="cf_google_analytics" class="form-control" value="<?php echo $cf_google_analytics?>">
                </div>
            </form>
        </div>
    </div>
</div>
<?=form_close()?>
