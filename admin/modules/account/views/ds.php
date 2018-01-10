
<?php echo form_open('account/dels',  array('id' => 'admindata'));
$page = $this->uri->segment(4)
?> 
<input type="hidden" name="page" value="<?php echo $page?>">

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>
                Hiện có <?php echo $num?> Tài khoản <span class="pages"><?php echo $pagination?></span>
              </th>
            </tr>
            <tr>
              <th class="checked" style="text-align: center;"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
              <th class="id">ID</th>
              <th>Họ tên</th>
              <th>Email</th>
              <th>Tên đăng nhập</th>
              <th>Nhóm tài khoản</th>
              <th>Chức năng</th>
            </tr>        
          </thead>
          <tbody>
            <?
            $k=1;
            foreach($list as $rs):
              ?>
              <tr class="row<?=$k?>">
                <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->user_id?>"></td>
                <td><?=$rs->user_id?></td>
                <td><a href="<?=site_url('account/edit/'.$rs->user_id.'/'.$page)?>"><?=$rs->fullname?></a></td>
                <td><?=$rs->email?></td>

                <td><?=$rs->username?></td>
                <td><?=$rs->group_name?></td>
                <td align="center">
                  <?php echo icon_edit('account/edit/'.$rs->user_id.'/'.$page)?>
                  <span id="publish<?php echo $rs->user_id?>"><?php echo icon_active("'user'","'user_id'",$rs->user_id,$rs->published)?></span>
                  <?php 
                  if($rs->user_id != 1){
                    echo icon_del('account/del/'.$rs->user_id.'/'.$page);
                  }
                  ?> 
                </td>
              </tr>       
              <?php
              $k=1-$k;
            endforeach;
            ?>
            <tfoot>
              <td>
                Hiện có <?php echo $num?> Tài khoản <span class="pages"><?php echo $pagination?></span>
              </td>
            </tfoot>  
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<?php echo form_close()?>

