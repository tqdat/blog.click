<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$list = $this->mod->get_position($position);
if(count($list) > 0){
    foreach($list as $rs):
    $title = $rs->title;
    $params = $rs->params;
    $data['title'] = $title;
    //var_dump(get_params($rs->attr)); 
    $data['attr'] = $rs->attr;
?>
    <?if($params != '_blank'){?>
			<div class="width100">
				<?php if($rs->show_title == 1){?>
                                        <h3 class="heading-module"><?php if ($params !="") { ?><i class="<?=$params?>"></i> <?php } ?><?php echo $title?></h3>
				<?php } ?>
				<div class="module-content box-content">
					<?php if($rs->html == 0){?>
                    <?php echo $this->load->view_mod($rs->module,$data)?> 
					<?php }?>
					<?php if($rs->html == 1){?>
						<?php echo htmlspecialchars_decode($rs->content)?>
					<?php }?>   
				</div><!--box-content-->
			</div><!--End Box Item-->

			<?php }else{?>

					<div class="<?=$params?>" style="margin-bottom: 0px;">
						<?php if($rs->html == 0){?>
							<?php echo $this->load->view_mod($rs->module,$data)?> 
						<?php }?>
						<?php if($rs->html == 1){?>
							<?php echo htmlspecialchars_decode($rs->content)?>
						<?php }?>            
					</div>

			<?php }?>
	<?php 
		endforeach;
		}
	?>
