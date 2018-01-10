<?php echo form_open('tourcomment/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th style="width: 130px;">Họ tên / Email</th>
            <th>Nội dung</th>
            <th style="width: 170px;">Tour</th>
            <th style="width: 30px;">Star</th>
            <th style="width: 110px;">Ngày gởi</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $tentour = $this->tourcomment->get_tour($rs->tour_id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?=$rs->id?></td>
        <td><?=$rs->fullname?> / <?=$rs->email?></td>
        <td><?=$rs->content?></td>
        <td><?=$tentour->title?></td>
        <td><?=$rs->star?></td>
        <td><?=date('d/m/Y H:i',$rs->time)?></td>
        <td align="center">
            <?php echo icon_edit('tourcomment/edit/'.$rs->id)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'tour_comment'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('tourcomment/del/'.$rs->id);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Đánh giá <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>  
</table>
<?php echo form_close()?>
