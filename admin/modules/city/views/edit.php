<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tỉnh, Thành phố</td>
        <td><input type="text" name="vdata[city_name]" value="<?php echo $rs->city_name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td>
            <?if($rs->icon != ''){?>
               <img src="<?=base_url_site()?>data/pcat/80/<?=$rs->icon?>" alt=""><br />
            <?}?>
            <input type="file" name="userfile">
        </td>
    </tr>    
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo $rs->ordering?>" class="w300"></td>
    </tr>    
</table>
<?php echo form_close();?>