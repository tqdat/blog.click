<?
$url = 'hotel/ds/'.$this->uri->segment(3);
$key_url = ($key != '')?'&key='.$key:'';
$page = '/'.$this->uri->segment(4);
?>
<table class="tuychon" style="width: 100%;">
    <tr>
        <td>
            Lọc <input type="text" name="key" id="key" value="<?=$key?>" class="w200">
            <input type="button" onclick="go_search()" name="bt_loc" value="Tìm">
            <input type="button" onclick="go_search_reset()" name="bt_loc" value="Làm lại">
        </td>
        <td>
            <select onchange="window.open(this.value,'_self');" name="cat_id" id="cat_id" style="float: right;width: 200px;">
                <option value="<?=site_url($url.'?catid=0'.$key_url)?>">Xem tất cả danh mục</option>
                <?foreach($listhotel_chanel as $val):
                $listcat1 = $this->hotel->get_all_hotel_chanel($val->cat_id);
                ?>
                <option value="<?=site_url($url.'?catid='.$val->cat_id.$key_url)?>" <?php echo ($catid == $val->cat_id)?'selected="selected"':'';?>><?=$val->cat_name?></option>
                <?foreach($listcat1 as $val1):
                $listcat2 = $this->hotel->get_all_hotel_chanel($val1->cat_id);
                ?>
                <option value="<?=site_url($url.'?catid='.$val1->cat_id.$key_url)?>" <?php echo ($catid == $val1->cat_id)?'selected="selected"':'';?>>|___<?=$val1->cat_name?></option>
                <?foreach($listcat2 as $val2):
                ?>
                <option value="<?=site_url($url.'?catid='.$val2->cat_id.$key_url)?>" <?php echo ($catid == $val2->cat_id)?'selected="selected"':'';?>>|______<?=$val2->cat_name?></option>
                <?endforeach;?>
                <?endforeach;?>
                <?endforeach;?>
            </select>
        </td>

    </tr>
</table>
<script type="text/javascript">
    function go_search(){ 
        var key = $("#key").val();
        window.location.href = base_url + "<?php echo $url?>?key=" + key+'<?=($catid != 0)?'&catid='.$catid:''?>';
    }
    function go_search_reset(){ 
        window.location.href = '<?=site_url($url)?>';
    }    
</script>
<?php echo form_open('hotel/dels',  array('id' => 'admindata'));?>
<input type="hidden" name="page" value="<?=set_post_page()?>" style="width: 100%;">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> khách sạn <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tiêu đề</th>
			<th>Địa chỉ</th>
            <th>Giá</th>
            <th style="width: 50px;">Xem</th>
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
            <a href="<?=site_url('hotel/edit/'.$rs->id.$page)?>"><?=$rs->title?></a>
        </td>

        <td style="width: 300px;">
        <?php echo $rs->address?>
        </td>
		<td style="width: 200px;">
        <?php echo number_format($rs->price)?>
        </td>
        <td><?=$rs->hits?></td>
       
        <td align="center">
            <?php echo icon_edit('hotel/edit/'.$rs->id.$page)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'hotel'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('hotel/del/'.$rs->id.$page)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> khách sạn <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
