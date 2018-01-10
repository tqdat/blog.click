<?php echo form_open(uri_string(), array('id'=>'admindata'));

?>
<input type="hidden" name="cat_id" value="0">
<div class="row">
  <div class="col-md-12">
    <div class="box box-warning">
      <div class="box-body">
        <form role="form">
          <div class="form-group">
            <label>Danh mục</label>
            <input type="text" name="data[cat_name]" class="form-control" value="<?php echo set_value('data[cat_name]')?>">
          </div>
          <div class="form-group">
            <label>Tiêu đề SEO</label>
            <input type="text" name="data[cat_name_seo]" class="form-control" value="<?php echo set_value('data[cat_name_seo]')?>">
          </div>
          <div class="form-group">
            <label>Hiển thị</label>
            <input type="radio" name="data[published]" value="1" <?php echo (set_value('data[published]') == 1)?'checked="checked"':'checked="checked"';?>> <span>Có</span>
            <input type="radio" name="data[published]" value="0" <?php echo (set_value('data[published]') == 0)?'checked="checked"':'';?>> <span>Không</span> 
          </div>
          <div class="form-group">
            <label>Hiển thị Menu</label>
            <input type="radio" name="data[cat_is_menu]" value="1" <?php echo (set_value('data[cat_is_menu]') == 1)?'checked="checked"':'checked="checked"';?>> <span>Có</span>
            <input type="radio" name="data[cat_is_menu]" value="0" <?php echo (set_value('data[cat_is_menu]') == 0)?'checked="checked"':'';?>> <span>Không</span> 
          </div>
          <div class="form-group">
            <label>Danh mục cha</label>
            <select name="data[parent_id]" class="form-group">
              <option value="0">Danh mục cha</option>
              <?foreach($listmain as $val):$listsub = $this->category->get_all_category($val->cat_id);?>
                <option value="<?php echo $val->cat_id?>"><?php echo $val->cat_name?></option>
                <?foreach($listsub as $val1):?>
                  <option value="<?php echo $val1->cat_id?>">|__<?php echo $val1->cat_name?></option>    
                  <?endforeach;?>
                  <?endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label>Sắp xếp</label>
                <input type="text" name="data[cat_order]" class="form-control" value="<?=set_value('data[cat_order]')?>">
              </div>
              <div class="form-group">
                <label>Miêu tả</label>
                <!-- <?=vnit_editor(set_value('data[cat_des]'),'data[cat_des]','cat_des')?> -->
                <textarea class="form-control" rows="2" name="data[cat_des]"><?=set_value('data[cat_des]')?></textarea>
              </div>
              <div class="form-group">
                <label>Từ khóa</label>
                <textarea class="form-control" rows="2" name="data[cat_keyword]"><?=set_value('data[cat_keyword]')?></textarea>
              </div>
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
    <?php echo form_close();?>