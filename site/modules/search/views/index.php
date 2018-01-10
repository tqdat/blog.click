<h2 class="heading">KẾT QUẢ TÌM KIẾM</h2>
<?php if(!empty($search)): ?>
<div class="tour-list row">
	<?php foreach($search as $val): 
		$price = $this->dnx->get_min_price($val->id);
		$khoihanh = "Da nang";
	?>
	<!--Item List-->
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
						<div class="col-xs-6 text-right"><a href="#book_tour" class="book_btn">Đặt tour</a></div>
					</div><!-- .row -->
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
</div><!--End row-->
<?php else: ?>
<div class="emptySearch" style="text-align:center;font-size:18px;">Không có kết quả tìm kiếm</div>
<?php endif;?>