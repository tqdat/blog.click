<script src="<?=base_url()?>templates/js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>templates/js/book.js"></script>
<!--Box title-->
<h2 class="heading"><?=$title?></h2>
<!--End Box title-->
<?
$di = $this->tour->get_city_by_id($rs->khoihanh);
$ve = $this->tour->get_city_by_id($rs->ketthuc);
?>
<div class="main-box">
	<div class="tourInfo">
		<h2 class="title"><?=$rs->gioithieu?></h2>
		<div class="tour-img col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<img src="<?=base_url()?>data/tour/500/<?=$rs->images?>" width="100%">
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
			<div class="g-r">Mã Tour: <?=$rs->code?></div>
			<div class="g-r">Thời gian: <?=$rs->ngay?> ngày <?=($rs->dem > 0)?$rs->dem.' đêm':''?></div>
			<div class="g-r">Khởi hành từ: <?if($di){?> <?=$di->city_name?><?}?></div>
			<div class="g-r">Lịch trình: <?=$rs->lichtrinh?></div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
			<div class="g-r">Hình thức: <?=$rs->hinhthuc?></div>
			<div class="g-r">Phương tiện: <?=$rs->vanchuyen?></div>
			<div class="g-r">Giá: <span class="tour-price"><?=number_format($price,0,'.','.')?> VNĐ</span></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="tab-box">
		<ul id="listtab" class="listtab">
			<li>Thông tin đặt tour</li>
		</ul>
		<?if(isset($message) && $message !=''){ echo '<div class="show_notice" id="msg">'.$message.'<span class="del_smg"></span></div>';}?>
        <?if($this->session->get_flashdata('message')){
            echo '<div class="show_success" id="msg">'.$this->session->get_flashdata('message').'<span class="del_smg"></span></div>';
        }if($this->session->get_flashdata('error')){
            echo '<div class="show_error" id="msg">'.$this->session->get_flashdata('error').'<span class="del_smg"></span></div>';
        }if($this->session->get_flashdata('alert')){
            echo '<div class="show_notice" id="msg">'.$this->session->get_flashdata('alert').'<span class="del_smg"></span></div>';
        }
        ?>
		<div id="show-tabs">
			<?=form_open(uri_string(),array('id'=>'book_tour','class' =>'form-horizontal'))?>
			<div class="main_booking">
				<h3 class="customer">Thông tin liên hệ</h3>
				<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label">Họ tên</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="fullname" name="fullname">
					</div>
				</div>
				<div class="form-group">
				<label for="address" class="col-sm-2 control-label">Địa chỉ</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="address" name="address">
					</div>
				</div>
				<div class="form-group">
				<label for="phone" class="col-sm-2 control-label">Điện thoại</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="phone" name="phone">
					</div>
				</div>
				<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="email" name="email">
					</div>
				</div>
				<div class="form-group">
				<label for="diemdon" class="col-sm-2 control-label">Điểm đón</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="diemdon" name="diemdon">
					</div>
				</div>
				<div class="form-group">
				<label for="notes" class="col-sm-2 control-label">Ghi chú</label>
					<div class="col-sm-10">
					  <textarea class="form-control" rows="3" name="notes"></textarea>
					</div>
				</div>
				<h3 class="info_tour_b">Thông tin đặt Tour</h3>	
					<div class="form-cus form-group">
						<label for="day">Ngày khởi hành</label></br>
						<label class="select">Ngày</label>
							<select name="day" class="form-control">
								<?for($i = 1; $i <= 31; $i++){?>
								<option value="<?=$i?>" <?=($i == date('d',time()))?'selected="selected"':''?>><?=$i?></option>
								<?}?>
							</select>
						<label class="select">Tháng</label>
							<select name="month" class="form-control">
								<?for($i = 1; $i <= 12; $i++){?>
								<option value="<?=$i?>" <?=($i == date('m',time()))?'selected="selected"':''?>><?=$i?></option>
								<?}?>
							</select>
						<label class="select">Năm</label>
							<select name="year" class="form-control">
								<?for($i = date('Y',time()) + 1; $i >= date('Y',time()) - 1; $i--){?>
								<option value="<?=$i?>" <?=($i == date('Y',time()))?'selected="selected"':''?>><?=$i?></option>
								<?}?>
							</select>
					</div>
					<div class="form-cus form-group">
						<label for="day">Tổng số khách</label></br>
						<label class="select">Người lớn</label>
							<select name="adults" id="nl" class="form-control">
								<?for($i = $price_item->begin; $i <=50; $i++){?>
								<option value="<?=$i?>"><?=$i?></option>
								<?}?>
							</select>
						<label class="select">Trẻ em</label>
							<select name="children" id="trnho" class="form-control">
								<?for($i = 0; $i <=200; $i++){?>
								<option value="<?=$i?>"><?=$i?></option>
								<?}?>
							</select>
						<label class="select">Em bé</label>
							<select name="baby" id="baby" class="form-control">
								<?for($i = 0; $i <=200; $i++){?>
								<option value="<?=$i?>"><?=$i?></option>
								<?}?>
							</select>
						<div for="nl" generated="true" class="error" style="display: none;">Chọn số người lớn</div>
					</div>
					<?
					$price = $this->dnx->get_min_price_book($rs->id);
					?>
					<h3 class="info_pay">Tổng thanh toán: <span id="total_payment" class="price"><?=number_format($price * $price_item->begin,0,'.','.')?><span>VNĐ</h3>
					<h3 class="info_pay">Hình thức thanh toán</h3>
					<div class="form-cus form-group">
					   <label class="radio-inline" style="font-weight: bold;"><input id="ck" type="radio" name="payment" value="CK">Chuyển khoản</label>
                		<label class="radio-inline" style="font-weight: bold;"><input id="vp" type="radio" checked="checked" name="payment" value="VP">Tại văn phòng công ty</label>
                		<div id="vanphong">
                    		<?=$this->load->mod('vanphong')?>
                		</div>
                		<div id="chuyenkhoan">
                    		<?=$this->load->mod('chuyenkhoan')?>
                		</div>
					</div>
				<div class="btn_tour" style="text-align:center">
					<button type="submit" class="btn_dattour">Đặt tour</button>
				</div>
				<!--<input type="hidden" name="payment" id="payment_id" value="VP"> -->
				<input type="hidden" name="tour_id" id="tour_id" value="<?=$rs->id?>">
			</div>
			<?=form_close()?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
     
   //Thanh toán
    $("#ck").click(function(){
        $("#chuyenkhoan").show();
        $("#vanphong").hide();
    });
    $("#vp").click(function(){
        $("#vanphong").show();
        $("#chuyenkhoan").hide();
    }); 
});

</script>
<style>
#chuyenkhoan, #thanhtoan {display:none}
</style>