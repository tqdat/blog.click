<div class="main-box">
	<h1 class="heading"><?=$rs->title?></h1>
	<span style="color:#727272; font-size:12px;"><i class="fa fa-clock-o"></i> <?=date('d/m/Y H:i:s',$rs->created)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> <?=$rs->hits?> lượt xem</span>
	<div class="share">
                    <!-- Place this tag where you want the +1 button to render. -->
                    <div class="plusone" style="float: left;">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="plusone" style="float: left;">
                    <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                     <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div>   
                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                      window.___gcfg = {lang: 'vi'};

                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>        
                    <div style="float: left;" class="fb-like" data-href="<?=base_url().uri_string()?>" data-send="true" data-layout="button_count" data-width="130" data-show-faces="true"></div>   
					<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
					<script type="IN/Share" data-url="<?=base_url().uri_string()?>" data-counter="right"></script>
                </div>
                <div style="clear:both;"></div>
	<h2 class="introtext" style="font-size:14px;"><?=$rs->introtext?></h2>
	
	<div class="fulltext"><?=htmlspecialchars_decode($rs->fulltext)?></div>
	<div class="other_new">
	  <?php if (count($tinmoi)>0) {?>
		<h5 class="h-tinlienquan" style="font-weight: bold; text-transform:  uppercase;">Bài viết liên quan mới đăng</h5>
		<ul>
			<?foreach($tinmoi as $val1):?>
			<li><a href="<?=site_url($val1->main_slug.'/'.$val1->slug.'-'.$val1->id)?>"><?=$val1->title?></a>
			<span style="color:#727272; font-size:12px;">(<i class="fa fa-clock-o"></i> <?=date('d/m/Y',$val1->created)?>&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> <?=$val1->hits?> lượt xem)</span>
			</li>
			<?endforeach;?>
		</ul>
		<?php }
		 if (count($tincu)>0) {?>
		<h5 class="h-tinlienquan" style="font-weight: bold; text-transform:  uppercase;">Bài viết liên quan cũ hơn</h5>
		<ul>
			<?foreach($tincu as $val):?>
			<li><a href="<?=site_url($val->main_slug.'/'.$val->slug.'-'.$val->id)?>"><?=$val->title?></a>
			<span style="color:#727272; font-size:12px;">(<i class="fa fa-clock-o"></i> <?=date('d/m/Y',$val->created)?>&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> <?=$val->hits?> lượt xem)</span>
			</li>
			<?endforeach;?>
		</ul>
		<?php }?>
	</div>
</div>