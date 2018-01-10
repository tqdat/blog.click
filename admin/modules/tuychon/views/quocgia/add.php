<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tỉnh, Thành phố</td>
        <td>
            <input type="text" name="vdata[city_name]" value="<?php echo set_value('vdata[city_name]')?>" class="w300">
            <input type="button" value="Lấy tọa độ" onclick="get_local()">
        </td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td><input type="file" name="userfile"></td>
    </tr>
    <tr>
        <td class="label">Ảnh bản đồ</td>
        <td>
            <?if($rs->icon != ''){?>
               <img src="<?=base_url_site()?>data/map/<?=$rs->map_img?>" height="100" alt=""><br />
            <?}?>
            <input type="file" name="userfile_map">
        </td>
    </tr>
    <tr>
        <td class="label">Tọa độ bản đồ</td>
        <td>
                Lat: <input type="text" name="vdata[lat_map]" id="lat" value="<?php echo $rs->lat_map?>" class="w200">
                Lng: <input type="text" name="vdata[lng_map]" id="lng" value="<?php echo $rs->lng_map?>" class="w200">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo set_value('vdata[ordering]')?>" class="w300"></td>
    </tr>    
</table>
<?php echo form_close();?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script type="text/javascript" src="<?php echo base_url().'templates/js/map_api.js'; ?>"></script>
<script type="text/javascript">
function get_local(){
    var address = $("#address").val()+', Việt Nam';
    if(address == ""){
        jAlert("Vui lòng nhập tên Tỉnh, Thành phố");
    }else{
        find_local(address);
    }
    /*$.post(base_url+"hotel/del_img_edit/"+img_id,function(data){
    });    */
}
</script>