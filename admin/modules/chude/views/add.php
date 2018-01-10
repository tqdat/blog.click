<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tên chủ đề</td>
        <td>
            <input type="text" name="vdata[ten_chude]" value="<?php echo set_value('vdata[ten_chude]')?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label">Tên chủ đề (Đầu đủ)</td>
        <td><input type="text" name="vdata[small_chude]" value="<?=$rs->small_chude?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Từ khóa</td>
        <td><textarea style="width: 300px;" rows="2" name="vdata[keyword_chude]"><?=$rs->keyword_chude?></textarea></td>
    </tr>
    <tr>
        <td class="label">Miêu tả</td>
        <td><textarea style="width: 300px;" rows="2" name="vdata[des_chude]"><?=$rs->des_chude?></textarea></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo set_value('vdata[ordering]')?>" class="w100"></td>
    </tr> 
</table>
<?php echo form_close();?>
