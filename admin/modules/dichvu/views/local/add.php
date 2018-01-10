<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script type="text/javascript" src="<?php echo base_url().'templates/js/map_api.js'; ?>"></script>
<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="table_" style="width: 100%;">
    <tr>
        <td valign="top" style="padding-right: 10px;">
            <table class="form">
                <tr>
                    <td class="label" style="width: 150px;">Danh mục</td>
                    <td>
                        <select name="vdata[catid]" style="width: 300px;">
                            <?foreach($dscat as $val):
                            ?>
                            <option value="<?=$val->catid?>" <?=($c == $val->catid)?'selected="selected"':'';?>><?=$val->catname?></option>
                            <?endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width: 150px;">Tên địa danh</td>
                    <td><input type="text" name="vdata[title]" value="<?php echo set_value('vdata[title]')?>" style="width: 99%;"></td>
                </tr>
                <tr>
                    <td class="label">Tỉnh, Thành phố</td>
                    <td>
                        <select name="vdata[city_id]" id="city_id" style="width: 300px;">
                            <?foreach($listcity as $val):?>
                            <option value="<?=$val->city_id?>" <?=($c == $val->city_id)?'selected="selected"':'';?>><?=$val->city_name?></option>
                            <?endforeach;?>
                        </select>
                    </td>
                </tr>                
                <tr>
                    <td class="label">Quận, Huyện</td>
                    <td>
                        <select name="vdata[district_id]" id="district_id" style="width: 300px;">
                            <?foreach($listdistrict as $val):?>
                            <option value="<?=$val->city_id?>" <?=($rs->district_id == $val->city_id)?'selected="selected"':'';?>><?=$val->city_name?></option>
                            <?endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width: 150px;">Địa chỉ</td>
                    <td><input type="text" name="vdata[address]" id="address" value="<?php echo set_value('vdata[address]')?>" style="width: 99%;"></td>
                </tr>
<tr>
                    <td class="label">Tọa độ bản đồ</td>
                    <td>
                        Lat: <input type="text" name="vdata[lat]" id="lat" value="<?php echo set_value('vdata[lat]')?>" class="w100">
                        Lng: <input type="text" name="vdata[lng]" id="lng" value="<?php echo set_value('vdata[lng]')?>" class="w100">
                        <input type="button" onclick="get_local();" value="Lấy tạo độ">
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width: 150px;">Nổi bật</td>
                    <td>
                        <input type="checkbox" name="noibat" value="1">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>Giới thiệu ngắn</h2>
                        <textarea style="width: 99%;" name="vdata[introtext]" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>Chi tiết</h2>
                        <?=vnit_editor(set_value('content'),'content','_tongquan')?>
                    </td>
                </tr>
        </table>        
    </td>
    <td style="width: 300px;" valign="top">
        <fieldset class="content-right">
            <legend>Hình đại diện</legend>
                 <div class="img-news imgmain">
                    <img class="img" src="<?=base_url()?>templates/images/img_news_no.png" alt="">
                 </div>
                <div id="block_upload" style="margin-left: 50px;"><input id="file_upload" name="userfile" type="file" /></div>
        </fieldset>
        </td>
    </tr>
</table>

<script type="text/javascript">
function get_local(){
    var address = $("#address").val();
    if(address == ""){
        jAlert("Vui lòng nhập địa chỉ");
    }else{
        find_local(address);
    }
    /*$.post(base_url+"hotel/del_img_edit/"+img_id,function(data){
    });    */
}
$(".tab li").click(function(){
    tab_div = $(this).attr('id');
    $(".tab li").removeClass('select');
    $(this).addClass('select');
    $(".div_tab").hide();
    $("#div_"+tab_div).show();
})
$(document).ready(function() {
    $("#city_id").change(function(){
        var city_id = $(this).val();
        $.post(base_url+"hotel/get_district",{'city_id':city_id},function(data){
            $("#district_id").html(data.ds);
        },'json'); 
    })
})
</script>

<style>
div.error{
    color: #FF0000;
}
.imgmain{
    border: 1px solid #CCC;
    width: 150px;
    height: 140px;
    overflow: hidden;
    display: block;
    margin-bottom: 10px;
    background: #FFF;
}
.imgmain img{
    width: 150px; 
    min-height: 140px;
}
ul.listimg li{
    float: left;
    width:90px;
    height: 110px;
    margin-right: 5px;
    margin-bottom: 10px;
}
ul.listimg li .img{
    width: 90px;
    height: 80px;
    border: 1px solid #CCC;
    background: #FFF;
    display: block;
    overflow: hidden;
    cursor: pointer;
}
ul.listimg li .img img{
    width: 90px;
    min-height : 80px;
}
ul.listimg .l_del{
    margin-top: 5px;
    font-weight: bold;
    text-align: center;
}
</style>