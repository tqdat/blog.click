<script src="<?=base_url()?>templates/js/jquery.carouFredSel.js"></script>
<?php
$sql = "SELECT * FROM news WHERE published = '1' AND noibat = '1' ORDER BY id DESC LIMIT 15";
				$cungcau = $this->db->result($sql);
?>
<div class="cungcau_ctn">
    
<div id="slideshow">
	<div class="screen">   
		<?php
		foreach($cungcau as $val):
		   $i++;      
		?>
		<div class="slide" id="slide_<?=$i?>"> 
			<a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id) ?>">
			  <div class="large_image"><img src="<?=base_url()?>data/news/default/<?= $val->images?>" /></div>
			</a>
			<div class="info">
			  <h2><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id) ?>"><?=$val->title?></a></h2>
			</div>
		</div>
			 <?php endforeach;?>                
	</div>
	<ul class="thumbnails">
		<?php
		foreach($cungcau as $val):
			$x++;      
		?>
			<li class="slide_<?=$x?>">
				<div class="thumb"><img src="<?=base_url()?>data/news/200/<?= $val->images?>" alt="<?=$val->title?>" /></div>
				<p><?=$val->title?></p>
			</li>
		<?php endforeach;?>       


   </ul>
</div>
<div class="clearfix"></div>

</div>
<script>
$(function() {
  $('#slideshow').hover(
    function() {
      $('#slideshow .screen').trigger( 'pause' );
    }, function() {
      $('#slideshow .screen').trigger( 'play' );
    }
  );

  $('#slideshow .thumbnails').carouFredSel({
    direction: 'down',
    auto: false,
    items: {
      visible: 5,
      start: 1
    },
    scroll: {
      onBefore: function( data ) {
        data.items.old.eq(0).removeClass('selected');
        data.items.visible.eq(0).addClass('selected');
      }
    }
  });

  $('#slideshow .screen').carouFredSel({
    auto: true,
    items: 1,
    prev : "#slideshow .prev",
    next : "#slideshow .next",
    scroll: {
      onBefore: function( data ) {
        $('#slideshow .thumbnails').trigger( 'slideTo', [ $('#slideshow .thumbnails li[class='+ data.items.visible.attr( 'id' ) +']'), 0 ] );
      }
    }
  });

  $('#slideshow .thumbnails li').click(function() {
    $('#slideshow .screen').trigger( 'slideTo', [ $('#slideshow .screen .slide[id='+ $(this).attr( 'class' ) +']') ] );
  });
  $('#slideshow .thumbnails li:eq(0)').addClass('selected');
});
</script>



<style>
    .caroufredsel_wrapper {width:50% !important}
    .caroufredsel_wrapper:last-child {left:auto !important}
#slideshow{position:relative;background:white;overflow:hidden; max-width:1100px;margin: auto;}
#slideshow .caroufredsel_wrapper{background:#eee;}
#slideshow .screen{height:300px;overflow:hidden}
#slideshow .slide{position:relative;float:left;overflow:hidden;background:#333;color:#FFF}
#slideshow .slide .large_image{height: 325px;overflow: hidden; width: 550px !important;}
#slideshow .slide .large_image img{width:100%;min-height:100%}
#slideshow .slide .info{background: #339cfc; height: 50px;opacity:0.9; overflow: hidden;padding: 0 10px;position: absolute; top: 282px;width: 100%;}
#slideshow .slide h2{font-size:12pt;line-height:20px;padding:7px 0 0 0;}
#slideshow .slide h2 a{color: #fff;font-family: tahoma;font-size: 15px;font-weight: bold;text-shadow: 1px 1px 3px #000;}
#slideshow .slide h3{font-size:10pt;line-height:18px;padding:7px 0 0 0;font-weight:normal;}
#slideshow .slide h3 a{color:#f1f1f1;}
#slideshow .thumbnails{position:absolute;top:0;right:0;width:100% !important;height:430px;overflow:hidden;}
#slideshow .thumbnails li{padding:5px; overflow:hidden;width:100%;height:65px;cursor:pointer;background:none}
#slideshow .thumbnails li:nth-child(even) {background:White}
#slideshow .thumbnails li:nth-child(odd) {background:#f5f5f5}
#slideshow .thumbnails li:hover{background: rgba(0,0,0,.3);}
#slideshow .thumbnails li .thumb{float:left;width:90px;height:65px;margin-right:5px;overflow:hidden;}
#slideshow .thumbnails li .thumb img{width:100%;min-height:100%}
#slideshow .thumbnails li.selected{background: #339cfc;color: #fff;}
#slideshow .thumbnails li p{font-size: 12px;font-weight: bold;line-height: 21px;}
#slideshow .navpage{z-index:9;position:absolute;bottom:0;left:610px;display:block;width:40px;color:#FFF;background:#C00}
#slideshow .navpage a{display:block;width:40px;height:65px;text-indent:-99999px;background:#5FB435 url(../images/slider-arrows.png) 12px 50% no-repeat}
#slideshow .navpage a.next{background-position:-32px 50%}
#slideshow .navpage a:hover{background-color:#52A52A}   

.cungcau_ctn {float:left; width:100%; background:#eee;}
.cungcau_ctn h2 {color:#3c9ed0}
.cungcau_ctn i {color:#3c9ed0}

.cungcau_ul {list-style:square !important; float:left}
.cungcau_ul li {width:100%; float:left; padding:5px;border-bottom:1px solid #eee}
.cungcau_ul li:last-child {border-bottom:none !important}
@media screen and (max-width: 530px) {
#slideshow {height:650px !important}
.caroufredsel_wrapper {width:100% !important}
.caroufredsel_wrapper:last-child {left:0 !important; margin-top:320px !important}
}


</style>
