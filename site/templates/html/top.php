<script>
$(document).ready(function(){
    $(".open_btn").click(function(){
        $(".menu_mobile").addClass("show");
    });
    
    $(".close_btn").click(function(){
        $(".menu_mobile").removeClass("show");
    });
    
    // ---------------------submenu mobile----------------------
    $(".menu_mobile .open").click(function () {
        $(this).parent().find(".open").hide();
        $(this).parent().find(".exit").show();
        $(this).parent().find(".menu_mobile_con").slideDown();
    });

    $(".menu_mobile .exit").click(function () {
        $(this).parent().find(".exit").hide();
        $(this).parent().find(".open").show();
        $(this).parent().find(".menu_mobile_con").slideUp();
    });
});
</script>
<script type="text/javascript">

    jQuery(document).ready(function ($) {
        
            var menu = $("#menu_container");
            var logomini = $("#logomini");
            // dùng sự kiện cuộn chuột để bắt thông tin đã cuộn được chiều dài là bao nhiêu.
            $(window).scroll(function () {
                // Nếu cuộn được hơn 120px rồi
                if ($(this).scrollTop() > 134) {
                    menu.addClass("fix_top");
                    logomini.addClass("logo_mini_fix");
                    
                } else {
                    // Ngược lại, nhỏ hơn 120px thì hide menu đi.
                    menu.removeClass("fix_top");
                    logomini.removeClass("logo_mini_fix");
                }    
            }
            )
        
    })
</script>
<header>
    <div class="hotline">
        <div class="main">
            <?=$this->load->mod('header')?>
        </div>
    </div>
    <div class="main">
     <div class="col-lg-4 col-md-4" align="left">
                    <?=$this->load->mod('banner')?>
                </div>
                <div class="col-lg-8 col-md-8" align="right">
                   
                    <?=$this->load->mod('adv')?>
                </div>
       
    </div>
    <div id="menu_container">
        <div class="main" style="position:relative">
            <ul class="menu">
                <?php $uri1 = $this->uri->segment(1); $uri2 = $this->uri->segment(2); ?>
                <li><a <?=($uri1=='') ? "class='active'" : '' ?> href="<?=base_url()?>">Trang chủ</a></li>
                <!--<li><a <?=($uri1 == 'gioi-thieu') ? "class='active'" : ''?> href="<?=site_url('gioi-thieu')?>">Giới thiệu</a></li>
               
                 -->
               
                <!--<li><a <?=($uri1 == 'anh-dep') ? "class='active'" : ''?> href="<?=site_url('anh-dep')?>">Khách hàng</a></li>
                -->
                <!---Menu News--->
                <?php
                $menu_news = $this->db->result("select * from category where published = 1 and parent_id = 0 and cat_is_menu = 1 order by cat_order asc");
                foreach ($menu_news as $val):
                    $subcat = $this->dnx->get_all_cat($val->cat_id);
                    ?>
                    <li>
                        <a href=" <?= site_url($val->cat_slug)?>" <?= ($uri1 == $val->cat_slug ) ? 'class="active"' : '' ?>>
                            <?php echo $val->cat_name; //echo (count($subcat)) ? ' <span class="caret"></span>':''; ?> 
                        </a>
                        <?php 
                        if (count($subcat)) {
                        ?>
                            <ul class="menucon">
                                <?php
                                foreach ($subcat as $val1): 
                                    ?>
                                    <li>
                                        <a <?= ($uri1 == $val1->cat_slug ) ? 'class="active"' : '' ?> href="<?= site_url($val->cat_slug.'/'.$val1->cat_slug) ?>" >
                                            <?= $val1->cat_name ?>
                                        </a>
                                    <li>
                                <?php endforeach; ?>
                            </ul>                       
                        <?php } ?>
                    </li>
                <?php endforeach; ?>
              </ul>
            <div class="logo_mini">
              <a href="<?=base_url()?>" title="Blog ClickGo.Vn"><img id="logomini" src="<?=base_url()?>templates/images/logo-top-mobile.png" style="height:40px !important; width: auto !important; margin: -5px 0 0 10px;" /></a>
            </div>
            <div class="open_btn">
                <i class="fa fa-bars fa-2x"></i>
            </div>
        </div>
    </div>
