<?php echo form_open('tuychon/chauluc/dels',  array('id' => 'admindata'));
?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Châu lục
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Châu lục</th>
            <th style="width: 100px;">Số quốc gia</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    $t = $this->tuychon->get_num_quocgia($rs->id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id?>"></td>
        <td align="center"><?=$rs->id?></td>
        <td>
            <input type="text" id="name_<?=$rs->id?>" value="<?=$rs->name?>" style="width: 300px;">
            <?php echo icon_save($rs->id)?>
        </td>
        <td><?=$t?></td>
        <td align="center">
            
            <?php echo icon_del('tuychon/chauluc/del/'.$rs->id)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Châu lục
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
$(".save").click(function(){
    var id = $(this).attr('data_id');
    var name = $("#name_"+id).val();
    if(name == ''){
        jAlert("Vui lòng nhập tên Châu lục");
        return false;
    }
    $.post(base_url+"tuychon/chauluc/edit",{'id':id, 'name':name},function(data){
        if(data.error == 0){
            location.reload();
        }
    },'json');
})
       
</script>