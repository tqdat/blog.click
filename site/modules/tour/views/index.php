<h1 style="display:none"><?=$title?></h1>
<!--Box title-->
<?php
foreach($listcat as $valcat):
 $str_ar_cat = $this->tour->get_str_ar_cat($valcat->cat_id);
 $listtour = $this->tour->get_all_catindex(6,0,$str_ar_cat);

//var_dump($listtour);
?>

<h2 class="heading"><a style="color: #f06e00;" href="<?=site_url($valcat->slug)?>"><?=$valcat->name?></a></h2>
<h3 class="des" style="padding: 5px; font-size: 15px;"><?=$valcat->des?></h3>
<!--End Box title-->

<div class="tour-list row" id="tour">
	<?
	$i = 1;
	foreach($listtour as $val):
	$price = $this->dnx->get_min_price($val->id);
	$khoihanh = $this->tour->get_city_by_id($val->khoihanh);
	?>
	<!--Item List-->
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="tour-box">
			<?php if($val->giamgia > 0):?>
			<div class="tour-sale"><span>Giảm <?=$val->giamgia?>%</span></div>
			<?php endif; ?>
			<div class="tour-img">
				<a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><img src="<?=base_url()?>data/tour/500/<?=$val->images?>" alt="<?=$val->title?>"></a>
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
					</div><!-- .row -->
				</div>
			</div>
			<div class="tour-info">
				<h4><a id="tour_50" title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><?=$val->title?></a></h4>
				<div style="padding:0 5px;"><span class="pull-left"><b>Phương tiện:</b></span><span class="pull-right"><?=$val->vanchuyen?></span>
					<div class="clearfix"></div></div>
				<div style="padding:0 5px;"><span class="pull-left"><b>Thời gian:</b></span><span class="pull-right"><?=$val->ngay?> Ngày <?=($val->dem > 0)?' - '.$val->dem.' '.'đêm':''?></span>
					<div class="clearfix"></div></div>
				<div style="padding:0 5px;"><span class="pull-left"><b>Ngày khởi hành: </b></span><span class="pull-right"><?php echo ($val->ngaykhoihanh) ? $val->ngaykhoihanh : "Hằng ngày"?></span>
					<div class="clearfix"></div></div>		
					<div style="padding:0 5px;"><span class="pull-left"><b>Khởi hành tại:</b></span><span class="pull-right"><?=$khoihanh->city_name?></span>
					<div class="clearfix"></div></div>
				<div class="price">
					<div class="pull-left">Giá: <?php echo ($price) ? number_format($price,0,'.','.')." VNĐ" : "Liên hệ"?> </div>
					<div class="pull-right"><a class="read-more" href="<?=site_url($val->id.'-'.$val->slug)?>">Chi tiết</a></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--End Item List-->
	<?php endforeach; ?>
	<div class="clearfix"></div>
	
</div><!--End row-->
<div class="clearfix"></div>
<?php endforeach; ?>
 

<script type="text/javascript">
$(document).ready(function() {
    
    
    $("#xemthem").validate({
        rules: {
            
        },
        messages: {
           
        }
        ,submitHandler: function() {
            dataString = $("#xemthem").serialize();
            $.ajax({
               type: "POST",
                url: base_url+'api/loadtour',
                data: dataString,
                dataType: "json",
                success: function(data) {
                    $(".btn_send").prop('value','Xem thêm '+ (data.total - data.offset)+' tour');
                    $('div#tour').append(data.html);
                    $("#offset").val(data.offset);
                    if (data.offset >= data.total){
                       $("#xemthem").hide(); 
                    }
                }
            }); 
        }        
    });
    
});

</script>