<?php // echo form_open(uri_string(),  array('id' => 'admindata'));?> 
<?
$page = segment(4,'int');
$url = '?catid='.$catid.'&city_id='.$city_id.'&district_id='.$district_id.'&key='.$key;
?>
<input type="hidden" name="page" value="<?php echo $page?>">
<table class="tuychon" style="width: 100%;">
    <tr>
        <td>
            Tìm kiếm: <input type="text" class="w200" value="<?=$key?>" id="key" name="key">
            <input type="button" value="Tìm kiếm" onclick="go_search()">
            <input type="button" value="Làm lại" onclick="go_search_reset()">
        </td>
        <td align="right">
            <select name="" style="width: 200px;" onchange="window.open(this.value,'_self');">
                <option value="<?=site_url('dichvu/local/ds')?>">Tất cả danh mục</option>
                <?foreach($licat as $val):
                ?>
                <option value="<?=site_url('dichvu/local/ds/')?>?catid=<?=$val->catid?>&city_id=<?=$city_id?>&district_id=0" <?=($val->catid == $catid)?'selected="selected"':'';?>><?=$val->catname?></option>
                <?endforeach;?>
            </select>
            <select name="" style="width: 200px;" onchange="window.open(this.value,'_self');">
                <option value="<?=site_url('dichvu/local/ds')?>">Tỉnh, Thành phố</option>
                <?foreach($list_city as $val):
                ?>
                <option value="<?=site_url('dichvu/local/ds/')?>?catid=<?=$catid?>&city_id=<?=$val->city_id?>&district_id=0" <?=(($val->city_id == $city_id) && ($district_id == 0))?'selected="selected"':'';?>><?=$val->city_name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
</table>
<script type="text/javascript">
    function go_search(){ 
        var key = $("#key").val();
        window.location.href = base_url + "dichvu/local/ds/?catid=<?=$catid?>city_id=<?$city_id?>&district_id=<?=$district_id?>&key="+key;
    }
    function go_search_reset(){ 
        window.location.href = '<?=site_url('dichvu/local/ds')?>';
    }    
</script>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="9">
                Hiện có <?php echo $num?> dịch vụ <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>    
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tiêu đề</th>
            <th style="width: 200px;">Danh mục</th>
            <th style="width: 200px;">Thành phố</th>
            <th class="fc">Chức năng</th>
            
        </tr>        
    </thead>
    <?
    $k = 1;
    foreach($list as $rs):
    $cat = $this->local->get_item_cat($rs->catid);
    $city = $this->local->get_item_city($rs->city_id);
    ?>
    <tr class="row<?php echo $k?>">
        <td align="center"><input type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td><?php echo $rs->id?></td>
        <td><a href="<? echo site_url('dichvu/local/edit/'.$rs->id.'/'.$page.'/'.$url)?>"><?php echo $rs->title?></a></td>
        <td><?=$cat->catname?></td>
        <td><?=$city->city_name?></td>
        <td align="center">
            <?php echo icon_edit('dichvu/local/edit/'.$rs->id.'/'.$page.'/'.$url)?>
            <span id="publish<?php echo $rs->local_id?>"><?php echo icon_active("'dichvu'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('dichvu/local/del/'.$rs->id.'/'.$page.'/'.$url)?>
        </td>
    </tr> 
    <?
    $k = 1 - $k;
    endforeach;?>
    <tfoot>
        <td colspan="9">
            Hiện có <?php echo $num?> dịch vụ <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot> 
</table>
<?php //echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"pcat/save_order_maincat",fields, function(data) {
        location.reload();
    });
}
</script>
