<!--- Jcarousel --->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/jcarousel.responsive.css"/>
<script src="<?= base_url() ?>templates/js/jquery.jcarousel.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>templates/js/jcarousel.responsive.js" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $('.jcarousel').jcarouselAutoscroll({
        interval: 2000,
    });

    $('#tour_comment').jcarouselAutoscroll({
        interval: 2000
    });
});
</script>