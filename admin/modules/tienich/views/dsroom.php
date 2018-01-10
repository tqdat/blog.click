<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="id">ID</th>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th>Tiêu đề</th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    foreach($list as $rs):
    ?>
    <tr class="row1">
        <td><?php echo $rs->type_id?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->type_id?>"></td>
        <td><a href="<? echo site_url('tienich/edittype/'.$rs->type_id)?>"><?php echo $rs->type_name?></a></td>
        <td align="center">
            <?php echo icon_edit('tienich/edittype/'.$rs->type_id)?>
            <?php echo icon_del('tienich/deltype/'.$rs->type_id)?>
        </td>
    </tr>   
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
