<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr>
            
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên quảng cáo</th>
            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    ?>
    <tr class="row<?php echo $k?>">
        
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?php echo $rs->id?></td>
        <td><a href="<? echo site_url('banner/edit/'.$rs->id)?>"><?php echo $rs->name?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->id?>" value="<?php echo $rs->ordering?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('banner/edit/'.$rs->id)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'banner'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('banner/del/'.$rs->id)?>
        </td>
    </tr>
    <?
    $k = 1 - $k;
    endforeach;?>
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"banner/save_order",fields, function(data) {
        location.reload();
    });
}
</script>