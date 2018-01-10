<?php
    $msstar[1] = "Dịch vụ Kém";
    $msstar[2] = "Dịch vụ Không tốt";
    $msstar[3] = "Dịch vụ Bình thường";
    $msstar[4] = "Dịch vụ Tốt";
    $msstar[5] = "Dịch vụ Rất tốt";
?>
<div itemscope itemtype="http://schema.org/Product">
<h1 itemprop="name" class="heading"><?=$title?></h1>
<!--End Box title-->
<div class="main-box">
	<div class="tourInfo">
		<h2 itemprop="description" class="title"><?=$rs->gioithieu?></h2>
		<div class="tour-img col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<a href="<?=base_url()?>data/tour/500/<?=$rs->images?>" class="fancybox" title="<?=$title?>" rel="group"><img src="<?=base_url()?>data/tour/500/<?=$rs->images?>" alt="<?=$title?>" width="100%" /></a>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
			<div class="g-r">Mã Tour: <?=$rs->code?></div>
			<div class="g-r">Thời gian: <?=$rs->ngay?> ngày <?=($rs->dem > 0)?$rs->dem.' đêm':''?></div>
			<div class="g-r">Khởi hành từ: <?if($khoihanh){?> <?=$khoihanh->city_name?><?}?></div>
			<div class="g-r">Lịch trình: <?=$rs->lichtrinh?></div>
			<p><script src="https://apis.google.com/js/platform.js" async defer>
			  {lang: 'vi'}
			</script>
			<span class="google" style="width:80px; float: left;">
				<div class="g-plusone" data-size="medium"></div>
			</span>
			<div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>        
                    <div style="float: left; margin-top: -5px;" class="fb-like" data-href="<?=base_url().uri_string()?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true"></div>   
        </p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
			<div class="g-r">Hình thức: <?=$rs->hinhthuc?></div>
			<div class="g-r">Phương tiện: <?=$rs->vanchuyen?></div>
			<div class="g-r">Ngày khởi hành: <?php echo ($rs->ngaykhoihanh) ? $rs->ngaykhoihanh : "Hằng ngày";?></div>
			<?php 
			 if ($rs->giamgia) {
			?>
			<div class="g-r">Giá cũ: <span class="tour-price-cu"><?=number_format((round(( $price/ (100-$rs->giamgia)*100)/1000,0)*1000),0,'.','.')?> VNĐ</span></div>
			<div class="g-r">Giá KM: <span class="tour-price"><?=number_format($price,0,'.','.')?> VNĐ</span> ( Giảm <?php echo $rs->giamgia; ?>%)</div>
			<?php } else { ?>
			<div class="g-r" itemprop="offers" itemscope itemtype="http://schema.org/Offer">Giá tour: <span class="tour-price" itemprop='price' content='<?=$price?>'><?=number_format($price,0,'.','.')?> </span><span itemprop="priceCurrency" content="VND">VND</span></div>
			<?php } ?>
			<div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
           <strong><span itemprop="ratingValue"><?=number_format($rating,1,',','.')?></span></strong>
            <?php for($i = 0; $i < $rating; $i++) { ?>
            <i class="glyphicon glyphicon-star star"> </i> 
            <?php } ?>
            / <span itemprop="reviewCount" content="<?=($lcomtotal)?>"><?=$lcomtotal?></span> đánh giá.
        </div>
			<div class="g-row"><a class="btn_dattour" href="<?=site_url('dat-tour/'.$rs->slug.'-'.$rs->id)?>">Đặt tour</a></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div style="padding-bottom: 5px;">
      <h3 style="font-size: 17px; color: #CC0000; margin-top: 15px;text-transform: uppercase;margin-bottom: 10px;">Bảng giá Tour</h3>
      <table class="tbl_price" cellpadding="0" cellspacing="0">
         <tr>
            <td style="width: 25%; background: #EDEDED; border: 1px solid #DADADA; font-weight: bold;"> Số lượng </td> <td style="width: 25%; background: #EDEDED; border: 1px solid #DADADA; font-weight: bold;"> Người lớn </td> <td style="width: 25%; background: #EDEDED; border: 1px solid #DADADA; font-weight: bold;"> Trẻ em </td> <td style="width: 25%; background: #EDEDED; border: 1px solid #DADADA; font-weight: bold;"> Em bé </td>
        </tr>
            <?php foreach($ds_price as $gia): ?>
            <tr>
                <td style="width: 25%; background: #EDEDED; border: 1px solid #DADADA; font-weight: bold;">>= <?=$gia->begin?> khách</td>
                <td style="border: 1px solid #DADADA;"><?=number_format($gia->price,0,'.','.')?> VNĐ</td>
                <td style="border: 1px solid #DADADA;"><?php echo ($gia->price2) ? number_format(($gia->price2),0,'.','.').' VNĐ' : 'Liên hệ'; ?></td>
                <td style="border: 1px solid #DADADA;">Miễn phí</td>
            </tr>
            <?php endforeach;?>
     </table>
    
   </div>
