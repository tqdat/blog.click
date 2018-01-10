<div class="slider" style="position:relative;">
	<div id="slider_main" style="position: relative; margin: 0 auto;
	top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
	<!-- Loading Screen -->
	<div u="loading" style="position: absolute; top: 0px; left: 0px;">
		<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
			top: 0px; left: 0px; width: 100%; height: 100%;">
		</div>
		<div style="position: absolute; display: block; background: url(<?=base_url()?>templates/img/loading.gif) no-repeat center center;
			top: 0px; left: 0px; width: 100%; height: 100%;">
		</div>
	</div>
	<!-- Slides Container -->
	<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px;
		height: 500px; overflow: hidden;">
		<?php
		$list = $this->db->result("SELECT * FROM slideshow");
		$i = 1;
		foreach($list as $val):
		?>
		<div>
			<a href="<?=$val->links?>" title="<?=$val->ten?>" alt="<?=$val->ten?>"><img u="image" src="<?=base_url().'data/sl/'.$val->images;?>" /></a>
		</div>
		<?php
		$i++;
		endforeach;?>
	</div>
	<style>
		/* jssor slider bullet navigator skin 21 css */
		/*
		.jssorb21 div           (normal)
		.jssorb21 div:hover     (normal mouseover)
		.jssorb21 .av           (active)
		.jssorb21 .av:hover     (active mouseover)
		.jssorb21 .dn           (mousedown)
		*/
		.jssorb21 {
			position: absolute;
		}
		.jssorb21 div, .jssorb21 div:hover, .jssorb21 .av {
			position: absolute;
			/* size of bullet elment */
			width: 19px;
			height: 19px;
			text-align: center;
			line-height: 19px;
			color: white;
			font-size: 12px;
			background: url(<?=base_url()?>templates/img/b21.png) no-repeat;
			overflow: hidden;
			cursor: pointer;
		}
		.jssorb21 div { background-position: -5px -5px; }
		.jssorb21 div:hover, .jssorb21 .av:hover { background-position: -35px -5px; }
		.jssorb21 .av { background-position: -65px -5px; }
		.jssorb21 .dn, .jssorb21 .dn:hover { background-position: -95px -5px; }
	</style>
	<!-- bullet navigator container -->
	<div u="navigator" class="jssorb21" style="bottom: 26px; right: 6px;">
		<!-- bullet navigator item prototype -->
		<div u="prototype"></div>
	</div>
	<!--#endregion Bullet Navigator Skin End -->

	<!--#region Arrow Navigator Skin Begin -->
	<!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
	<style>
		/* jssor slider arrow navigator skin 21 css */
		/*
		.jssora21l                  (normal)
		.jssora21r                  (normal)
		.jssora21l:hover            (normal mouseover)
		.jssora21r:hover            (normal mouseover)
		.jssora21l.jssora21ldn      (mousedown)
		.jssora21r.jssora21rdn      (mousedown)
		*/
		.jssora21l, .jssora21r {
			display: block;
			position: absolute;
			/* size of arrow element */
			width: 55px;
			height: 55px;
			cursor: pointer;
			background: url(<?=base_url()?>templates/img/a21.png) center center no-repeat;
			overflow: hidden;
		}
		.jssora21l { background-position: -3px -33px; }
		.jssora21r { background-position: -63px -33px; }
		.jssora21l:hover { background-position: -123px -33px; }
		.jssora21r:hover { background-position: -183px -33px; }
		.jssora21l.jssora21ldn { background-position: -243px -33px; }
		.jssora21r.jssora21rdn { background-position: -303px -33px; }
	</style>
	<!-- Arrow Left -->
	<span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
	</span>
	<!-- Arrow Right -->
	<span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
	</span>
	</div>
	<!--Search-->
	<?=$this->_templates('html/search')?>
	<!--End Search-->
	</div>