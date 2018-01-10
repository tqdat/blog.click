<?
$page = '/'.$this->uri->segment(4);
?>
<?php echo form_open('help/dels',  array('id' => 'admindata'));?>
<input type="hidden" name="page" value="<?=$this->uri->segment(3)?>" style="width: 100%;">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="9">
                Hiện có <?php echo $num?> Trợ giúp <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tiêu đề</th>
            <th style="width: 100px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td align="center"><?=$rs->id?></td>
        <td>
            <a href="<?=site_url('help/edit/'.$rs->id.$page)?>"><?=$rs->title?></a>
        </td>
        <td align="center">
            <input type="text" class="order" name="order_<?php echo $rs->id?>" value="<?php echo $rs->ordering?>">
            <input type="hidden" name="id[]" value="<?php echo $rs->id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('help/edit/'.$rs->id.$page)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'help'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('help/del/'.$rs->id.$page)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Trợ giúp <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"help/save_order_help",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
