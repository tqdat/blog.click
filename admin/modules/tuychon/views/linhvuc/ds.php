<?php echo form_open('tuychon/linhvuc/dels',  array('id' => 'admindata'));?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Lĩnh vực
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Lĩnh vực (vi)</th>
            <th>Lĩnh vực (en)</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $en = $this->linhvuc->get_llv_en($rs->llv_id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->llv_id?>"></td>
        <td align="center"><?=$rs->llv_id?></td>
        <td><?=$rs->name?></td>
        <td><?=$en->name?></td>
        <td align="center">
            
            <?php echo icon_edit('tuychon/linhvuc/ledit/'.$rs->llv_id)?>
            <?php echo icon_del('tuychon/linhvuc/ldel/'.$rs->llv_id)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Quận, huyện
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>