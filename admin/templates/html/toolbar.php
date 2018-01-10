<div id="toolbar">
    <?php if(isset($save)){?>
        <a class="btn btn-app" onclick="return action_apply();" href="javascript:;">
            <span class="fa fa-save"></span>Áp dụng
        </a>
    <?php }?>
    
    <?php if(isset($apply)){?>
        <a class="btn btn-app" onclick="return action_save();" href="javascript:;">
        <span class="fa fa-save">
        </span>
        Lưu
        </a>
    <?php }?>
    
    <?php if(isset($cancel)){?>
        <a class="btn btn-app" href="<?php echo site_url($cancel)?>">
        <span class="fa fa-ban">
        </span>
        Hủy
        </a>
    <?php }?>
    
    <?php if(isset($delete)){?>
        <a class="btn btn-app" onclick="return action_del();" href="javascript:;">
        <span class="fa fa-trash">
        </span>
        Xóa
        </a>
    <?php }?>    
    
    <?php if(isset($add)){
    $add = explode('|',$add);
    $add_link = $add[0];
    ?>                  
        <a class="btn btn-app" href="<?=site_url($add_link)?>">
        <span class="fa fa-plus">
        </span>
        Thêm mới
        </a>
    <?php }?>
    
    <?php if(isset($back)){
    $back = explode('|',$back);
    $back_link = $back[0];
    ?>                  
        <a class="btn btn-app" href="<?=site_url($back_link)?>">
        <span class="fa fa-undo">
        </span>
        Quay lại
        </a>
    <?php }?>
</div>