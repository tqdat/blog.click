<div id="toolbar">
    <?php if(isset($save)){?>
    <div id="toolbar-apply" class="button">
        <a class="btn btn-app" onclick="return action_apply();" href="javascript:;">
            <span class="fa fa-save"></span>Áp dụng
        </a>
    </div>
    <?php }?>
    
    <?php if(isset($apply)){?>
    <div id="toolbar-save" class="button">
        <a class="btn btn-app" onclick="return action_save();" href="javascript:;">
            <span class="fa fa-save">
            </span>
            Lưu
        </a>
    </div>
    <?php }?>
    
    <?php if(isset($cancel)){?>
    <div id="toolbar-cancel" class="button">
        <a class="btn btn-app" href="<?php echo site_url($cancel)?>">
            <span class="fa fa-ban">
            </span>
            Hủy
        </a>
    </div>
    <?php }?>
    
    <?php if(isset($delete)){?>
    <div id="toolbar-cancel" class="button">
        <a class="btn btn-app" onclick="return action_del();" href="javascript:;">
            <span class="fa fa-trash">
            </span>
            Xóa
        </a>
    </div>
    <?php }?>    
    
    <?php if(isset($add)){
        $add = explode('|',$add);
        $add_link = $add[0];
        ?> 
        <div  id="toolbar-new" class="button">                  
            <a class="btn btn-app" href="<?=site_url($add_link)?>">
                <span class="fa fa-plus">
                </span>
                Thêm mới
            </a>
        </div>
        <?php }?>

        <?php if(isset($back)){
            $back = explode('|',$back);
            $back_link = $back[0];
            ?>   
            <div id="toolbar-new" class="button">               
            <a class="btn btn-app" href="<?=site_url($back_link)?>">
                <span class="fa fa-undo">
                </span>
                Quay lại
            </a>
            </div>
            <?php }?>
        </div>