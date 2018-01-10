<?php 
$catid = get_params('catid',$attr);
$type = get_params('type',$attr);
$max = get_params('max',$attr);
$cat = $this->db->row("select * from category where published = 1 and cat_id = $catid");
$limit = $max;
//foreach($category as $cat){
   
if ($type==1) {
   $news1 = $this->db->row("select * from news where (main_id=$cat->cat_id OR catid = $cat->cat_id) and published = 1 order by id desc limit 1");
   $list_news = $this->db->result("select * from news where published = 1 and (main_id=$cat->cat_id OR catid = $cat->cat_id) order by id desc limit $limit offset 1");
?>
<div class="width100" id="homenews">
    <div class="main">
        <div class="col-lg-12">
            <h2 class="heading-home"><a href="<?=site_url($cat->cat_slug)?>" title="<?=$cat->cat_name_seo?>"><?=$cat->cat_name_seo?><a/></h2>
            <!--<p class="heading-home"><?=$cat->cat_des?></p> -->
        </div>
        <div class="col-md-6 firstnews">
            <div class="news">
                <figure class="newspic">
                    <a title="<?=$news1->title?>" href="<?=  site_url($news1->main_slug.'/'.$news1->slug.'-'.$news1->id)?>">
                    <?if($news1->images == ''){?>
                    <img class="img" alt="<?=$news1->title?>" src="<?= base_url() ?>templates/images/no_images.gif">
                    <?}else{?>
                    <img class="img" alt="<?=$news1->title?>" src="<?= base_url() ?>data/news/default/<?=$news1->images?>">
                    <?}?>
                    </a>
                </figure>
                <div class="infonews">
                    <a title="<?=$news1->title?>" href="<?=  site_url($news1->main_slug.'/'.$news1->slug.'-'.$news1->id)?>">
                        <h3 class="title"><?php echo $news1->title;?><?php // echo mb_substr($news1->title,0, 70, 'utf8')?></h3>
                       <!-- <p class="des"><?=mb_substr($news1->introtext,0,100,'UTF-8')?> ...</p> -->
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="listnews">   
                <? foreach($list_news as $rs): ?>
                <li>
                    <div class="width100">
                        <div class="img">
                            <a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>">
                                <img src="<?=base_url()?>data/news/200/<?=$rs->images?>" alt="<?=$rs->title?>">
                            </a>
                        </div>
                        <h3><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><?=$rs->title;//mb_substr($rs->title,0,100,'utf8')?></a></h3>
                        <p><?=mb_substr($rs->introtext, 0,60,'utf8')?>...</p>
                    </div>
                </li>
                <? endforeach; ?>

            </ul>
        </div>

    </div>   
</div>
        <?php
      } // endif
  
if ($type==2) {
   $news1 = $this->db->row("select * from news where (main_id=$cat->cat_id OR catid = $cat->cat_id) and published = 1 order by id desc limit 1");
   $list_news = $this->db->result("select * from news where published = 1 and (main_id=$cat->cat_id OR catid = $cat->cat_id) order by id desc limit $limit offset 1");
   
?>
<div class="width100" id="homenews">
    <div class="main">
        <div class="col-lg-12">
            <h2 class="heading-home"><a href="<?=site_url($cat->cat_slug)?>" title="<?=$cat->cat_name_seo?>"><?=$cat->cat_name_seo?></a></h2>
            <!--<p class="heading-home"><?=$cat->cat_des?></p> -->
        </div>
        
        <div class="col-md-6">
            <ul class="listnews">   
                <? foreach($list_news as $rs): ?>
                <li>
                    <div class="width100">
                        <div class="img">
                            <a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>">
                                <img src="<?=base_url()?>data/news/200/<?=$rs->images?>" alt="<?=$rs->title?>">
                            </a>
                        </div>
                        <h3><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><?=$rs->title;//mb_substr($rs->title,0,100,'utf8')?></a></h3>
                        <p><?=mb_substr($rs->introtext, 0,60,'utf8')?>...</p>
                    </div>
                </li>
                <? endforeach; ?>

            </ul>
        </div>
        <div class="col-md-6 firstnews">
            <div class="news">
                <figure class="newspic">
                    <a title="<?=$news1->title?>" href="<?=  site_url($news1->main_slug.'/'.$news1->slug.'-'.$news1->id)?>">
                    <?if($news1->images == ''){?>
                    <img class="img" alt="<?=$news1->title?>" src="<?= base_url() ?>templates/images/no_images.gif">
                    <?}else{?>
                    <img class="img" alt="<?=$news1->title?>" src="<?= base_url() ?>data/news/default/<?=$news1->images?>">
                    <?}?>
                    </a>
                </figure>
                <div class="infonews">
                    <a title="<?=$news1->title?>" href="<?=  site_url($news1->main_slug.'/'.$news1->slug.'-'.$news1->id)?>">
                        <h3 class="title"><?php echo $news1->title;?><?php // echo mb_substr($news1->title,0, 70, 'utf8')?></h3>
                      <!--   <p class="des"><?=mb_substr($news1->introtext,0,100,'UTF-8')?> ...</p> -->
                    </a>
                </div>
            </div>
        </div>

    </div>   
</div>
        <?php
      } // endif
    
