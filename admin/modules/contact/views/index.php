<?=form_open(uri_string(),array('id'=>'admindata'))?>
<table class="form">
    <tr>
        <td class="label">Tên liên hệ</td>
        <td><input type="text" class="w500" name="contact_name" value="<?=$contact_name?>"></td>
    </tr>
    <tr>
        <td class="label">Địa chỉ</td>
        <td>
            <input type="text" class="w300" id="address" name="contact_address" value="<?=$contact_address?>"> <input type="button" onclick="getlocal()" value="Lấy tọa độ bản đồ">
            <div>Ví dụ: phường 25, Bình Thạnh, TPHCM, Việt Nam</div>
        </td>
    </tr>
    <tr>
        <td class="label">Tọa độ bản đồ</td>
        <td>
            <p style="margin-bottom: 10px;"><span style="padding-right: 4px;">Lat</span>: <input type="text" name="lat" id="lat" value="<?=$lat?>"></p>
            <p><span>Lng</span>: <input type="text" name="lng" id="lng" value="<?=$lng?>"></p>
        </td>
    </tr>
    <tr>
        <td class="label">Điện thoại</td>
        <td><input type="text" name="contact_phone" class="w300" value="<?=$contact_phone?>"></td>
    </tr>
    <tr>
        <td class="label">Hotline</td>
        <td><input type="text" name="contact_hotline" class="w300" value="<?=$contact_hotline?>"></td>
    </tr>
    <tr>
        <td class="label">Fax</td>
        <td><input type="text" name="contact_fax" class="w300" value="<?=$contact_fax?>"></td>
    </tr>
    <tr>
        <td class="label">Email</td>
        <td><input type="text" name="contact_email" class="w300" value="<?=$contact_email?>"></td>
    </tr>
    <tr>
        <td class="label">Tùy chọn</td>
        <td>
            <input type="checkbox" name="contact_send_mail" value="1" <?=($contact_send_mail == 1)?'checked="checked"':'';?>> Nhận thông tin liên hệ qua Email
        </td>
    </tr>
    
    <tr>
        <td class="label">Logo</td>
        <td>
            <div id="image" class="img_news" onclick="openKCFinder(this)">
            <?if($contact_img != ''){?>
            <img src="<?=base_url_site().$contact_img?>" alt="">    
            <?}else{?>
            <img src="<?=base_url()?>templates/images/no-img.png" alt="">
            <?}?>
            </div>
            <input type="hidden" name="contact_img" id="news_img" value="<?=$contact_img?>">
        </td>
    </tr>    
    
</table>

<?=form_close();?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script type="text/javascript">
function getlocal(){
    var address = $("#address").val();
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
     if (status == google.maps.GeocoderStatus.OK) {
        location1 = results[0].geometry.location;
        var mylat = location1.lat();
        var mylng = location1.lng();
        $("#lat").val(mylat);
        $("#lng").val(mylng);
        console.log("Geocoding failed: " + location1.lat()+" , "+location1.lng());
     }
     else {
        alert("Không lấy được vị trí bản đồ");
     }
    });
}
</script>