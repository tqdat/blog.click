
<header>
    <div class="main">
	<div class="logo"><?=$this->load->mod('banner')?></a></div>
	<div class="hotline">
		<span class="icon-hotline"></span>
		Hotline: <label>0972 595 693<br></label>
	</div>
	<div class="box-search">
		 <form action="http://www.google.com/search" method="get" target="_blank" id="search">
			<input name="query" value="Nhập từ khóa tìm kiếm..." onclick="this.value = ''" type="text" class="text"/>
			<input name="btn" type="submit" value="" onclick="submit()" class="btn-search"/> 
			<input type="hidden" name="sitesearch" value="<?=base_url()?>"/>
			<input type="hidden" name="domains" value="<?=base_url()?>" />
		</form>
	</div>
    </div>
</header>
<nav id="nav-deskop" class="nav-collapse">
  <ul>
	<?php $uri = $this->uri->segment(1); ?>
	<li class="<?=($uri == '')?'active':''?>"><a href="<?=base_url()?>">Trang chủ</a></li>
	<li <?=($uri == 'gioi-thieu')?'class="active"':''?>><a href="<?=site_url('gioi-thieu')?>">Giới thiệu</a></li>
	<li <?=($uri == 'tour')?'class="active"':''?>>
		<a href="<?=site_url('tour')?>">Tour Du lịch</a>
		<ul class="subMenu">
			<?
			$menutour = $this->dnx->get_tour_menu();
			foreach($menutour as $val):
			$subcat = $this->dnx->get_tour_cat($val->cat_id);
			?>
			<li>
				<a href="<?=site_url($val->slug) ?>"><?=$val->name ?></a>
				<?php if (count($subcat)) { ?>
				<ul class="conMenu">
					<?foreach($subcat as $subval):?>
					<li><a href="<?=site_url($val->slug.'/'.$subval->slug)?>"><?=$subval->name?></a></li>
					<?endforeach;?>
				</ul>
				<?}?>
			</li>
			<?endforeach;?>
		</ul>
		<span class="caret"></span>
	</li>
	<li <?=($uri == 'khach-san')?'class="active"':''?>>
		<a href="<?=site_url('khach-san')?>">Khách sạn</a>
		<?php 
			$menuhotel = $this->dnx->get_all_hotel(1);
			if(!empty($menuhotel)):
		?>
		<ul class="subMenu">
			<?foreach($menuhotel as $val):?>
			<li><a href="<?=site_url('khach-san/'.$val->cat_slug)?>"><?=$val->cat_name?></a></li>
			<?endforeach;?>
		</ul>
		<span class="caret"></span>
		<?php endif; ?>
	</li>
	<li <?=($uri == 'thue-xe')?'class="active"':''?>><a href="<?=site_url('thue-xe')?>">Thuê xe</a></li>
	<li <?=($uri == 'tin-tuc')?'class="active"':''?>>
		<a href="<?=site_url('tin-tuc')?>">Tin tức</a>
		<?php 
			$menutin = $this->dnx->get_all_cat(1);
			if(!empty($menutin)):
		?>
		<ul class="subMenu">
			<?foreach($menutin as $val):?>
			<li><a href="<?=site_url('tin-tuc/'.$val->cat_slug)?>"><?=$val->cat_name?></a></li>
			<?endforeach;?>
		</ul>
		<span class="caret"></span>
		<?php endif; ?>
	</li>
	<li <?=($uri == 'lien-he')?'class="active"':''?>><a href="<?=site_url('lien-he')?>">Liên hệ</a></li>
	<div class="clearfix"></div>
  </ul>
</nav>
<!--Nav Responsive-->
<span id="bars">
   <i class="fa fa-2x fa-bars" style="padding: 5px 8px;"></i>
<!--<img src="<?=base_url()?>templates/images/menu-icon.png" width="32px"/> -->
</span>
<div id="menuItem">
    <button id="bars-close"><i class="fa fa-2x fa-close" style="padding: 5px 8px;"></i></button>
	<ul id="navResponsive">
            <li>
                <a href="<?=base_url()?>">Trang chủ</a>
            </li>
            <li>
                <a href="<?=site_url('gioi-thieu')?>">Giới thiệu</a>
            </li>
            <li>
                <a href="<?=site_url('tour')?>">Tour Du lịch</a>
                <span class="caret open"></span>
                <span class="caret exit" style="display:none"></span>
                <ul class="subNavResponsive">
                    <?
                    $menutour = $this->dnx->get_tour_menu();
                    foreach($menutour as $val):
                    $subcat = $this->dnx->get_tour_cat($val->cat_id);
                    ?>
                    <li>
                            <a href="<?=site_url($val->slug) ?>"><?=$val->name ?></a>
                            <?php if (count($subcat)) { ?>
                            <ul class="conMenu">
                                    <?foreach($subcat as $subval):?>
                                    <li><a href="<?=site_url($val->slug.'/'.$subval->slug)?>"><?=$subval->name?></a></li>
                                    <?endforeach;?>
                            </ul>
                            <?}?>
                    </li>
                    <?endforeach;?>
                </ul>
            </li>
            
            <li>
                <a href="<?=site_url('khach-san')?>">Khách sạn</a>
                <span class="caret open"></span>
                <span class="caret exit" style="display:none"></span>
                <?php 
			$menuhotel = $this->dnx->get_all_hotel(1);
			if(!empty($menuhotel)):
		?>
		<ul class="subNavResponsive">
			<?foreach($menuhotel as $val):?>
			<li><a href="<?=site_url('khach-san/'.$val->cat_slug)?>"><?=$val->cat_name?></a></li>
			<?endforeach;?>
		</ul>
		<?php endif; ?>
            </li>
            <li>
                <a href="<?=site_url('thue-xe')?>">Thuê xe</a>
            </li>
            <li>
                <a href="<?=site_url('tin-tuc')?>">Tin tức</a>
            </li>
            <li>
                <a href="<?=site_url('lien-he')?>">Liên hệ</a>
            </li>
	</ul>
</div><!--End Nav Responsive-->