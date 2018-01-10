<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tỉnh, Thành phố</td>
        <td>
            <select name="vdata[parentid]" style="width: 308px;">
                <?foreach($listcity as $val):?>
                <option value="<?=$val->city_id?>"><?=$val->city_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Quận, Huyện</td>
        <td><input type="text" name="vdata[city_name]" value="<?php echo set_value('vdata[city_name]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo set_value('vdata[ordering]')?>" class="w300"></td>
    </tr>    
</table>
<?php echo form_close();?>