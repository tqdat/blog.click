<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label">Nhóm</td>
        <td>
            <select name="vdata[parent_id]" class="w250">
                <option value="0">Nhóm chính</option>
                <?foreach($main as $val):?>
                <option value="<?=$val->id?>" <?=($val->id == $rs->parent_id)?'selected="selected"':'';?>><?=$val->name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Tiêu đề</td>
        <td><input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[stt]" value="<?=$rs->stt?>"></td>
    </tr>

</table>
<?php echo form_close();?>