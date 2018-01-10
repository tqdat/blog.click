<?php echo form_open('tuychon/chauluc/dels',  array('id' => 'admindata'));
?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Quận, huyện
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th style="width: 300px;">Quận, Huyện</th>
            <th>Chức năng</th>
        </tr>        
    </thead>
    <tr class="row<?=$k?>">
        <td colspan="8">
            <input type="hidden" name="parentid" value="<?=$id?>">
            Quận huyện: <input type="text" id="name_0" value="" style="width: 300px;">
            <input type="button" class="save_qh" value="Lưu" data_id="0">
        </td>                                                                    
    </tr>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->city_id?>"></td>
        <td align="center"><?=$rs->city_id?></td>
        <td>
            <input type="text" id="name_<?=$rs->city_id?>" value="<?=$rs->city_name?>" style="width: 300px;">
        </td>

        <td>
            <input type="button" class="save_qh" value="Lưu" data_id="<?=$rs->city_id?>">
            <input type="button" class="del_qh" value="Xóa" data_id="<?=site_url('tuychon/quanhuyen/del/'.$id.'/'.$rs->city_id)?>">
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Quận, huyện
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
$(".save_qh").click(function(){
    var id = $(this).attr('data_id');
    var parentid = $("input[name='parentid']").val();
    var name = $("#name_"+id).val();
    if(name == ''){
        jAlert("Vui lòng nhập tên Quận huyện");
        return false;
    }
    $.post(base_url+"tuychon/quanhuyen/edit",{'id':id, 'name':name,'parentid':parentid},function(data){
        //if(data.error == 0){
            location.reload();
        //}
    },'json');
})

$(".del_qh").click(function(){
    link = $(this).attr('data_id');
    if(link !=''){
        jConfirm('Bạn có chắc chắn muốn xóa mục đã chọn.<br />Chọn <b>Đồng ý</b> hoặc <b>Hủy bỏ</b>','Thông báo',function(r) {
            if(r){
              window.location.href = link;
            }
        });           
    }
    return false;
})
       
</script>