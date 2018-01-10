<h2 class="heading"><?=$catinfo->cat_name?></h2>
<!--End Box title-->
<div class="hotel-list row">
		<?php foreach($list as $val):?>
			<!--Item Hotel-->
			<div class="hotel-box">
				<div style="height:110px;" class="hotel-img col-lg-3 col-md-3 col-sm-3 col-xs-12"><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>"><img alt="<?=$val->title?>" src="<?=base_url()?>data/hotel/300/<?=$val->images?>" width="100%"/></a></div>
				<div class="hotel-info col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<h3><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>" title="<?=$val->title?>"><?=$val->title?></a></h3>
					<div class="description"><?=$val->introtext?></div>
					<div class="price">Giá từ: <span><?=number_format($val->price)?> VNĐ</span></div>
					<div><span class="address">Địa chỉ:</span> <?=$val->address?></div>
					<div class="pull-right read-more"><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>">Chi tiết...</a></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<!--End Item Hotel-->
		<?php endforeach; ?>
		<div class="clearfix"></div>
</div>