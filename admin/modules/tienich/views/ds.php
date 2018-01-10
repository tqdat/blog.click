<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="id">ID</th>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th>Tiêu đề</th>
            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    foreach($list as $rs):
    $sub = $this->tienich->getmain($rs->id);
    ?>
    <tr class="row1">
        <td><?php echo $rs->id?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><a href="<? echo site_url('tienich/edit/'.$rs->id)?>"><?php echo $rs->name?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->id?>" value="<?php echo $rs->stt?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('tienich/edit/'.$rs->id)?>
            <?php echo icon_del('tienich/del/'.$rs->id)?>
        </td>
    </tr>
    <?
    foreach($sub as $rs1):
    ?>
    <tr class="row0">
        <td><?php echo $rs1->id?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs1->id?>"></td>
        <td>|____<a href="<? echo site_url('tienich/edit/'.$rs1->id)?>"><?php echo $rs1->name?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs1->id?>" value="<?php echo $rs1->stt?>">
            <input type="hidden" name="id[]" value="<?php echo $rs1->id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('tienich/edit/'.$rs1->id)?>
            <?php echo icon_del('tienich/del/'.$rs1->id)?>
        </td>
    </tr>
    <?
    endforeach;?>    
    <?
    endforeach;?>
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"help/save_order_cat",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
