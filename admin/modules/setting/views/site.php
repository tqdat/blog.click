<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tên website</td>
        <td>
            <input type="text" name="vdata[site_name]" class="w500" value="<?=$this->config->item('site_name')?>">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Email</td>
        <td>
            <input type="text" name="vdata[site_email]" class="w300" value="<?=$this->config->item('site_email')?>">
        </td>
    </tr>
	<tr>
        <td class="label" style="width: 150px;">Facebook</td>
        <td>
            <input type="text" name="vdata[site_facebook]" class="w300" value="<?=$this->config->item('site_facebook')?>">
        </td>
    </tr>
	<tr>
        <td class="label" style="width: 150px;">Skype</td>
        <td>
            <input type="text" name="vdata[site_skype]" class="w300" value="<?=$this->config->item('site_skype')?>">
        </td>
    </tr>
	<tr>
        <td class="label" style="width: 150px;">Google Plus</td>
        <td>
            <input type="text" name="vdata[site_google]" class="w300" value="<?=$this->config->item('site_google')?>">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Từ khóa</td>
        <td>
            <textarea style="width: 500px;" rows="3" name="vdata[site_keyword]"><?=$this->config->item('site_keyword')?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Miêu tả</td>
        <td>
            <textarea style="width: 500px;" rows="3" name="vdata[site_des]"><?=$this->config->item('site_des')?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Đóng mở website</td>
        <td>
            <input type="radio" name="site_close" value="0" <?=($this->config->item('site_close') == 0)?'checked="checked"':'';?>> Mở
            <input type="radio" value="1" <?=($this->config->item('site_close') == 1)?'checked="checked"':'';?>> Đóng 
        </td>
    </tr>
    <tr>
        <td class="label">Nội dung đóng site</td>
        <td><textarea style="width: 500px;" rows="5" name="vdata[site_close_msg]"><?=$this->config->item('site_close_msg')?></textarea></td>
    </tr>
</table>
<?php echo form_close();?>