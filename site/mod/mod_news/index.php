<?php 
$max = get_params('max',$attr);
$count = get_params('count',$attr);
?>
<div class="news-featured">
	<div class="vticker">
		<ul>
			<?php 
				$sql = "SELECT * FROM news WHERE published = '1' ORDER BY hits DESC LIMIT $max";
							$news_noibat = $this->db->result($sql);
				foreach($news_noibat as $val):
			?>
			<li>
				<div class="grid">
					<div class="img"><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>"><img src="<?=base_url()?>data/news/200/<?=$val->images?>" alt="<?=$val->title?>" /></a></div>
					<div class="g-content">
						<div class="g-row">
							<a class="g-title" href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>" title="<?=$val->title?>"><?=$val->title?></a></br>
							<span style="color:#727272; font-size:12px;"><i class="fa fa-clock-o"></i> <?=date('d/m/Y H:i:s',$val->created)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> <?=$val->hits?> lượt xem</span>
						</div>
					</div>
				<div class="clearfix"></div>
				</div><!--grid-->
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<style>
/* ------------------------------------------
  NEWS FEATURED STYLES
--------------------------------------------- */
.news-featured{
	position:relative;
	overflow:hidden;
}
.news-featured ul li:hover {background:none;}
.news-featured .grid{
	min-height:5px;;
}
.news-featured .grid .img{
	width:30%;
	float:left;
	padding:5px;
	overflow:hidden;
}
.news-featured .g-content {
	float:left;
	width:70%;
}
.news-featured .grid .img img{
	width:100%;
	height:60px;
}
.news-featured .grid .g-title{
	color:#339cfc;
	font-weight:bold;
}
.news-featured  .g-title:hover{
	color:#f06e00;
}
</style>
<script>
$('.vticker').easyTicker({
		direction: 'up',
		easing: 'swing',
		speed: 'slow',
		interval: 2000,
		height: 'auto',
		visible: <?=$count?>,
		mousePause: 1,
		controls: {
			up: '',
			down: '',
			toggle: '',
			playText: 'Play',
			stopText: 'Stop'
		}
	});
</script>