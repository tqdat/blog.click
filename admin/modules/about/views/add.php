<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tiêu đề</td>
        <td><input type="text" name="vdata[title]" value="<?php echo set_value('vdata[title]')?>" class="w500"></td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=set_value('vdata[ordering]')?>"></td>
    </tr>
    <tr>
        <td class="label">Miêu tả</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="vdata[des]"><?=set_value('vdata[des]')?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label">Từ khóa</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="vdata[keyword]"><?=set_value('vdata[keyword]')?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>Nội dung</p>
            <?=vnit_editor(set_value('vdata[content]'),'vdata[content]','full')?>
        </td>
    </tr>

</table>
<?php echo form_close();?>