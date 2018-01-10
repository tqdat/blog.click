<link rel="stylesheet" href="<?=base_url()?>site/mod/mod_ykien/asset/owl.carousel.css">
<script src="<?=base_url()?>site/mod/mod_ykien/asset/owl.carousel.min.js"></script>
<div class="width100" style="background:white; padding:20px 0" id="ykien">
    <h2 class="heading-home">Ý kiến khách hàng</h2>
    <p class="heading-home">Khách hàng nói gì về chúng tôi</p>
    <div class="main" id="owl-demo">
        <?php $comment = $this->db->result("select * from tour_comment where published = 1 AND is_home = 1 order by time desc limit 10");
        foreach($comment as $val){
            $tour = $this->db->row("select * from tour where id = $val->tour_id");
        ?>
        <div class="col-lg-12">
            <div class="tour_comment">
                <div class="avatar">
                    <?php if($val->avatar){ ?>
                    <img src="<?=base_url()?>data/comment/<?=$val->avatar?>"/>
                    <?php } else { ?>
                    <img src="<?=base_url()?>templates/images/user.png"/>
                    <?php } ?>
                </div>
                <div class="content">
                    
                    <div class="fullname">
                        <?=$val->fullname?>
                    </div>
                    "<?=$val->content ?>"
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <div class="owl-pagination"></div>
    
</div>

<script>
$(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
 
      autoPlay: true, //Set AutoPlay to 3 seconds
      nav:true,
      navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>','<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,2]
 
  });
 
});
</script>
<style>
.tour_comment {float:left; width:100%; background:white; padding:10px; margin:0 0 10px 0}
.tour_comment .content {text-align:center;font-style: italic;min-height:130px;float:left; width:100%; color:#999; margin-bottom:10px}
.tour_comment .fullname {font-size:16px; text-transform:uppercase; text-align:center; color:black; font-style:normal !important; font-weight:bold; letter-spacing: 2px; width:100%}
.tour_comment .avatar {height:150px !important; width:100%; float:left; text-align:center; margin:0; }
.tour_comment .avatar img {height:145px !important; width:145px !important; margin:auto; border-radius:50%; border:10px solid #fbfbfb }    

#ykien .owl-next, #ykien .owl-prev {
    width: 40px;
    padding: 5px 0 5px 12px;
    height: 40px;
    border-radius: 50%;
    border: 3px solid #ccc;
    color: #ccc;
    margin-top:-200px;
}
#ykien .owl-next {position:relative; float:right}
#ykien .owl-prev {position:relative; float:left}
</style>