<h2 class="heading"><?= $khachhang->title ?></h2>
<!--End Box title-->
<?php
foreach ($img as $list) {
    ?>
    <div class="list_img_album" style="text-align:center; margin-bottom:15px">
        <a href="<?= base_url() ?>data/khachhang/default/<?= $list->path ?>" class="fancybox" title="<?= $khachhang->title ?>" rel="group"><img src="<?= base_url() ?>data/khachhang/default/<?= $list->path ?>"  /></a>
    </div>
    <?php
}
?>
<h3>Ảnh đẹp Khách hàng khác</h3>
<?php foreach ($khachhangother as $kh):
    ?>
    <div class="list_img_album" style="text-align:center; margin-bottom:15px">
        <a href="<?= base_url() ?>data/khachhang/default/<?= $kh->images ?>" class="fancybox" title="<?= $kh->title ?>" rel="group"><img src="<?= base_url() ?>data/khachhang/default/<?= $kh->images ?>"  /></a><br />
        <a href="<?= site_url('anh-dep/' . $kh->slug . '-' . $kh->id) ?>" title="<?= $kh->title ?>" rel="group"><?= $kh->title ?></a>
    </div>
    <?php
endforeach;
?>