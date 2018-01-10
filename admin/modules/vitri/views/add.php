<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="catid" value="0">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Thành phố</td>
        <td>
            <select id="catid" name="vdata[catid]" style="width: 308px;">
                <option value="0">Chọn thành phố</option>
                <?foreach($allcity as $val):?>
                <option value="<?=$val->catid?>"><?=$val->name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Địa điểm</td>
        <td>
            <select id="d_id" name="vdata[d_id]" style="width: 308px;">
                <option value="0">Chọn địa điểm</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="label">Tên vị trí</td>
        <td><input type="text" name="vdata[vitri_ten]" value="<?php echo set_value('vdata[vitri_ten]')?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Lat</td>
        <td><input type="text" name="vdata[vitri_lat]" value="<?php echo set_value('vdata[vitri_lat]')?>" class="w100"></td>
    </tr>
    <tr>
        <td class="label">Lng</td>
        <td><input type="text" name="vdata[vitri_lng]" value="<?php echo set_value('vdata[vitri_lng]')?>" class="w100"></td>
    </tr>    
</table>
<?php echo form_close();?>
<script type="text/javascript">
$(document).ready(function() {
    $("#admindata").validate({
        errorElement: "div",
        rules: {
            'vdata[catid]': {min:1},
            'vdata[d_id]': {min:1},
            'vdata[vitri_ten]': "required",
            'vdata[vitri_lat]': "required",
            'vdata[vitri_lng]': "required"
        },
        messages: {
            'vdata[catid]': {min : "Chọn Thành phố"},
            'vdata[d_id]': {min : "Chọn địa điểm"},
            'vdata[vitri_ten]': "Nhập vị trí",
            'vdata[vitri_lat]': "Nhập Lat",
            'vdata[vitri_lng]': "Nhập Lng"
        }
    });
    
    $("#catid").change(function(){
        var catid = $(this).val();
        $.post(base_url+"vitri/diadiem",{'catid':catid}, function(data) {
            $("#d_id").html(data.ds);
        },'json');        
    });
});
</script>