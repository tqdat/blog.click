<?php echo form_open('hotro/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên danh mục</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->catid?>"></td>
        <td><?=$rs->catid?></td>
        <td><a href="<?=site_url('dichvu/cat/edit/'.$rs->catid)?>"><?=$rs->catname?></a></td>
        <td align="center">
            <?php echo icon_edit('dichvu/cat/edit/'.$rs->catid)?>
            <?php echo icon_del('dichvu/cat/del/'.$rs->catid);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"sanpham/save_order",fields, function(data) {
        location.reload();
    });
}
</script>