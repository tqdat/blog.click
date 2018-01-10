<div style="margin-bottom: 10px; float: right;">
    Chọn thành phố: 
    <select onchange="window.open(this.value,'_self');" style="width: 150px;">
        <?foreach($allcity as $val):?>
        <option value="<?=base_url().'vitri/ds/?c='.$val->catid?>" <?=($c == $val->catid)?'selected="selected"':''?>><?=$val->name?></option>
        <?endforeach;?>
    </select>
    Địa điểm:
    <select onchange="window.open(this.value,'_self');" style="width: 150px;">
        <option value="<?=base_url().'vitri/ds/?c='.$c?>">Chọn địa điểm</option>
        <?foreach($diadiem as $val):?>
        <option value="<?=base_url().'vitri/ds/?c='.$c.'&d='.$val->d_id?>" <?=($d == $val->d_id)?'selected="selected"':''?>><?=$val->d_name?></option>
        <?endforeach;?>
    </select>    
</div>
<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Vị trí</th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    ?>
    <tr class="row<?php echo $k?>">
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->vitri_id?>"></td>
        <td><?php echo $rs->vitri_id?></td>
        <td><a href="<? echo site_url('vitri/edit/'.$rs->vitri_id.'/?c='.$rs->catid.'&d='.$rs->d_id)?>"><?php echo $rs->vitri_ten?></a></td>
        <td align="center">
            <?php echo icon_edit('vitri/edit/'.$rs->vitri_id.'/?c='.$rs->catid.'&d='.$rs->d_id)?>
            <span id="publish<?php echo $rs->vitri_id?>"><?php echo icon_active("'vitri'","'vitri_id'",$rs->vitri_id,$rs->published)?></span>
            <?php echo icon_del('vitri/del/'.$rs->vitri_id)?>
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
    $.post(base_url+"pcat/save_order_maincat",fields, function(data) {
        location.reload();
    });
}
</script>
