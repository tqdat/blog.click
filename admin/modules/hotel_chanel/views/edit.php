<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="cat_id" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Danh mục</td>
        <td><input type="text" name="data[cat_name]" value="<?php echo $rs->cat_name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Tiêu đề SEO</td>
        <td><input type="text" name="data[cat_name_seo]" value="<?php echo $rs->cat_name_seo?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Hiển thị</td>
        <td>
            <input type="radio" name="data[published]" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'';?>>Có
            <input type="radio" name="data[published]" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Hiển thị Menu</td>
        <td>
            <input type="radio" name="data[cat_is_menu]" value="1"  <?php echo ($rs->cat_is_menu == 1)?'checked="checked"':'';?>>Có
            <input type="radio" name="data[cat_is_menu]" value="0"  <?php echo ($rs->cat_is_menu == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Danh mục cha</td>
        <td>
            <select name="data[parent_id]" class="w300">
                <option value="0">Danh mục cha</option>
                <?foreach($listmain as $val):
                    $listsub = $this->hotel_chanel->get_all_hotel_chanel($val->cat_id);
                ?>
                <option value="<?php echo $val->cat_id?>" <?=($val->cat_id == $rs->parent_id)?'selected="selected"':'';?>><?php echo $val->cat_name?></option>
                    <?foreach($listsub as $val1):?>
                    <option value="<?php echo $val1->cat_id?>" <?=($val1->cat_id == $rs->parent_id)?'selected="selected"':'';?>>|__<?php echo $val1->cat_name?></option>    
                    <?endforeach;?>
                <?endforeach;?>
                
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="data[cat_order]" value="<?=$rs->cat_order?>"></td>
    </tr>
    <tr>
        <td class="label">Miêu tả</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="data[cat_des]"><?=$rs->cat_des?></textarea>
        </td>
    </tr>
    <tr>
        <td class="label">Từ khóa</td>
        <td>
            <textarea style="width: 400px;" rows="2" name="data[cat_keyword]"><?=$rs->cat_keyword?></textarea>
        </td>
    </tr>
</table>
<?php echo form_close();?>