</div>
	<div class="tab-box">
		<ul id="listtab" class="listtab">
			<li class="active" href="javascript:;" data_id="chuong_trinh">Chương trình Tour</li>
			<li href="javascript:;" data_id="phu_luc">Phụ lục</li>
		</ul>
		<div id="show-tabs">
			<div class="tabcon" id="chuong_trinh" style="display:block"><?=htmlspecialchars_decode($rs->chuongtrinh)?></div>
			<div class="tabcon" id="phu_luc"><?=htmlspecialchars_decode($rs->phuluc)?></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="tourInfo btn" style="width: 100%;"><a class="btn_dattour" href="<?=site_url('dat-tour/'.$rs->slug.'-'.$rs->id)?>">Đặt tour</a></div>

<!--Box title-->
<h2 class="heading" style="background: #f06e00; text-align: center; color: #fff;">HỎI ĐÁP VÀ CẢM NHẬN CỦA QUÝ KHÁCH HÀNG VỀ DỊCH VỤ TOUR</h2>
<!--End Box title-->
<div class="midTab">

		 <div class="form_comment_div">
			<?=form_open('',array('id'=>'form_comment'))?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment">
					<label>Họ tên</label>
					<input type="text" name="vdata[fullname]">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment">
					<label>Email</label>
					<input type="text" name="vdata[email]">
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment">
					<label>Điện thoại</label>
					<input type="text" name="vdata[phone]">
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-comment">
					<label>Nội dung</label>
					<textarea rows=“3” name="vdata[content]"></textarea>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment">
					<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:0; line-height:32px;">Đánh giá</label>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:0; margin-right:5px;">
					<select id="star" name="vdata[star]" style="height:26px;">
						<option value="5">5 Sao</option>
						<option value="4">4 Sao</option>
						<option value="3">3 Sao</option>
						<option value="2">2 Sao</option>
						<option value="1">1 Sao</option>
					</select>
					</div>
					<span id="txt_star" style="line-height:26px;">Dịch vụ rất tốt</span>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment">
					<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:0; line-height:26px;">Mã bảo vệ</label>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<input type="text" name="captcha" class="code" style="text-transform: uppercase;float: left;margin-right: 10px;width: 50px;" value="">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div style="float: left; width:60px;" id="re_cap"><img id="img_captcha" src="<?=site_url('api/captcha/'.md5($this->session->data['mabaove']))?>" alt="" height="24px"></div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<label for="captcha" generated="true" class="error" style="display: none;">Nhập mã bảo vệ</label>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-comment"><input type="submit" class="button" style="margin: 0px;padding: 5px 20px; margin-top: 4px; border: none !important;" value="Gửi"></div>
				<div style="text-align:center"><input type="hidden" name="vdata[tour_id]" value="<?=$rs->id?>">
						<div id="msg"></div></div>
			<?=form_close()?>
			<div class="clearfix"></div>
			<h4 style="border-bottom: 1px solid #720101; margin-top: 10px; color: #720101;">Hiện có <span id="total_c"><?=count($lcom)?></span> đánh giá</h4>
			<div class="lcom" style="overflow: hidden;">
				<?foreach($lcom as $val):?>
				<div style="clear: both; overflow: hidden; border-bottom: 1px dashed #EDEDED; padding-top: 5px;">
					<img src="<?=base_url()?>templates/images/user.png" alt="" style="float: left; margin: 5px; border-radius: 7px;">
					<div id="content_comment">
						<div style="overflow: hidden;">   
							<div class="ten"><b class="fullname"><?=$val->fullname?></b> - <span class="data">Ngày gửi: <?=date('d/m/Y H:i',$val->time)?></span></div>
							<div class="danhgia"><?php echo $msstar[$val->star];?>
							<span class="small-star" style="width: 80px; float: right; height: 16px;"><span class="current-rating" style="width: <?=(16*$val->star)?>px;height: 24px; float: right;"></span></span></div>
						</div>
						<div><?=$val->content?></div>
					</div>
				</div>
				<?endforeach;?>
			</div>     
		</div>
		<div class="clearfix"></div>
	</div>  
