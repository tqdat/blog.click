<?=$this->_templates('html/jcarousel')?>

<div class="width100" style="padding:0 0 20px 0; background:#f5f5f5">
    <div class="main">
     <h2 class="heading-home">Chùm tour nổi bật</h2>
     <p class="heading-home"></p>
        <div class="jcarousel-wrapper fadeinUp">
            <div class="jcarousel">
                <ul>
                    <?php
                    $hot_tour = $this->db->result("select * from tour where published = 1 and noibat = 1");
                    foreach($hot_tour as $val): 
                    $price = $this->dnx->get_min_price($val->id);?>
                    <li>
                    <div class="col-lg-12">
                        <div class="tourhot">
                            <a title="<?=$val->title?>" href="<?=site_url($val->id.'-'.$val->slug)?>">
                                <figure class="tourhotpic">
                                    <?if($val->images == ''){?>
                                    <img class="img" alt="<?= $val->title ?>" src="<?= base_url() ?>templates/images/no_images.gif">
                                    <?}else{?>
                                    <img class="img" alt="<?= $val->title ?>" src="<?= base_url() ?>data/tour/500/<?= $val->images ?>">
                                    <?}?>
                                </figure>
                                <div class="col-lg-12 title_ctn">
                                    <h2 class="title"><?=$val->title?></h2>
                                </div>
                                <div class="infotourhot">
                                    <div class="date"><?= $val->ngay . " Ngày " ?> <?php echo ($val->dem > 0) ?  $val->dem . " Đêm " : ""; ?></div>
                                    <div class="price">
                                    <?php if($price != 0) {
                                            if($val->giamgia !=0){
                                            echo "<span class='old_price'>". number_format((round(( $price/ (100-$val->giamgia)*100)/1000,0)*1000),0,'.','.')."</span> ";

                                            echo number_format($price, 0, '.','.'). "đ";
                                            } else { 
                                                    echo number_format($price, 0, '.','.'). "đ"; 
                                            } 
                                            } else { 
                                                    echo "Liên hệ"; 
                                            } ?>
                                    </div>
                                </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next">&rsaquo;</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
