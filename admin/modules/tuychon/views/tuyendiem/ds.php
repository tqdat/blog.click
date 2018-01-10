<fieldset>
    <legend>Tìm kiếm</legend>
    <form action="<?=site_url('tuychon/tuyendiem/ds')?>" method="get">
        <table class="tuychon">
            <tr>
                <td><b>Tuyến điểm (vi)</b>: <input type="text" value="<?=$key?>" name="key"></td>
                <td>
                    <b>Loại hình</b>: <input type="radio" name="loaihinh" value="IN" <?=($loaihinh == 'IN')?'checked="checked"':''?>>Trong nước - 
                    <input type="radio" name="loaihinh" value="OUT" <?=($loaihinh == 'OUT')?'checked="checked"':''?>>Nước ngoài
                </td>
                <td>
                    <span id="trongnuoc" style="display: <?=($loaihinh == 'IN')?'block':'none'?>;">
                    <b>Tỉnh thành</b>: 
                    <select name="tinhthanh">
                        <option value="">Tất cả</option>
                        <?foreach($tinhthanh as $val):?>
                        <option value="<?=$val->st_id?>" <?=($val->st_id == $st)?'selected="selected"':''?>><?=$val->st_name?></option>
                        <?endforeach;?>
                    </select>
                    </span>
                    <span id="nuocngoai" style="display: <?=($loaihinh == 'OUT')?'block':'none'?>;">
                    <b>Quốc gia</b>: 
                    <select name="quocgia">
                        <option value="">Tất cả</option>
                        <?foreach($quocgia as $val):?>
                        <option value="<?=$val->ct_id?>" <?=($val->ct_id == $ct)?'selected="selected"':''?>><?=$val->ct_name?></option>
                        <?endforeach;?>
                    </select> 
                    </span>
                </td>
                <td><input type="submit" value="Tìm kiếm"></td>
                <td><a style="z-index: 1000;position: relative;" href="<?=site_url('tuychon/tuyendiem/ds')?>">Hủy</a></td>
            </tr>
        </table>
    </form>
</fieldset>
<script type="text/javascript">
$("input[name='loaihinh']").change(function(){
    var loaihinh = $(this).val();
    if(loaihinh == 'IN'){
       $("#trongnuoc").show();
       $("#nuocngoai").hide();
    }else{
       $("#trongnuoc").hide();
       $("#nuocngoai").show();
    }
})
</script>
<?php echo form_open('tuychon/tuyendiem/dels',  array('id' => 'admindata'));?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Tuyến điểm <span class="pages"><?=$pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tuyến điểm (vi)</th>
            <th>Tuyến điểm (en)</th>
            <th style="width: 100px;">Loại hình</th>
            <th style="width: 100px;">Tỉnh thành</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $en = $this->tuyendiem->get_tuyendiem_en($rs->td_id);
    if($rs->td_inbound == "IN"){
        $tinh = $this->tuyendiem->get_dc_state($rs->td_state_id)->st_name;
    }else{
        $tinh = $this->tuyendiem->get_dc_country($rs->td_state_id)->ct_name;
    }
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->td_id?>"></td>
        <td align="center"><?=$rs->td_id?></td>
        <td><?=$rs->name?></td>
        <td><?=$en->name?></td>
        <td>
            <?=($rs->td_inbound == 'IN')?'Trong nước':'Nước ngoài'?>
        </td>
        <td><?=$tinh?></td>
        <td align="center">
            
            <?php echo icon_edit('tuychon/tuyendiem/edit/'.$rs->td_id.'/'.$this->str)?>
            <?php echo icon_del('tuychon/tuyendiem/del/'.$rs->td_id.'/'.$this->str)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Tuyến điểm <span class="pages"><?=$pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>