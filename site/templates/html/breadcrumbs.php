<div class="main">
<div id="breadcrumbs" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <ul>
        <li><a itemprop="url" href="<?=base_url()?>" title="Trang chủ"><span itemprop="title">Trang chủ</span></a></li>
        <?
        if($this->link){
            $k = 1;
             for($i = 0 ; $i < count($this->link) ; $i++){
                $link = $this->link[$i];
                $links = explode(':',$link);
                if(count($links) == 2){
                    $text = $links[0];
                    $href= $links[1];
                }else{
                    $text = $link;
                    $href="";
                }
                $active = ($k == count($this->link))?'class="active end"':'';
                ?>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?=($href != '')?site_url($href):'javascript:;'?>" title="<?=$text?>" <?=$active?>><span itemprop="title"><?=$text?></span></a></li>
              <?
             $k ++;
             }?>
         <?}?>
    </ul>
</div>     
</div>