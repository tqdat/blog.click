<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr>
            
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên quảng cáo</th>

            <th style="width: 70px;">Lượt xem</th>
            <th style="width: 120px;">Ngày bắt đầu</th>
            <th style="width: 120px;">Ngày kết thúc</th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    ?>
    <tr class="row<?php echo $k?>">
        
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo$rs->id?>"></td>
        <td><?php echo $rs->id?></td>
        <td><a href="<? echo site_url('adv/product/edit/'.$rs->id)?>"><?php echo $rs->name?></a></td>

        <td align="center"><?=$rs->clicker?></td>
        <td><?=date('d/m/Y H:i',$rs->date_begin)?></td>
        <td><?=date('d/m/Y H:i',$rs->date_end)?></td>
        <td align="center">
            <?php echo icon_edit('adv/product/edit/'.$rs->id)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'adv_product'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('adv/product/del/'.$rs->id)?>
        </td>
    </tr>
    <?
    $k = 1 - $k;
    endforeach;?>
</table>
<?php echo form_close()?>