<h2 class="heading">TOUR LIÊN QUAN</h2>
    <div class="tour-list row" style="background:transparent">
        <?php foreach($tour_lienquan as $val): 
                $price = $this->dnx->get_min_price($val->id);
                $khoihanh = $this->tour->get_city_by_id($val->khoihanh);
        ?>

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="tour-box">
                        <?php if($val->giamgia > 0):?>
                        <div class="tour-sale"><span>Giảm <?=$val->giamgia?>%</span></div>
                        <?php endif; ?>
                        <div class="tour-img">
                                <a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><img src="<?=base_url()?>data/tour/500/<?=$val->images?>" alt=""></a>
                                <div>
                                        <h5><a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><?=$val->title?></a></h5>
                                        <div><span class="pull-left">Thời gian</span><span class="pull-right"><?=$val->ngay?> Ngày <?=($val->dem > 0)?' - '.$val->dem.' '.'đêm':''?></span>
                                        <div class="clearfix"></div></div>
                                        <div><span class="pull-left">Phương tiện:</span><span class="pull-right"><?=$val->vanchuyen?></span>
                                        <div class="clearfix"></div></div>
                                        <div><span class="pull-left">Khởi hành tại:</span><span class="pull-right"><?=$khoihanh->city_name?></span>
                                        <div class="clearfix"></div></div>
                                        <div><span class="pull-left">Giá:</span><span class="pull-right text-red"><?=number_format($price,0,'.','.')?> VNĐ</span>
                                        <div class="clearfix"></div></div>
                                        <div class="row">
                                                <div class="col-xs-6 text-left"><a class="book_btn" href="<?=site_url($val->id.'-'.$val->slug)?>">Chi tiết</a></div>
                                                <div class="col-xs-6 text-right"><a href="<?=site_url('dat-tour/'.$val->slug.'-'.$val->id)?>" class="book_btn">Đặt tour</a></div>
                                        </div>
                                </div>
                        </div>
                        <div class="tour-info">
                                <h4><a id="tour_50" title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><?=$val->title?></a></h4>
                                <div class="price">
                                        <div class="pull-left">Giá: <?=number_format($price,0,'.','.')?> VNĐ</div>
                                        <div class="pull-right"><a class="read-more" href="<?=site_url($val->id.'-'.$val->slug)?>">Chi tiết</a></div>
                                        <div class="clearfix"></div>
                                </div>
                        </div>
                </div> 

        </div>
        <!--End Item List-->
        <?php endforeach; ?>
        <?php // var_dump($tour_lienquan);?>
    
   
</div><!--End row-->

<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.validate.min.js" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function() {
	function clear_form_elements(ele) {
		$(ele).find(':input').each(function() {
			switch(this.type) {
				case 'password':
				case 'select-multiple':
				case 'select-one':
				case 'text':
				case 'textarea':
					$(this).val('');
					break;
				case 'checkbox':
				case 'radio':
					this.checked = false;
			}
		});
	}
	$("#star").change(function(){
        value = $(this).val();
        if(value == 5){
            label = "Dịch vụ rất tốt";
        }else if(value == 4){
            label = "Dịch vụ tốt";
        }else if(value == 3){
            label ="Dịch vụ bình thường";
        }else if(value == 2){
            label = "Dịch vụ không tốt";
        }else{
            label = "Dịch vụ rất kém";
        }
        $("#txt_star").html(label);
    })
    $("#form_comment").validate({
        rules: {
            "vdata[fullname]": "required",
            "vdata[content]": "required",
            "captcha": "required"
        },
        messages: {
            "vdata[fullname]": "Vui lòng nhập Họ và tên",
            "vdata[content]": "Nhập nội dung đánh giá",
            "captcha": "Nhập mã bảo vệ"
        }
        ,submitHandler: function(form) {
            dataString = $("#form_comment").serialize();
            $.ajax({
                type: "POST",
                url: base_url+'api/addcomment',
                data: dataString,
                dataType: "json",
                success: function(data) {
                    if(data.error == 0){
                        clear_form_elements("#form_comment");
                    } 
                    $("#img_captcha").attr('src',data.img);
                    alert(data.msg);
                }
            }); 
        }        
    });    
});

</script>
<style>
    input, select, textarea, text  {
        border: 1px solid #720101 !important;
		width:100%;
    }
    #form_comment .button:hover {
        background: #720101;
    } 
    #form_comment .button {
        background: #720101;
		color:white;
		width:200px;
    }
	.form-comment {
		margin:5px 0 5px 0;
	}
    .ten {
        float: left;
        width: 305px;
        font-size: 100%;
        font-style: italic;
    }
    .danhgia {
        float: right;
        width: 180px;
        font-size: 90%;
        margin-right: 12px;
        font-style: italic;
    }
    #___plusone_0 {float: left !important;}
    .glyphicon {color: yellowgreen;}
</style> 