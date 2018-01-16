<!-- Bootstrap 3.3.4 -->
<link href="<?= base_url() ?>templates/dest/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
<!-- FontAwesome 4.3.0 -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons 2.0.0 -->
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
<!-- Theme style -->
<link href="<?= base_url() ?>templates/dest/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link href="<?= base_url() ?>templates/dest/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="<?= base_url() ?>templates/dest/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?= base_url() ?>templates/dest/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?= base_url() ?>templates/dest/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?= base_url() ?>templates/dest/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?= base_url() ?>templates/dest/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?= base_url() ?>templates/dest/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery 2.1.4 -->
<script src="<?= base_url() ?>templates/dest/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?= base_url() ?>templates/dest/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= base_url() ?>templates/dest/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>templates/dest/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>templates/dest/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>templates/dest/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>templates/dest/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>templates/dest/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>templates/dest/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>templates/dest/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?= base_url() ?>templates/dest/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?= base_url() ?>templates/dest/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>templates/dest/dist/js/app.min.js" type="text/javascript"></script>    

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>templates/dest/dist/js/pages/dashboard.js" type="text/javascript"></script>    

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>templates/dest/dist/js/demo.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	var base_url = '<?=base_url()?>';
	var base_url_site = '<?=base_url_site()?>';
</script>
<!-- <script type="text/javascript" src="<?php echo base_url()?>templates/js/core/menu.js" charset="UTF-8"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url()?>templates/js/core/jquery.js" charset="UTF-8"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url()?>templates/js/core/jquery.uniform.js" charset="UTF-8"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/jquery.validate.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/alert.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>templates/js/core/admin.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url()?>templates/ckeditor/ckeditor.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function(){
		/* $("input, textarea, button").uniform();*/
	});
</script>
<!-- <script type="text/javascript">
	ddsmoothmenu.init({
		arrowimages: {down: ['downarrowclass', base_url+'templates/images/m-tranfer.png', 10], right: ['rightarrowclass', base_url+'templates/menu_right.png']},
    mainmenuid: "slidemenu", //Menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
</script> -->