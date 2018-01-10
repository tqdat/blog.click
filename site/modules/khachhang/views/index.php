<script src="<?= base_url() ?>templates/js/isotope.pkgd.js" type="text/javascript"></script>
<script src="<?= base_url() ?>templates/js/imagesloaded.pkgd.js" type="text/javascript"></script>
<h2 class="heading"><?= $title ?></h2>
<div class="slide_img_product col-lg-12">
<div class="grid">

    <div class="grid-sizer"></div>

    <? foreach($list_img as $rs):?>
    <div class="grid-item">
        <a rel="example_group" href="<?= base_url() ?>data/khachhang/default/<?= $rs->images ?>">
            <img src="<?= base_url() ?>data/khachhang/500/<?= $rs->images ?>" />
             <span class="title_slide"><?=$rs->title?></span>
        </a>
    </div>

    <? endforeach;?>
    <div class="clearfix"></div>
</div>
</div>
<link href="<?= base_url() ?>templates/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url() ?>templates/fancybox/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url() ?>templates/fancybox/jquery.fancybox.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
        // layout Isotope after each image loads
         $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout');
        });


    });

    $("a[rel=example_group]").fancybox();



</script>


<style type="text/css">
    .grid {
    }
    .grid span {
     bottom:3%;
     left:2%; width:96%;
      background: #f06e00;
      opacity: 0.7;
      position:absolute;
      overflow: hidden;
      height: 30px;
      color: #fff;
      padding: 5px;
      white-space: nowrap; text-overflow: ellipsis; 
    }
    /* clear fix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    /* ---- .grid-item ---- */

    .grid-sizer,
    .grid-item {
        width: 49%;
    }

    .grid-item {
        float: left;
        padding: 7px;
    }

    .grid-item img {
        display: block;
        width: 100%;
        transition: all linear 0.3s;
    }

    .grid-item>a{overflow: hidden; display: block}
    .grid-item img:hover{transform: scale(1.1)}
    
    @media screen and (max-width: 425px) {
    .grid-sizer,
    .grid-item {
        width: 50%;
    }
    .grid-item {
        padding: 3px;
    }
    
}
</style>