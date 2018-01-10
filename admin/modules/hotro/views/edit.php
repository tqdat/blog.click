<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label">Tiêu đề</td>
        <td><input type="text" name="vdata[title]" value="<?php echo $rs->title?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Tên</td>
        <td><input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Nick Yahoo</td>
        <td><input type="text" name="vdata[nick]" value="<?php echo $rs->nick?>" class="w300"></td>
    </tr> 
    <tr>
        <td class="label" style="width: 150px;">Nick Skype</td>
        <td><input type="text" name="vdata[skype]" value="<?php echo $rs->skype?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Phone</td>
        <td><input type="text" name="vdata[phone]" value="<?php echo $rs->phone?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Email</td>
        <td><input type="text" name="vdata[email]" value="<?php echo $rs->email?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo $rs->ordering?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Hình ảnh</td>
        <td>
            <input type="file" name="userfile">
            <?if($rs->images != ''){?>
            <br>
            <img src="<?=base_url_site()?>data/support/<?=$rs->images?>" alt="">
            <?}?>
        
        </td>
    </tr>

</table>
<?php echo form_close();?>