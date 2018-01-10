
<footer>
 <!--       <div class="width100" style="background:#f5f5f5">
            <div class="main">
                <div class="menu-footer">
                        <?php
                         $sql = "SELECT cat_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = 0 AND is_menu = 0 ORDER BY ordering ASC limit 3";
                         $menutour = $this->db->result($sql);

                        foreach($menutour as $val):
                          $sqlsub = "SELECT cat_id, parent_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = $val->cat_id ORDER BY ordering ASC limit 6";
                          $subcat = $this->db->result($sqlsub);
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <h4><?=$val->name?></h4>
                            <?php if (count($subcat)) { ?>
                            <ul>
                            <?foreach($subcat as $subval):?>
                                    <li><a href="<?=site_url($val->slug.'/'.$subval->slug)?>"><?=$subval->name?></a></li>
                                    <?endforeach;?>
                            </ul>
                            <?}?>
                        </div>
                        <?endforeach;?>
                       
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <h4>Khách sạn</h4>
                                <?php 
                                $menuhotel = $this->dnx->get_all_hotel(1);
                                ?>
                                <ul>
                                        <?foreach($menuhotel as $val):?>
                                        <li><a href="<?=site_url('khach-san/'.$val->cat_slug)?>"><?=$val->cat_name?></a></li>
                                        <?endforeach;?>
                                </ul>
                        </div>
                        <div class="clearfix"></div>
                </div>
            </div>
        </div> -->
        <div class="width100">
                <?php echo $this->load->mod('footer')?>
                <!--fb-->
        <div style="margin-bottom:10px;">
        
        <div class="width100" style="background:#f5f5f5; padding:15px 0 0 0">
            <div class="main">
                <div class="col-lg-6 col-md-6" align="left">
                    <?=$this->load->mod('footer2')?>
                </div>
                <div class="col-lg-6 col-md-6" align="right">
                   
                    <?=$this->load->mod('footer3')?>
                   <a target="_blank" href="//www.dmca.com/Protection/Status.aspx?ID=b8fd4d5c-a9f6-43eb-a657-1143520dc8c4" title="DMCA.com Protection Status" class="dmca-badge"> <img src="//images.dmca.com/Badges/dmca-badge-w100-5x1-11.png?ID=b8fd4d5c-a9f6-43eb-a657-1143520dc8c4" alt="DMCA.com Protection Status"></a> <script src="//images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                </div>
            </div>
        </div>
        <div class="width100" style="text-align: left; background: #226cc1;">
        	<div class="main" style="text-align: left; color: #fff; padding-top: 10px;">
                 <?php echo $this->load->mod('tags')?>
            </div>
        </div>
        <div class="width100"  style="background:#f8f8f8; padding:10px 0;">
        	<div class="main">
                 Copyright @ ClickGo.Vn. All right reserved. 
Designed by <a href="http://phangiahuy.com" title="Thiết kế website chuyên nghiệp"> Phan Gia Huy </a>
                 <?php echo $this->load->mod('copyright')?>
            </div>
        </div>              
	
</footer>
