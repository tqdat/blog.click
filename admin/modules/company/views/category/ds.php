<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên danh mục</th>

            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
   
    ?>
    <tr class="row<?php echo $k?>">
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->catid?>"></td>
        <td><?php echo $rs->catid?></td>
        <td><a href="<? echo site_url('company/category/edit/'.$catid.'/'.$rs->catid)?>"><?php echo $rs->catname?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->catid?>" value="<?php echo $rs->ordering?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->catid?>">
        </td>
        <td align="center">
            <?php echo icon_edit('company/category/edit/'.$catid.'/'.$rs->catid)?>
            <span id="publish<?php echo $rs->catid?>"><?php echo icon_active("'company_cat'","'catid'",$rs->catid,$rs->published)?></span>
            <?php echo icon_del('company/category/delsubcat/'.$catid.'/'.$rs->catid)?>
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
    $.post(base_url+"company/category/save_order_maincat",fields, function(data) {
        location.reload();
    });
}
</script>
