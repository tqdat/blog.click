<h1 class="heading"><?=$title?></h1>
<!--End Box title-->
<h2 class="des" style="margin:5px;color:#720101"><?=$des?></h2>
<div class="share">
    <!-- Place this tag where you want the +1 button to render. -->
    <div class="plusone" style="float: left;">
        <div class="g-plusone" data-size="medium"></div>
    </div>

    <!-- Place this tag after the last +1 button tag. -->
    <script type="text/javascript">
      window.___gcfg = {lang: 'vi'};

      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>        
    <div style="float: left;" class="fb-like" data-href="<?=base_url().uri_string()?>" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true"></div>   

</div>
<div style="clear:both;"></div>
<?php if(!empty($list)): ?>
<div class="tour-list row" id="tour">
    <?php
    $i = 1;
    foreach($list as $val):
    $price = $this->dnx->get_min_price($val->id);
    $khoihanh = $this->tour->get_city_by_id($val->khoihanh);
    ?>
    <!--Item List-->
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="tour-box">
            <?php if($val->giamgia > 0):?>
            <div class="tour-sale"><span>Giảm <?=$val->giamgia?>%</span></div>
            <?php endif; ?>
            <div class="tour-img">
                <a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><img src="<?=base_url()?>data/tour/500/<?=$val->images?>" alt="<?=$val->title?>"></a>
                <div>
                    <h5><a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><?=$val->title?></a></h5>
                    <div><span class="pull-left">Thời gian</span><span class="pull-right"><?=$val->ngay?> Ngày <?=($val->dem > 0)?' - '.$val->dem.' '.'đêm':''?></span>
                    <div class="clearfix"></div></div>
                    <div><span class="pull-left">Phương tiện:</span><span class="pull-right"><?=$val->vanchuyen?></span>
                    <div class="clearfix"></div></div>
                    <div><span class="pull-left">Khởi hành tại:</span><span class="pull-right"><?=$khoihanh->city_name?></span>
                    <div class="clearfix"></div></div>
                    <div><span class="pull-left">Giá:</span><span class="pull-right text-red"><?=number_format($price,0,'.','.')?> VNĐ</span>
                    <div class="clearfix"></div></div>
                    <div class="row">
                        <div class="col-xs-6 text-left"><a class="book_btn" href="<?=site_url($val->id.'-'.$val->slug)?>">Chi tiết</a></div>
                        <div class="col-xs-6 text-right"><a href="<?=site_url('dat-tour/'.$val->slug.'-'.$val->id)?>" class="book_btn">Đặt tour</a></div>
                    </div><!-- .row -->
                </div>
            </div>
            <div class="tour-info">
                <h3><a id="tour_50" title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>"><?=$val->title?></a></h3>
                <div style="padding:0 5px;"><span class="pull-left"><b>Thời gian:</b></span><span class="pull-right"><?=$val->ngay?> Ngày <?=($val->dem > 0)?' - '.$val->dem.' '.'đêm':''?></span>
					<div class="clearfix"></div></div>
				<div style="padding:0 5px;"><span class="pull-left"><b>Hình thức: </b></span><span class="pull-right"><?=$val->hinhthuc?></span>
					<div class="clearfix"></div></div>		
					<div style="padding:0 5px;"><span class="pull-left"><b>Khởi hành tại:</b></span><span class="pull-right"><?=$khoihanh->city_name?></span>
					<div class="clearfix"></div></div>
                <div class="price">
                    <div class="pull-left">Giá: <?=number_format($price,0,'.','.')?> VNĐ</div>
                    <div class="pull-right"><a class="read-more" href="<?=site_url($val->id.'-'.$val->slug)?>">Chi tiết</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--End Item List-->
    <?php endforeach; ?>
    <div class="clearfix"></div>
    <div class="pages"><?=$pagination?></div>
</div><!--End row-->
<?php else: ?>
Không có Tour trong mục này
<?php endif; ?>





<?php
   if ($total_rows>12) {
  ?>
   
    <form id="xemthem">
        <input class="btn_send" type="submit" style="float: right; margin-right:10px" value="Xem thêm <?=$total_rows - 12?> tour">
  <input type="hidden" name="id_chude" value="<?=$id_chude?>">
  <input type="hidden" name="offset" id="offset" value="12">
    </form>
  <?php    
   }
?>  

<script type="text/javascript">
$(document).ready(function() {
    
    
    $("#xemthem").validate({
        rules: {
            
        },
        messages: {
           
        }
        ,submitHandler: function() {
            dataString = $("#xemthem").serialize();
            $.ajax({
               type: "POST",
                url: base_url+'api/loadtour_chude',
                data: dataString,
                dataType: "json",
                success: function(data) {
                    $(".btn_send").prop('value','Xem thêm '+ (data.total - data.offset)+' tour');
                    $('div#tour').append(data.html);
                    $("#offset").val(data.offset);
                    if (data.offset >= data.total){
                       $("#xemthem").hide(); 
                    }
                }
            }); 
        }        
    });
    
});

</script>