<div style="margin-bottom: 10px; float: right;">
    Chọn thành phố: 
    <select name="vdata[catid]" onchange="window.open(this.value,'_self');" style="width: 150px;">
        <?foreach($listcity as $val):?>
        <option value="<?=base_url().'city/district/?c='.$val->city_id?>" <?=($city_id == $val->city_id)?'selected="selected"':''?>><?=$val->city_name?></option>
        <?endforeach;?>
    </select>
</div>
<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="8">
                Hiện có <?php echo $num?> Quận, Huyện <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>    
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Thành phố</th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    ?>
    <tr class="row<?php echo $k?>">
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->city_id?>"></td>
        <td><?php echo $rs->city_id?></td>
        <td><a href="<? echo site_url('city/edit_district/'.$rs->parentid.'/'.$rs->city_id)?>"><?php echo $rs->city_name?></a></td>
        <td align="center">
            <?php echo icon_edit('city/edit_district/'.$rs->parentid.'/'.$rs->city_id)?>
            <span id="publish<?php echo $rs->city_id?>"><?php echo icon_active("'city'","'city_id'",$rs->city_id,$rs->published)?></span>
            <?php echo icon_del('city/del_district/'.$rs->parentid.'/'.$rs->city_id)?>
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