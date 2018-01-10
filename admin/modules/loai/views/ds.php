<?php echo form_open('bank/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Loại khách sạn</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id_loai?>"></td>
        <td><?=$rs->id_loai?></td>
        <td><?=$rs->ten_loai?></td>
        <td align="center">
            <?php echo icon_edit('loai/edit/'.$rs->id_loai)?>
            <span id="publish<?php echo $rs->id_loai?>"><?php echo icon_active("'loai'","'id_loai'",$rs->id_loai,$rs->published)?></span>
            <?php echo icon_del('loai/del/'.$rs->id_loai);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>  
</table>
<?php echo form_close()?>
