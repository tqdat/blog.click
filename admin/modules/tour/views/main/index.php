<?php echo form_open('tour/main/dels',  array('id' => 'admindata'));?> 
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
    $k = 1;
    foreach($list as $rs):
    $main1 = $this->main->get_all_main($rs->mainid);
    ?>
    <tr class="row<?php echo $k?>">
        <td><?php echo $rs->mainid?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo$rs->mainid?>"></td>
        <td><a href="<? echo site_url('tour/main/edit/'.$rs->mainid)?>"><?php echo $rs->name_small?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->mainid?>" value="<?php echo $rs->ordering?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->mainid?>">
        </td>
        <td align="center">
            <?php echo icon_edit('tour/main/edit/'.$rs->mainid)?>
            <span id="publish<?php echo $rs->cat_id?>"><?php echo icon_active("'main'","'mainid'",$rs->mainid,$rs->published)?></span>
        </td>
    </tr>
        <?
        foreach($main1 as $rs1):
        ?>
        <tr class="row<?php echo $k?>">
            <td><?php echo $rs1->mainid?></td>
            <td align="center"><input type="checkbox" name="ar_id[]" value="<? echo $rs1->mainid?>"></td>
            <td>|___<a href="<? echo site_url('tour/main/edit/'.$rs1->mainid)?>"><?php echo $rs1->name_small?></a></td>
            <td align="center">
                <input type="text" class="order" name="order_<? echo $rs1->mainid?>" value="<? echo $rs1->ordering?>">
                <input type="hidden" name="id[]" value="<? echo $rs1->mainid?>">
            </td>
            <td align="center">
                <? echo icon_edit('tour/main/edit/'.$rs1->mainid)?>
                <span id="publish<? echo $rs1->mainid?>"><? echo icon_active("'main'","'mainid'",$rs1->mainid,$rs1->published)?></span>
            </td>
        </tr>

        <?endforeach;?>
    
    <?
    $k = 1 - $k;
    endforeach;?>
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"tour/main/save_order",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