if ($type==3) {
   $list_news = $this->db->result("select * from news where published = 1 and (main_id=$cat->cat_id OR catid = $cat->cat_id) order by id desc limit $limit");
?>
<div class="width100">
    <div class="main">
        <div class="col-lg-12">
            <h2 class="heading-home"><a href="<?=site_url($cat->cat_slug)?>" title="<?=$cat->cat_name_seo?>"><?=$cat->cat_name_seo?></a></h2>
           
        </div> 
        
        <div>
           <ul class="listnewscat">   
                <? foreach($list_news as $rs): ?>
                <li>
                    <div class="col-lg-4" style="height: 240px;">
                        <div class="img">
                            <a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>">
                                <img src="<?=base_url()?>data/news/300/<?=$rs->images?>" alt="<?=$rs->title?>">
                            </a>
                        </div>
                        <h3><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><?=$rs->title;//mb_substr($rs->title,0,100,'utf8')?></a></h3>
                        <!--<p><?=mb_substr($rs->introtext, 0,70,'utf8')?>...</p> -->
                    </div>
                </li>
                <? endforeach; ?>

            </ul>
        </div>
        

    </div>   
</div>
        <?php
      } // endif
       
if ($type==4) {
   $list_news = $this->db->result("select * from news where published = 1 and (main_id=$cat->cat_id OR catid = $cat->cat_id) order by id desc limit $limit");
?>
<div class="width100">
    <div class="main">
        <div class="col-lg-12">
            <h2 class="heading-home"><a href="<?=site_url($cat->cat_slug)?>" title="<?=$cat->cat_name_seo?>"><?=$cat->cat_name_seo?></a></h2>
           
        </div> 
        
        <div>
           <ul class="listnewscat">   
                <? foreach($list_news as $rs): ?>
                <li>
                    <div class="col-lg-3">
                        <div class="img">
                            <a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>">
                                <img src="<?=base_url()?>data/news/300/<?=$rs->images?>" alt="<?=$rs->title?>">
                            </a>
                        </div>
                        <h3><a href="<?=site_url($rs->main_slug.'/'.$rs->slug.'-'.$rs->id)?>"><?=$rs->title;//mb_substr($rs->title,0,100,'utf8')?></a></h3>
                        <!--<p><?=mb_substr($rs->introtext, 0,70,'utf8')?>...</p> -->
                    </div>
                </li>
                <? endforeach; ?>

            </ul>
        </div>
        

    </div>   
</div>
        <?php
      } // endif
       ?>
<style>
.listnewscat li img {width: 100% !important; height: 180px !important;}
#homenews {background:#f8f8f8}
#homenews .news {height:330px; margin-top:0px}
#homenews .newspic {height:240px;}
#homenews .title {line-height:23px; font-weight:bold;padding: 3px 0;}
.news {position:relative; background:white; width:100%; float:left;  margin-bottom: 15px; overflow: hidden; height: 340px; box-shadow: 4px 4px 5px 0 rgba(50, 50, 50, 0.09)}
.newspic {width:100%;float:left; height:200px; overflow: hidden; position: relative;}
.newspic img {width:100%; float:left; min-height:200px; transition:all .3s}
.newspic img:hover {transition:all .5s; transform:rotate(7deg) scale(1.3,1.3)}
.news .title { color: #333; font-size:16px; line-height:16px; float:left; width:100%; 
 margin:5px 0; padding-top:5px}
.news a {color:#333;}
.news .infonews {padding:0 10px; float:left; position:relative}
.news .des {color:#666; float:left; text-align: justify; padding-bottom:10px; height:100px}
.news .readmore {float:left; text-align:right; height:40px; width:100%}
.listnews {float:left; width:100%}
.listnews li{
    float:left;
    width:100%;
}
.listnews p {padding:10px}
.listnews h3, .listnewscat h3 {font-size:14px !important; font-weight:bold; line-height:20px; margin:4px; text-align:justify}
.listnews a {color:#333}
.listnews li .img{
    float: left;
    width: 130px;
    height: 100px;
    margin-right: 10px;
    margin-bottom:10px;
}
.listnews li .img a{
    float: left;
    width: 130px;
    height: 100px;
    overflow: hidden;
    display: block;
}
.listnews li .img a img{
    width: 130px;
    min-height: 100px;
}    
.listnews p {padding:0; text-align:justify}
/*-----Media 459px-----*/
@media screen and (max-width:459px) {
    #homenews .news {height:auto}
    #homenews .newspic {height:auto;}
    #homenews .des {height:auto}
    #homenews .title {height:auto}
}
</style>
