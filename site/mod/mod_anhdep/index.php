<link href="<?=base_url()?>site/mod/mod_anhdep/asset/owl.carousel.css" rel="stylesheet" type="text/css"/>
<script src="<?=base_url()?>site/mod/mod_anhdep/asset/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {

      $('.owl-carousel').owlCarousel({
            loop:true,
            autoplay:true,
            autoplayHoverPause: true,
            autoplayTimeout:5000,
            margin:10,
            nav:true,
            navText: [
                "<span class='glyphicon glyphicon-chevron-left'></span>",
                "<span class='glyphicon glyphicon-chevron-right'></span>"
                ],
            responsive:{
                0:{
                    items:1
                },
                425:{
                    items:2
                },
                768:{
                    items:3
                },
                1000:{
                    items:5
                }
            } 
        });

    });
</script>
<div class="container" style="margin-bottom:30px;">
<div class="row">
<div class="owl-carousel">
    
    <?php 
    $khachhang = $this->db->result("select * from khachhang where published = 1 order by id desc limit 10");
    foreach ($khachhang as $val){ ?>
    <div class="item">
        <img src="<?=base_url()?>data/khachhang/500/<?=$val->images?>" alt="<?=$val->title?>">
        <a href="<?=site_url('anh-dep/'.$val->slug.'-'.$val->id)?>"><h5><?= $val->title?></h5></a>
    </div>
    <?php } ?> 
</div>
</div>
</div>
<style>
.owl-carousel { margin:auto; height:auto;}
.owl-carousel .item {width:100%; float:left}
.owl-carousel .item img {height:150px !important; float:left; margin-bottom:10px}
.owl-carousel .item h5 {font-size:12px; text-align:center; width:90%; margin-left:5%;}  
.owl-carousel .item a {color:#720101;}
.owl-carousel .item a:hover {transition:0.3s all linear;color:#337ab7}
.owl-nav {width:100%; text-align: center; float:left;  margin-top:-140px;position:relative; z-index:999}
.owl-prev {float:left; padding:5px; background:white; color:#720101; border-radius:10px; border:1px solid #720101}
.owl-next {float:right; padding:5px; background:white; color:#720101; border-radius:10px; border:1px solid #720101}


@media screen and (max-width: 768px) {
.owl-carousel .item img {height:170px !important; float:left; margin-bottom:10px}
}
@media screen and (max-width: 375px) {
.owl-carousel .item img {height:180px !important; float:left; margin-bottom:10px}
}
</style>