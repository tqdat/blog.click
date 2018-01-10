<?php echo form_open('hotel_chanel/dels',  array('id' => 'admindata'));?> 
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
    $main1 = $this->hotel_chanel->get_all_hotel_chanel($rs->cat_id);
    ?>
    <tr class="row<?php echo $k?>">
        <td><?php echo $rs->cat_id?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo$rs->cat_id?>"></td>
        <td><a href="<? echo site_url('hotel_chanel/edit/'.$rs->cat_id)?>"><?php echo $rs->cat_name?></a></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->cat_id?>" value="<?php echo $rs->cat_order?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->cat_id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('hotel_chanel/edit/'.$rs->cat_id)?>
            <span id="publish<?php echo $rs->cat_id?>"><?php echo icon_active("'hotel_chanel'","'cat_id'",$rs->cat_id,$rs->published)?></span>
        </td>
    </tr>
        <?
        foreach($main1 as $rs1):
        $main2 = $this->hotel_chanel->get_all_hotel_chanel($rs1->cat_id);
        ?>
        <tr class="row<?php echo $k?>">
            <td><?php echo $rs1->cat_id?></td>
            <td align="center"><input type="checkbox" name="ar_id[]" value="<? echo $rs1->cat_id?>"></td>
            <td>|___<a href="<? echo site_url('hotel_chanel/edit/'.$rs1->cat_id)?>"><?php echo $rs1->cat_name?></a></td>
            <td align="center">
                <input type="text" class="order" name="order_<? echo $rs1->cat_id?>" value="<? echo $rs1->cat_order?>">
                <input type="hidden" name="id[]" value="<? echo $rs1->cat_id?>">
            </td>
            <td align="center">
                <? echo icon_edit('hotel_chanel/edit/'.$rs1->cat_id)?>
                <span id="publish<? echo $rs1->cat_id?>"><? echo icon_active("'hotel_chanel'","'cat_id'",$rs1->cat_id,$rs1->published)?></span>
            </td>
        </tr>
            <?
            foreach($main2 as $rs2):
            ?>
            <tr class="row<?=$k?>">
                <td><?=$rs2->cat_id?></td>
                <td align="center"><input type="checkbox" name="ar_id[]" value="<?=$rs2->cat_id?>"></td>
                <td>|___|___<a href="<?=site_url('hotel_chanel/edit/'.$rs2->cat_id)?>"><?php echo $rs2->cat_name?></a></td>
                <td align="center">
                    <input type="text" class="order" name="order_<?=$rs2->cat_id?>" value="<?=$rs2->cat_order?>">
                    <input type="hidden" name="id[]" value="<?=$rs2->cat_id?>">
                </td>
                <td align="center">
                    <?php echo icon_edit('hotel_chanel/edit/'.$rs2->cat_id)?>
                    <span id="publish<?=$rs2->cat_id?>"><?php echo icon_active("'hotel_chanel'","'cat_id'",$rs2->cat_id,$rs2->published)?></span>
                </td>
            </tr>
            <?endforeach;?>
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
    $.post(base_url+"diadiem/save_order",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
