<?php echo form_open('hotro/dels',  array('id' => 'admindata'));?> 
<?$page = $this->uri->segment(4);?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="8">
                Hiện có <?php echo $num?> Hỗ trợ <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tiêu đề</th>
            <th>Tên</th>
            <th>Yahoo</th>
            <th>Skype</th>
            <th>Phone</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?=$rs->id?></td>
        <td><?=$rs->title?></td>
        <td><a href="<?=site_url('hotro/edit/'.$rs->id.'/'.$page)?>"><?=$rs->name?></a></td>
        <td><?=$rs->nick?></td>
        <td><?=$rs->skype?></td>
        <td><?=$rs->phone?></td>

        <td align="center">
            <?php echo icon_edit('hotro/edit/'.$rs->id.'/'.$page)?>
            <?php echo icon_del('hotro/del/'.$rs->id.'/'.$page);?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Hỗ trợ <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"sanpham/save_order",fields, function(data) {
        location.reload();
    });
}
</script>