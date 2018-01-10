<?
if(!isset($title) || ($title == '') ){
    $title = $this->config->item('site_name');
}
if(!isset($des) || ($des == '')){
    $des = $this->config->item('site_des');
}
if(!isset($keyword) || ($keyword == '')){
    $keyword = $this->config->item('site_keyword');
}
?>

<div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=362009480521393";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<meta charset="utf-8">
<link rel="alternate" hreflang="vi" href="<?= base_url().uri_string(); ?>" /> 
<title><?=$title?></title>
<meta name="description" content="<?php echo (isset($des)) ? strip_tags(html_entity_decode($des)) : $this->config->item('site_des') ?>">
<meta name="keywords" content="<?=$keyword?>">
<?if($this->config->item('cf_yahoo') != ''){?>
<meta name="msvalidate.01" content="<?=$this->config->item('cf_yahoo')?>" />
<?}?>
<?if($this->config->item('cf_google_webmaster') != ''){?>
<meta name="google-site-verification" content="<?=$this->config->item('cf_google_webmaster')?>" />
<?}?>
<?if($this->config->item('cf_alexa') != ''){?>
<meta name="alexaVerifyID" content="<?=$this->config->item('cf_alexa')?>" /> 
<?}?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta name="alexaVerifyID" content="<?php echo $this->config->item('cf_alexa');?>" />
<meta name="author" content="clickgo.vn" />  
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?= base_url() . uri_string(); ?>" />
<meta property="og:title" content="<?= $title ?>" />

<?php $img_og = ($images != '')?base_url().$images:base_url_site().$this->config->item('contact_img');?>
<meta property="og:image" content="<?= $img_og ?>"/>
<meta property="og:image:alt" content="<?php echo $title ?>" />
<meta property="og:site_name" content="<?= $this->config->item('site_name') ?>"/>
<meta property="og:description" content="<?php echo (isset($des)) ? strip_tags(html_entity_decode($des)) : $this->config->item('site_des') ?>"/>
<meta name="google-site-verification" content="<?php echo $this->config->item('cf_google_webmaster');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<link rel="shortcut icon" href="<?=base_url()?>templates/images/favicon.ico" type="image/x-icon" />
<link rel="shortlink" href="<?=base_url().uri_string();?>" />
<link rel="canonical" href="<?=base_url().uri_string();?>" />
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?= $title ?>">
<meta itemprop="description" content="<?php echo (isset($des)) ? strip_tags(html_entity_decode($des)) : $this->config->item('site_des') ?>">
<meta itemprop="image" content="<?= $img_og ?>">
<!-- Twitter Card data -->
<meta name="twitter:card" content="<?=$img_og?>">
<meta name="twitter:site" content="<?=$this->config->item('site_name')?>">
<meta name="twitter:title" content="<$title?>">
<meta name="twitter:description" content="<?php echo (isset($des)) ? strip_tags(html_entity_decode($des)) : $this->config->item('site_des') ?>">
<meta name="twitter:creator" content="ClickGo.Vn">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?=$img_og?>">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $this->config->item('cf_google_analytics');?>', 'auto');
  ga('send', 'pageview');

</script>

<!--Css-->
<link rel="stylesheet" href="<?=base_url()?>templates/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>templates/css/styles.css">
<link rel="stylesheet" href="<?=base_url()?>templates/css/font-awesome.css">
<!--Javascript-->
<script>
	var base_url = '<?=base_url()?>';
</script>
<script src="<?=base_url()?>templates/js/jquery.min.js"></script>
<script src="<?=base_url()?>templates/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>templates/js/jquery.ellipsis.js"></script>
<script src="<?=base_url()?>templates/js/jquery.easy-ticker.js"></script>
<script src="<?=base_url()?>templates/js/function.js"></script>
<script src="<?=base_url()?>templates/js/jquery.validate.min.js"></script>
<!-- Fancybox -->
<script type="text/javascript" src="<?=base_url()?>templates/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script>
	 $(document).ready(function() {
		  $('.fancybox').fancybox();
		 });
</script>