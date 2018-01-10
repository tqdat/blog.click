<?
$url = 'tour/ds/'.$this->uri->segment(3);
$key_url = ($key != '')?'&key='.$key:'';
$page = '/'.$this->uri->segment(4);
?>
<div style="border: 1px solid #CCC; padding: 5px;overflow: hidden;margin-bottom: 5px;">
    <div class="fl">
        Tìm kiếm: <input type="text"  name="key" id="key" value="<?=$key?>"  style="width: 200px;">
        <input type="submit" onclick="go_search()" value="Tìm kiếm">
        <input type="reset" onclick="go_search_reset" value="Làm lại">
    </div>
    <div class="fr">
        <select onchange="window.open(this.value,'_self');" name="cat_id" id="cat_id" style="float: right;width: 200px;">
            <option value="<?=site_url('tour/ds/')?>">Xem tất cả</option>
            <?foreach($dscat as $val):
            $dscat1 = $this->tour->get_all_cat($val->cat_id);
            ?>
            <option value="<?=site_url('tour/ds/?cat_id='.$val->cat_id)?>" <?php echo ($cat_id == $val->cat_id)?'selected="selected"':'';?>><?=$val->name?></option>
            <?foreach($dscat1 as $val1):?>
            <option value="<?=site_url('tour/ds/?cat_id='.$val1->cat_id)?>" <?php echo ($cat_id == $val1->cat_id)?'selected="selected"':'';?>>|___<?=$val1->name?></option>
            <?endforeach;?>
            <?endforeach;?>
        </select>
    </div>
</div>
<?$page = '/'.(int)$this->uri->segment(3);?>
<?php echo form_open('diadanh/dels',  array('id' => 'admindata'));?>
<input type="hidden" name="page" value="<?=$this->uri->segment(3)?>" style="width: 100%;">
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="9">
                Hiện có <?php echo $num?> Tour <span class="pages"><?php echo $pagination?></span>
            </th>
            <th colspan="5">
          

           
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Tên Tour</th>
            <th style="width: 150px;">Giá từ</th>
            <th style="width: 200px;">Danh mục</th>
            <th style="width: 50px;">Xem</th>
            <th style="width: 50px;">Facebook</th>
            <th style="width: 50px;">Google</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $price = $this->tour->get_min_price($rs->id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td align="center"><?=$rs->id?></td>
        <td>
            <a href="<?=site_url('tour/edit/'.$rs->id.$page)?>" title="<?$rs->title_seo?>"><?=$rs->title?></a>
        </td>
        <td align="right" style=" font-size: 15px;font-weight: bold;color: #FF0000;"><?=number_format($price->price,0,'.','.')?></td>
        <td style="width: 200px;"><?=$this->tour->get_item_cat($rs->cat_id)->name?></td>
        <td align="right"><?=($rs->hits)?></td>
        <td align="right"><?=($rs->hits_face)?></td>
        <td align="right"><?=($rs->hits_google)?></td>
        <td align="center">
            <?php echo icon_edit('tour/edit/'.$rs->id.$page)?>
            <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'tour'","'id'",$rs->id,$rs->published)?></span>
            <?php echo icon_del('tour/del/'.$rs->id.$page)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="9">
            Hiện có <?php echo $num?> Tour <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
    function go_search(){ 
        var key = $("#key").val();
        window.location.href = base_url + "<?php echo $url?>?key=" + key+'<?=($catid != 0)?'&catid='.$catid:''?>';
    }
    function go_search_reset(){ 
        window.location.href = '<?=site_url($url)?>';
    }    
</script>