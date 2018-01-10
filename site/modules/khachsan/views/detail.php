<h2 class="heading">Khách sạn</h2>
<!--End Box title-->
<div class="main-box">
	<h1 class="title"><?=$rs->title?></h1>
	
	<span style="color:#727272; font-size:12px;"><i class="fa fa-clock-o"></i> <?=date('d/m/Y H:i:s',$rs->created)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i> <?=$rs->hits?> lượt xem</span>
	<div class="hotel-info">
	<div class="price"><p>Giá từ: <span><?=$rs->price?></span></p></div>
	<div><p><span class="address">Địa chỉ:</span><?=$rs->address?></p></div>
	</div>
	<h2 class="introtext" style="font-size:14px;"><?=$rs->introtext?></h2>
	
	<div class="fulltext"><?=htmlspecialchars_decode($rs->fulltext)?></div>
</div>