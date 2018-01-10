<?
$menutour = $this->dnx->get_tour_menu();
foreach($menutour as $val):
$subcat = $this->dnx->get_tour_cat($val->cat_id);
?>
<!--Box Item-->
<div class="box-item">
	<div class="box-title box-title-small">
		<div class="lb-name"><i class="fa fa-fire"></i><a href="<?= site_url($val->slug) ?>"><?=$val->name ?></a></div>
	</div><!--box-title-->
	<div class="box-content">
		<div class="nav-item-list">
			<?php if (count($subcat)) { ?>
			<ul class="item-list">
				<?foreach($subcat as $val):?>
				<li><a href="<?=site_url($val->slug)?>"><?=$val->name?></a></li>
				<?endforeach;?>
			</ul>
			<?}?>
		</div>
	</div><!--box-content-->
</div><!--End Box Item-->
<!--Box Item-->
<?endforeach;?>