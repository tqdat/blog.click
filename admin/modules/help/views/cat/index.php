<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="id">ID</th>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th>Danh mục</th>
            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    ?>
    <tr class="row<?php echo $k?>">
        <td><?php echo $rs->catid?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo$rs->catid?>"></td>
        <td><a href="<? echo site_url('help/editcat/'.$rs->catid)?>"><?php echo $rs->catname?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->catid?>" value="<?php echo $rs->ordering?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->catid?>">
        </td>
        <td align="center">
            <?php echo icon_edit('help/editcat/'.$rs->catid)?>
            <span id="publish<?php echo $rs->catid?>"><?php echo icon_active("'help_cat'","'catid'",$rs->catid,$rs->published)?></span>
            <?php echo icon_del('help/delcat/'.$rs->catid)?>
        </td>
    </tr>
    <?
    $k = 1 - $k;
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
