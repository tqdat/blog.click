<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi-vn" lang="vi-vn">
  <head>
    <?=$this->_templates('html/meta')?>
  </head>
  <body>
        <?=$this->_templates('html/top')?>
        <div class="width100">
            <?php echo $this->load->mod('slide')?>
        </div>
        
    <div class="clearfix"></div>
    <div class="main">
            
            
            <div class="col-lg-3 col-md-3">
                <?php echo $this->load->mod('right_top')?>
            </div>
            <div class="col-lg-9 col-md-9">
                <?php //$this->view($page,$data);?>                
                <?php $this->load->mod('home_top')?>
     
            </div>
	</div>
	<div class="main">
            <div class="col-lg-12 col-md-12">
                <?php //$this->view($page,$data);?>                
                <?php $this->load->mod('home_center')?>
     
            </div>

	</div>
    <div class="main">
            
            <div class="col-lg-8 col-md-8">
                <?php $this->view($page,$data);?>                
                <?php $this->load->mod('ykien')?>
     
            </div>
            <div class="col-lg-4 col-md-4" style="background: #f8f8f8;">
                <?php echo $this->load->mod('left')?>
            </div>
	</div> 
	<div class="main">
            <div class="col-lg-12 col-md-12">
                <?php //$this->view($page,$data);?>                
                <?php $this->load->mod('home_bottom')?>
     
            </div>

	</div> 
	<?=$this->_templates('html/footer')?>
  </body>
</html>