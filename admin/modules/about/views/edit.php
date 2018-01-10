<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tiêu đề</td>
        <td><input type="text" name="vdata[title]" value="<?php echo $rs->title?>" class="w500"></td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=$rs->ordering?>"></td>
    </tr>
    <tr>
        <td class="label">Miêu tả</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="vdata[des]"><?=$rs->des?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label">Từ khóa</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="vdata[keyword]"><?=$rs->keyword?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <p>Nội dung</p>
            <?=vnit_editor($rs->content,'vdata[content]','full')?>
        </td>
    </tr>

</table>
<?php echo form_close();?>