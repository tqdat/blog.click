<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tuyến điểm (vi)</td>
        <td>
            <input type="text" name="vi_name" value="<?php echo $rs->name?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Tuyến điểm (en)</td>
        <td>
            <input type="text" name="en_name" value="<?php echo $en->name?>" class="w300">
        </td>
    </tr> 
    <tr>
        <td class="label" style="width: 150px;">Tuyến</td>
        <td>
            <input type="radio" name="td_inbound" value="IN" <?=($rs->td_inbound == 'IN')?'checked="checked"':''?>> Trong nước - 
            <input type="radio" name="td_inbound" value="OUT" <?=($rs->td_inbound == 'OUT')?'checked="checked"':''?>> Nước ngoài
        </td>
    </tr>
    <tr id="trongnuoc" style="display: <?=($rs->td_inbound == 'IN')?'table-row':'none'?>;">
        <td class="label">Tỉnh thành</td>
        <td>
            <select name="tinhthanh">

                <?foreach($tinhthanh as $val):?>
                <option value="<?=$val->st_id?>" <?=($val->st_id == $rs->td_state_id)?'selected="selected"':''?>><?=$val->st_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr id="nuocngoai" style="display: <?=($rs->td_inbound == 'OUT')?'table-row':'none'?>;">
        <td class="label">Quốc gia</td>
        <td>
            <select name="quocgia">
     
                <?foreach($quocgia as $val):?>
                <option value="<?=$val->ct_id?>" <?=($val->ct_id == $rs->td_state_id)?'selected="selected"':''?>><?=$val->ct_name?></option>
                <?endforeach;?>
            </select> 
        </td>
    </tr>
</table>
<?php echo form_close();?>
<script type="text/javascript">
$("input[name='td_inbound']").change(function(){
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