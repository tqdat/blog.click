<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="cat_id" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Kênh tin</td>
        <td><input type="text" name="vdata[channel_name]" value="<?php echo set_value('vdata[channel_name]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Danh mục</td>
        <td>
            <select name="vdata[cat_id]" class="w300">
                <?foreach($list as $val):?>
                <option value="<?php echo $val->cat_id?>"><?php echo $val->cat_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>

</table>
<?php echo form_close();?>