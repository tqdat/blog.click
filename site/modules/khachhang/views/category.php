<div id="sb-site" class="top-padding">
	<div class="container">
		<!--PAGES CONTENT-->
		<div class="pages_content">
			<div class="masonry list_album">
			<?php 
				foreach($album as $val){
			?>
				<!--ITEM-->
			   <div class="item">
					<div class="img_box"><a href="<?=site_url($val->slug.'-'.$val->id)?>" alt="<?=$val->title?>"><img src="<?=base_url().'data/khachhang/200/'.$val->images?>" width="100%"/></a></div>
					<div class="infoAlbum clearfix">
						<div class="titleAlbum"><a href="<?=site_url($val->slug.'-'.$val->id)?>" title="<?=$val->title?>" alt="<?=$val->title?>"><?=$val->title?></a></div>
						<div class="userUploaded"><a href="<?=site_url('user/'.$val->username.'/profile')?>"><i class="fa fa-user"></i> <?=(!empty($val->fullname))?$val->fullname:$val->username?></a></div>
						<div class="dateUploadedAlbum"><?=date('d/m/Y',$val->created)?></div>
					</div>
			   </div>
			  <?php 
				}
			  ?>
			</div>
		</div>
		<!--END PAGES CONTENT-->
	</div>
</div>