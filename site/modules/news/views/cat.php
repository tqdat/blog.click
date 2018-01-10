<h1 style="display:none"><?=$catinfo->cat_name?></h1>
<!--Box title-->
<h2 class="heading"><?=$catinfo->cat_name?></h2>
<h3 style="font-size: 110% !important; padding: 10px 0;"><?=htmlspecialchars_decode($des)?></h3>
<!--End Box title-->
<?php if(!empty($list)):?>
<div class="news-list row">
		<?foreach($list as $rs):?>
			<!--Item Hotel-->
			<div class="news-box">
				<div class="news-img col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><img src="<?=base_url()?>data/news/default/<?=$rs->images?>" width="100%"/></a></div>
				<div class="news-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3><a title="<?=$rs->title?>" href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><?=$rs->title?></a></h3>
					<div class="description"><?=vnit_cut_string($rs->introtext,300)?></div>
					<div class="pull-right read-more"><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>">Chi tiết...</a></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<!--End Item Hotel-->
		<?php endforeach; ?>
		<div class="clearfix"></div>
		<div class="pages"><?=$pagination?></div>
</div>
<?php else: ?>
Không có tin tức nào thuộc mục này
<?php endif ?>