</header>
<div class="menu_mobile">
    <div class="close_btn">
        <i class="fa fa-times fa-2x"></i>
    </div>
    
    <ul>
        <li><a <?=($uri1=='') ? "class='active'" : '' ?> href="<?=base_url()?>">Trang chủ</a></li>

        <!---Menu News--->
        <?php
        $menu_news = $this->dnx->get_all_cat(0);
        foreach ($menu_news as $val):
            $subcat = $this->dnx->get_all_cat($val->cat_id);
            ?>
            <li>
                <a href=" <?= site_url($val->cat_slug)?>" <?= ($uri1 == $val->cat_slug ) ? 'class="active"' : '' ?>>
                    <?php echo $val->cat_name; //echo (count($subcat)) ? ' <span class="caret"></span>':''; ?> 
                </a>
                <?php 
                if (count($subcat)) {
                        ?>
                        <i class="open">+</i>
                        <i class="exit">-</i>
                        <ul class="menu_mobile_con">
                            <?php
                            foreach ($subcat as $val1): 
                                ?>
                                <li>
                                    <a <?= ($uri1 == $val1->cat_slug ) ? 'class="active"' : '' ?> href="<?= site_url($val->cat_slug.'/'.$val1->cat_slug) ?>" >
                                        <?= $val1->cat_name ?> 
                                    </a>
                                <li>
                            <?php endforeach; ?>
                        </ul>

                <?php } ?>
            </li>
        <?php endforeach; ?>
        <!---End Menu news--->  
      
    </ul>
</div>
<style>
.fix_top {position:fixed; margin-top:-38px}

.logo_mini img {display: none;}
.hotline {height:36px; float:left; width:100%; padding: 5px 10px; color:#666;background:#f5f5f5;}
.hotline b {color:#f06e00}
header {float:left; width:100%;height:auto; background:white;position:relative; z-index:99999999}
.caret {color:#666; margin-left:0px}
.logo {float:left; height:90px}
.logo img {height:80px; margin-top:5px; position:relative}
#menu_container {float:left; width:100%; height:45px; padding:9px 0;background:#339cfc;}

.menu {font-family:arial;list-style:none;float:left; margin-bottom:0;}
.menu>li {margin:1px ; font-size:14px; float:left}
.menu>li>a { padding:17px 20px; color:#fff; text-transform:uppercase; text-decoration: none;}
.menu .active {color:#f06e00; background:white}
.menu>li>a:hover {color:#f06e00; background:white}

.menu>li:hover > .menucon {display:block; transition:all .3s}
.menucon {box-shadow:0 2px 2px #999;min-width:140px;position:absolute; padding-bottom:10px; z-index:99999999;padding-top:10px; display:none; background:white; margin-top:9px;}
.menucon>li {position:relative;padding:1px 2px; width:100%; min-width:140px; text-align:left}
.menucon>li>a {padding:2px 15px; color:#666; text-decoration: none;}
.menucon>li>a:hover {color: #f06e00;}

.menucon>li:hover .menulv3 {display:block}
.menulv3 {box-shadow:0 2px 2px #999;position:absolute; left:100%;top:-10px; display:none; min-width:170px; background:white; padding:10px;}
.menulv3>li {display:block}
.menulv3>li>a {color:#666}

.menulv3>li>a:hover {color:#f06e00}

.menulv3>li:hover .menulv4 {display:block}
.menulv4 {box-shadow:0 2px 2px #999;position:absolute; left:100%;top:-10px; display:none; min-width:140px; background:white; padding:10px;}
.menulv4>li {display:block}
.menulv4>li>a {color:#666}

.menulv4>li>a:hover {color:#f06e00}

.open_btn {position:absolute; right:10px; display:none; top:0}
.open_btn i {border-radius:5px;color:#fff; cursor: pointer; padding: 3px 10px 0 0;}
.open_btn:hover i{color:#fdcf0b}
.close_btn {margin:10px; cursor: pointer; color:#ccc}
.close_btn:hover {color:#f06e00}
.menu_mobile {overflow-y: scroll;transition:all .5s;right:-240px; width:240px; height:100%; background:#eb703d; position:fixed; z-index:99999999999999999999}
.show {right:0; transition:all .5s}
.menu_mobile .active, .menu_mobile a:hover {font-weight:bolder; text-decoration: nones}
.menu_mobile a {color:#fff}

.menu_mobile>ul>li {border-bottom:1px solid #f5f5f5}
.menu_mobile>ul {width:100%; float:left; font-size:15px; list-style:none}
.menu_mobile>ul>li>a {width:100%;display:block; padding:5px 0; text-indent: 10px; margin:5px 0}
.menu_mobile>ul>li>ul {margin-left:20px;}
.menu_mobile>ul>li>ul>li>a {color:#fff}
.menu_mobile_con {}
.open {display:none}
.exit { margin-right:10px !important; font-size:30px !important;}
.menu_mobile .open, .menu_mobile .exit {color:#ccc; font-style: normal;cursor:pointer; font-size:20px; position:relative; float:right; margin-right:10px; margin-top:-35px}
.logo_mini_fix {display: none !important}
@media screen and (max-width:1000px){
    .menu {display:none}
    .open_btn {display:block}
  .logo_mini_fix {display: block !important}  
}
@media screen and (max-width:767px){
    .address {display:none}
    
}
@media screen and (max-width:459px){
}

@media screen and (max-width:240px){
    .logo img{height:60px; margin-top:10px}
}
</style>