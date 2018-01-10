<?=form_open(uri_string(),array('id'=>'admindata'))?>
<input type="hidden" name="seocode" value="1">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Bing</td>
        <td><input type="text" name="cf_yahoo" class="w400" value="<?php echo $cf_yahoo?>"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Alexa Code</td>
        <td><input type="text" name="cf_alexa" class="w400" value="<?php echo $cf_alexa?>"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Google Webmaster Code</td>
        <td><input type="text" name="cf_google_webmaster" class="w400" value="<?php echo $cf_google_webmaster?>"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Google Analytics Code</td>
        <td><input type="text" name="cf_google_analytics" class="w400" value="<?php echo $cf_google_analytics?>"></td>
    </tr>
</table>
<?=form_close()?>
