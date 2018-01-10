<?php echo form_open('bank/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Chủ đề Tour</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id_chude?>"></td>
        <td><?=$rs->id_chude?></td>
        <td><?=$rs->ten_chude?></td>
        <td align="center">
            <?php echo icon_edit('chude/edit/'.$rs->id_chude)?>
            <span id="publish<?php echo $rs->id_chude?>"><?php echo icon_active("'chude'","'id_chude'",$rs->id_chude,$rs->published)?></span>
            <?php echo icon_del('chude/del/'.$rs->id_chude);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>  
</table>
<?php echo form_close()?>
