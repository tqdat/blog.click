<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="catid" value="<?=$rs->vitri_id?>">
<table class="form">
    <tr>
        <td class="label">Quốc gia</td>
        <td>
            <select name="vdata[ct_id]" id="ct_id" city_id="<?=$rs->catid?>" style="width: 308px;">
                <?foreach($allcountry as $val):?>
                <option value="<?=$val->ct_id?>" <?=($rs->ct_id == $val->ct_id)?'selected="selected"':''?>><?=$val->ct_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Tỉnh, Thành phố</td>
        <td>
            <select name="vdata[catid]" id="city_id" style="width: 308px;">
                <?foreach($city as $val):?>
                <option value="<?=$val->city_id?>" <?=($val->city_id == $rs->catid)?'selected="selected"':''?>><?=$val->city_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Địa điểm</td>
        <td><input type="text" name="vdata[d_name]" value="<?php echo $rs->d_name?>" class="w300"></td>
    </tr>
</table>
<?php echo form_close();?>
<script type="text/javascript">
$("#ct_id").change(function(){
    ct_id = $(this).val();
    city_id = $(this).attr('city_id');
    $.post(base_url+"diadiem/ajax_city",{'ct_id':ct_id,'city_id':city_id},function(data){
        $("#city_id").html(data.ds);
    },'json');
})
</script>