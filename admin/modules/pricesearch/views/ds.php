<?php echo form_open('bank/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Giá tìm kiếm</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?=$rs->id?></td>
        <td style="text-align:center;"><a href="<?=site_url('pricesearch/edit/'.$rs->id)?>"><?=$rs->price?></a></td>
        <td align="center">
            <?php echo icon_edit('pricesearch/edit/'.$rs->id)?>
            <?php echo icon_del('pricesearch/del/'.$rs->id);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>  
</table>
<?php echo form_close()?>
