<script type="text/javascript">
var base_url = '<?=base_url()?>';
var base_url_site = '<?=base_url_site()?>';
</script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/menu.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/jquery.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/jquery.uniform.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/alert.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/vtip.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/admin.js" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>templates/css/styles.css?v=2.0" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>templates/css/uniform.default.css?v=2.0" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>templates/css/menu.css?v=2.0" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>templates/css/reponsive.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>templates/css/alert.css?v=2.0" media="screen" />
<script type="text/javascript" src="<?=base_url()?>templates/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
    ddsmoothmenu.init({
    arrowimages: {down: ['downarrowclass', base_url+'templates/images/m-tranfer.png', 10], right: ['rightarrowclass', base_url+'templates/menu_right.png']},
    mainmenuid: "slidemenu", //Menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
</script>