<?php echo form_open(uri_string(),  array('id' => 'admindata'));
$page = '/'.$this->uri->segment(4);
?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="7">
                Hiện có <?php echo $num?> Doanh nghiệp <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên doanh nghiệp</th>
            <th>Địa chỉ</th>
            <th>Lĩnh vực cấp 1</th>
            <th>Lĩnh vực cấp 2</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?=$rs->user_id?></td>
        <td><a href="<?=site_url('company/business/edit/'.$rs->id.$page)?>"><?=$rs->name?></a></td>
        <td><?=$rs->address?></td>
        <td><?=$this->db->row("SELECT catname FROM company_cat WHERE catid = ".$rs->catid1)->catname?></td>
        <td><?=$this->db->row("SELECT catname FROM company_cat WHERE catid = ".$rs->catid2)->catname?></td>
        <td align="center">
            <?php echo icon_edit('company/business/edit/'.$rs->id.$page)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'company'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('company/business/del/'.$rs->id.$page)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="7">
            Hiện có <?php echo $num?> Doanh nghiệp <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>

