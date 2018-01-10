<?php echo form_open('category/dels',  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <th class="id">ID</th>
            <th class="checked" style="text-align: center"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th>Danh mục</th>
            <th style="width: 10%">Sắp xếp <?php echo action_order()?></th>
            <th>Chức năng</th>
          </tr>        
        </thead>
        <?
        $k = 1;
        foreach($list as $rs):
          $main1 = $this->category->get_all_category($rs->cat_id);
          ?>
          <tr class="row<?php echo $k?>">
            <td><?php echo $rs->cat_id?></td>
            <td><input type="checkbox" name="ar_id[]" value="<?php echo$rs->cat_id?>"></td>
            <td><a href="<? echo site_url('category/edit/'.$rs->cat_id)?>"><?php echo $rs->cat_name?></a></td>
            <td align="center">
              <input type="text" class="order" name="order_<?php echo $rs->cat_id?>" value="<?php echo $rs->cat_order?>">
              <input type="hidden" name="id[]" value="<?php echo $rs->cat_id?>">
            </td>
            <td align="center">
              <?php echo icon_edit('category/edit/'.$rs->cat_id)?>
              <span id="publish<?php echo $rs->cat_id?>"><?php echo icon_active("'category'","'cat_id'",$rs->cat_id,$rs->published)?></span>
            </td>
          </tr>
          <?
          foreach($main1 as $rs1):
            $main2 = $this->category->get_all_category($rs1->cat_id);
            ?>
            <tr class="row<?php echo $k?>">
              <td><?php echo $rs1->cat_id?></td>
              <td align="center"><input type="checkbox" name="ar_id[]" value="<? echo $rs1->cat_id?>"></td>
              <td>|___<a href="<? echo site_url('category/edit/'.$rs1->cat_id)?>"><?php echo $rs1->cat_name?></a></td>
              <td align="center">
                <input type="text" class="order" name="order_<? echo $rs1->cat_id?>" value="<? echo $rs1->cat_order?>">
                <input type="hidden" name="id[]" value="<? echo $rs1->cat_id?>">
              </td>
              <td align="center">
                <? echo icon_edit('category/edit/'.$rs1->cat_id)?>
                <span id="publish<? echo $rs1->cat_id?>"><? echo icon_active("'category'","'cat_id'",$rs1->cat_id,$rs1->published)?></span>
              </td>
            </tr>
            <?
            foreach($main2 as $rs2):
              ?>
              <tr class="row<?=$k?>">
                <td><?=$rs2->cat_id?></td>
                <td align="center"><input type="checkbox" name="ar_id[]" value="<?=$rs2->cat_id?>"></td>
                <td>|___|___<a href="<?=site_url('category/edit/'.$rs2->cat_id)?>"><?php echo $rs2->cat_name?></a></td>
                <td align="center">
                  <input type="text" class="order" name="order_<?=$rs2->cat_id?>" value="<?=$rs2->cat_order?>">
                  <input type="hidden" name="id[]" value="<?=$rs2->cat_id?>">
                </td>
                <td align="center">
                  <?php echo icon_edit('category/edit/'.$rs2->cat_id)?>
                  <span id="publish<?=$rs2->cat_id?>"><?php echo icon_active("'category'","'cat_id'",$rs2->cat_id,$rs2->published)?></span>
                </td>
              </tr>
              <?endforeach;?>
              <?endforeach;?>
              
              <?
              $k = 1 - $k;
              endforeach;?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close()?>
    <script type="text/javascript">
      function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"diadiem/save_order",fields, function(data) {
        //load_hide();
        location.reload();
      });
  }
</script>