<?php
$page = $this->uri->segment(3);
 echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Kênh tin <span class="pages"><?php echo $pagination?></span>
                <select onchange="window.open(this.value,'_self');" name="cat_id" id="cat_id" style="float: right;width: 200px;">
                    <option value="<?=site_url('channel/ds')?>">Xem tất cả danh mục</option>
                    <?foreach($listcat as $val):
                    ?>
                    <option value="<?=site_url('channel/ds/?catid='.$val->cat_id)?>" <?php echo ($catid == $val->cat_id)?'selected="selected"':'';?>><?=$val->cat_name?></option>
                    <?endforeach;?>
                </select>
            </th>
        </tr>    
        <tr>
            <th class="id">ID</th>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th>Kênh tin</th>
            <th>Danh mục chính</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):

    ?>
    <tr class="row<?php echo $k?>">
        <td><?php echo $rs->channel_id?></td>
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->channel_id?>"></td>
        <td><a href="<? echo site_url('channel/edit/'.$rs->channel_id.'/'.$page)?>"><?php echo $rs->channel_name?></a></td>
        <td><?=$rs->cat_name?></td>
        <td align="center">
            <?php echo icon_edit('channel/edit/'.$rs->channel_id.'/'.$page)?>
            <span id="publish<?php echo $rs->channel_id?>"><?php echo icon_active("'channel'","'channel_id'",$rs->channel_id,$rs->published)?></span>
            <?php echo icon_del('channel/del/'.$rs->channel_id.'/'.$page)?>
        </td>
    </tr>
    <?
    $k = 1 - $k;
    endforeach;?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Kênh tin <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>      
</table>
<?php echo form_close()?>
