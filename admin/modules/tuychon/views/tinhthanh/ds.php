<?php echo form_open('tuychon/chauluc/dels',  array('id' => 'admindata'));
$page = segment(4,'int');
?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Tỉnh thành <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>

            <th>Tỉnh thành</th>
            <th colspan="2">Quận huyện</th>
            <th style="width: 90px;">Sắp xếp <?php echo action_order()?></th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <tr class="row<?=$k?>">
        <td colspan="8">
           <input type="hidden" name="city_id" value="<?=(int)$r->city_id?>">
            Tỉnh thành: <input type="text" name="city_name" value="<?=$r->city_name?>" style="width: 200px;">
            Sắp xếp: <input type="text" name="ordering" value="<?=$r->ordering?>" style="width: 30px;">
                        <span style="padding-left: 10px;padding-top: 5px;"><?php echo icon_save(0)?></span>
            <a href="<?=site_url('tuychon/tinhthanh/ds/')?>" style="padding-left: 10px;"><b style="font-size: 14px;">Hủy</b></a>
        </td>                                                                          
    </tr>     
    <?
    $k=1;
    foreach($list as $rs):
    $t = $this->tinhthanh->get_num_quanhuyen($rs->city_id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->city_id?>"></td>
        <td align="center"><?=$rs->city_id?></td>

        <td>
            <?=$rs->city_name?>
        </td>
        <td style="width: 40px;" align="center">
            <a href="<?=site_url('tuychon/quanhuyen/ds/'.$rs->city_id)?>"><b>Xem</b></a>
        </td>
        <td align="right" style="width: 40px;">
            <?=$t?>   
        </td>
        <td align="center">
            <input type="text" class="order" name="order_<?=$rs->city_id?>" value="<?=$rs->ordering?>">
            <input type="hidden" name="id[]" value="<?=$rs->city_id?>">
        </td>
        <td align="center">
            <?php echo icon_edit('tuychon/tinhthanh/ds/?edit='.$rs->city_id)?>
            <?php echo icon_del('tuychon/tinhthanh/del/'.$rs->city_id)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Tỉnh thành <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"tuychon/tinhthanh/save_order",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
<script type="text/javascript">
//get_quocgia('<?=$co?>','quocgia','');
function get_quocgia(id,div,type){
    $.post(base_url+"tuychon/quocgia/tinhthanh",{'id':id, 'type':type},function(data){
        $("#"+div).html(data.html);
    },'json');
}
$(".save").click(function(){
    var city_id = $("input[name='city_id']").val();
    var city_name = $("input[name='city_name']").val();
    var ordering = $("input[name='ordering']").val();
    

    if(city_name == ''){
        jAlert("Vui lòng nhập Tên tỉnh, thành phố");
        return false;
    }
    $.post(base_url+"tuychon/tinhthanh/save",{'city_id':city_id, 'city_name':city_name ,'ordering':ordering},function(data){
        if(data.error == 0){
            window.location.href = base_url+"tuychon/tinhthanh/ds";
        }
    },'json');
})
       
</script>