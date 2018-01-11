<?=form_open(uri_string(),array('id'=>'admindata'))?>
<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="box box-warning">
    <div class="box-body">
      <form role="form">
        <!-- text input -->
        <div class="form-group">
          <label>Tên liên hệ</label>
          <input type="text" class="form-control" name="contact_name" value="<?=$contact_name?>">
        </div>
        <div class="form-group">
          <label>Địa chỉ</label>
          <input type="text" class="form-control" id="address" name="contact_address" value="<?=$contact_address?>"> <input type="button" onclick="getlocal()" value="Lấy tọa độ bản đồ">
          <div>Ví dụ: phường 25, Bình Thạnh, TPHCM, Việt Nam</div>
        </div>
        <div class="form-group">
          <label>Tọa độ bản đồ</label>
          <p style="margin-bottom: 10px;"><span style="padding-right: 4px;">Lat</span>: <input type="text" name="lat" id="lat" value="<?=$lat?>"></p>
          <p><span>Lng</span>: <input type="text" name="lng" id="lng" value="<?=$lng?>"></p>
        </div>
        <div class="form-group">
          <label>Điện thoại</label>
          <input type="text" name="contact_phone" class="form-control" value="<?=$contact_phone?>">
        </div>
        <div class="form-group">
          <label>Hotline</label>
          <input type="text" name="contact_hotline" class="form-control" value="<?=$contact_hotline?>">
        </div>
        <div class="form-group">
          <label>Fax</label>
          <input type="text" name="contact_fax" class="form-control" value="<?=$contact_fax?>">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" name="contact_email" class="form-control" value="<?=$contact_email?>">
        </div>
        <div class="form-group">
          <label>Tùy chọn</label>
          <input type="checkbox" name="contact_send_mail" value="1" <?=($contact_send_mail == 1)?'checked="checked"':'';?>> Nhận thông tin liên hệ qua Email
        </div>
        <div class="form-group">
          <label>Logo</label>
          <div id="image" class="img_news" onclick="openKCFinder(this)">
            <?if($contact_img != ''){?>
            <img src="<?=base_url_site().$contact_img?>" alt="">    
            <?}else{?>
            <img src="<?=base_url()?>templates/images/no-img.png" alt="">
            <?}?>
          </div>
          <input type="hidden" name="contact_img" id="news_img" value="<?=$contact_img?>">
        </div>
      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>
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