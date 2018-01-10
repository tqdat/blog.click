<div class="htabs">
    <?foreach($this->language as $lang):?>
    <a href="javascript:;" data_key="language<?=$lang->lang_id?>" class="<?=($lang->lang_default == 1)?'selected':''?>"><img src="<?=base_url()?>templates/images/flags/<?=$lang->lang_icon?>.png" alt=""><?=$lang->lang_name?></a>
    <?endforeach;?>
</div>
<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="cat_id" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Hiển thị</td>
        <td>
            <input type="radio" name="vdata[published]" value="1" <?php echo (set_value('vdata[published]') == 1)?'checked="checked"':'checked="checked"';?>>Có
            <input type="radio" name="vdata[published]" value="0" <?php echo (set_value('vdata[published]') == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Vị trí hiển thị</td>
        <td>
            <select name="vdata[is_home]">
                <option value="1">Trang chủ</option>
                <option value="2">Cột phải</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=set_value('vdata[cat_order]')?>"></td>
    </tr>
</table>
<?foreach($this->language as $lang):?>
<div class="lang" id="language<?=$lang->lang_id?>" style="display: <?=($lang->lang_default == 1)?'block':'none'?>;">
    <table class="form">
        <tr>
            <td class="label" style="width: 150px;">Tiêu đề ngắn</td>
            <td><input type="text" name="vdata[name_small][<?=$lang->lang_id?>]" value="<?php echo set_value('vdata[name_small]['.$lang->lang_id.']')?>" class="w300"></td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Tiêu đề</td>
            <td><input type="text" name="vdata[name][<?=$lang->lang_id?>]" value="<?php echo set_value('vdata[name]['.$lang->lang_id.']')?>" class="w300"></td>
        </tr>
        <tr>
            <td class="label">Miêu tả</td>
            <td>
                <textarea style="width: 400px;" rows="2" name="vdata[des][<?=$lang->lang_id?>]"><?=set_value('vdata[des]['.$lang->lang_id.']')?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label">Từ khóa</td>
            <td>
                <textarea style="width: 400px;" rows="2" name="vdata[keyword][<?=$lang->lang_id?>]"><?=set_value('vdata[keyword]['.$lang->lang_id.']')?></textarea>
            </td>
        </tr>
    </table>
</div>
<?endforeach;?>
<?php echo form_close();?>