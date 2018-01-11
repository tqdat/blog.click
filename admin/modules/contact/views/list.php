<?echo form_open('contact/dels',  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?=$this->uri->segment(4)?>">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr class="pagination">
              <th colspan="7">
                Hiện có <?=$num?> liên hệ <span class="pages"><?=$pagination?></span>
              </th>
            </tr>
            <tr>
              <th class="checked" style="text-align: center;"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
              <th class="id">ID</th>
              <th>Tiêu đề</th>
              <th>Họ tên</th>
              <th>Email</th>
              <th>Ngày gửi</th>
              <th class="fc">Chức năng</th>
            </tr>        
          </thead>
          <?
          $k=1;
          foreach($list as $rs):
            ?>
            <tr class="row<?=$rs->is_read?>">
              <td align="center"><input  type="checkbox" name="ar_id[]" value="<?=$rs->contactid?>"></td>
              <td><?=$rs->contactid?></td>
              <td><a href="<?=site_url('contact/edit/'.$rs->contactid)?>"><?=$rs->title?></a></td>
              <td><?=$rs->fullname?></td>
              <td><?=$rs->email?></td>
              <td><?=date('H:i:s d/m/Y',$rs->datesend)?></td>

              <td align="center">
                <?=icon_del('contact/del/'.$rs->contactid.'/'.(int)$this->uri->segment(4))?>        
              </td>
            </tr>        
            <?
            $k=1-$k;
          endforeach;
          ?>
          <tfoot>
            <td colspan="7">

              Hiện có <?=$num?> liên hệ <span class="pages"><?=$pagination?></span>
            </td>
          </tfoot> 
        </table>
      </div>
    </div>
  </div>
</div>
<?=form_close()?>
