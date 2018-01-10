<?php echo form_open('tuychon/linhvuc/dels',  array('id' => 'admindata'));
$page = segment(4,'int');
?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Chủ đề Tour <span class="pages"><?=$pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Chủ đề (vi)</th>
            <th>Chủ đề (en)</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $en = $this->chude->get_chude_en($rs->cdt_id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->cdt_id?>"></td>
        <td align="center"><?=$rs->cdt_id?></td>
        <td><?=$rs->name?></td>
        <td><?=$en->name?></td>
        <td align="center">
            
            <?php echo icon_edit('tuychon/chude/edit/'.$rs->cdt_id.'/'.$page)?>
            <?php echo icon_del('tuychon/chude/del/'.$rs->cdt_id.'/'.$page)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Chủ đề Tour <span class="pages"><?=$pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>