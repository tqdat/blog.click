<div style="margin-bottom: 10px; float: right;">
    Chọn Quốc gia:
    <select name="vdata[catid]" onchange="window.open(this.value,'_self');" style="width: 150px;">
        <?foreach($allcountry as $val):?>
        <option value="<?=base_url().'diadiem/ds/?c='.$val->ct_id?>" <?=($c == $val->ct_id)?'selected="selected"':''?>><?=$val->ct_name?></option>
        <?endforeach;?>
    </select>
    Chọn thành phố: 
    <select name="vdata[catid]" onchange="window.open(this.value,'_self');" style="width: 150px;">
        <option value="<?=base_url().'diadiem/ds/?c='.$c.'&s=0'?>">Tất cả</option>
        <?foreach($city as $val):?>
        <option value="<?=base_url().'diadiem/ds/?c='.$c.'&s='.$val->city_id?>" <?=($s == $val->city_id)?'selected="selected"':''?>><?=$val->city_name?></option>
        <?endforeach;?>
    </select>
</div>
<?php echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="10">
                Hiện có <?php echo $num?> Địa điểm <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Vị trí</th>
            <th style="width: 200px;">Tỉnh, Thành phố</th>
            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    $city = $this->diadiem->get_item_city($rs->catid);
    ?>
    <tr class="row<?php echo $k?>">
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->d_id?>"></td>
        <td><?php echo $rs->d_id?></td>
        <td><a href="<? echo site_url('diadiem/edit/'.$rs->d_id)?>/<?=$this->str?>"><?php echo $rs->d_name?></a></td>
        <td><?=$city->city_name?></td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->d_id?>" value="<?php echo $rs->d_order?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->d_id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('diadiem/edit/'.$rs->d_id.'/'.$this->str)?>
            <!--<span id="publish<?php echo $rs->d_id?>"><?php echo icon_active("'vitri'","'d_id'",$rs->d_id,$rs->published)?></span>-->
            <?php echo icon_del('diadiem/del/'.$rs->d_id.'/'.$this->str)?>
        </td>
    </tr> 
    <?
    $k = 1 - $k;
    endforeach;?>
    <tfoot>
        <td colspan="10">
            Hiện có <?php echo $num?> Địa điểm  <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot> 
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"diadiem/save_order",fields, function(data) {
        location.reload();
    });
}
</script>
