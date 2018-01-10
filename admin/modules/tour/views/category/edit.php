<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="cat_id" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Danh mục cha</td>
        <td>
            <select name="vdata[parent_id]" class="w300">
                <option value="0">Danh mục cha</option>
                <?foreach($listmain as $val):
                    $listsub = $this->category->get_all_category($val->cat_id);
                ?>
                <option value="<?php echo $val->cat_id?>" <?=($val->cat_id == $rs->parent_id)?'selected="selected"':'';?>><?php echo $val->name?></option>
                	<?foreach($listsub as $val2):
                    
                	?>
                		<option value="<?php echo $val2->cat_id?>" <?=($val2->cat_id == $rs->parent_id)?'selected="selected"':'';?>>|__<?php echo $val2->name?></option>
                	<?endforeach;?>
                
                <?endforeach;?>
                
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Hiển thị Trang chủ</td>
        <td>
            <input type="checkbox" value="1" name="is_homepage" <?=($rs->is_homepage == 1)?'checked="checked"':''?>> 
        </td>
    </tr>
    <tr>
        <td class="label">Hiển ở Menu</td>
        <td>
            <input type="checkbox" value="1" name="is_menu" <?=($rs->is_menu == 1)?'checked="checked"':''?>> (Áp dụng với danh mục là danh mục cha)
        </td>
    </tr>
    <tr>
        <td class="label">Hiển thị</td>
        <td>
            <input type="radio" name="published" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'';?>>Có
            <input type="radio" name="published" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr>
    <tr>
        <td class="label">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?=$rs->ordering?>"></td>
    </tr>

    <tr>
        <td class="label" style="width: 150px;">Tên danh mục ngắn</td>
        <td><input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="w300"></td>
    </tr>
        <tr>
            <td class="label" style="width: 150px;">Tên danh mục đầy đủ</td>
            <td><input type="text" name="vdata[name_small]" value="<?php echo $rs->name_small?>" class="w500"></td>
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
</table>
<?php echo form_close();?>