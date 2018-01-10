<table class="tuychon">
    <tr>
        <td>Châu lục: 
            <select id="chauluc">
                <?foreach($chauluc as $val):?>
                <option value="<?=$val->id?>" <?=($val->id == $ct)?'selected="selected"':''?>><?=$val->name?></option>
                <?endforeach;?>
            </select>
        </td>
    </tr>
</table>
<?php echo form_open('tuychon/chauluc/dels',  array('id' => 'admindata'));
$page = segment(4,'int');
?>
<table class="admindata">
    <thead>
        <tr class="pagination">
            <th class="head" colspan="8">
                Hiện có <?php echo $num?> Quốc gia <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th class="id">ID</th>
            <th>Châu lục</th>
            <th colspan="2">Số thành phố</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <tr class="row<?=$k?>">
        <td colspan="8">
            <?if($edit == 0){?>
            Mã: <input type="text" name="ct_id">
            <?}else{?><input type="hidden" name="ct_id" value="<?=$r->ct_id?>"><?}?>
            Quốc gia: <input type="text" name="ct_name" value="<?=$r->ct_name?>" style="width: 300px;">
            Châu lục:
            <select name="chauluc">
                <?foreach($chauluc as $val):?>
                <option value="<?=$val->id?>" <?=($val->id == $r->ct_continent_id)?'selected="selected"':''?>><?=$val->name?></option>
                <?endforeach;?>
            </select>
            <input type="hidden" name="edit" value="<?=$edit?>">
            <span style="padding-left: 10px;padding-top: 5px;"><?php echo icon_save(0)?></span>
            <a href="<?=site_url('tuychon/quocgia/ds/'.$page.'/?ct='.$ct)?>" style="padding-left: 10px;"><b style="font-size: 14px;">Hủy</b></a>
        </td>                                                                          
    </tr>     
    <?
    $k=1;
    foreach($list as $rs):
    $t = $this->tuychon->get_num_thanhpho($rs->ct_id);
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->ct_id?>"></td>
        <td align="center"><?=$rs->ct_id?></td>
        <td>
            <?=$rs->ct_name?>
        </td>
        <td style="width: 40px;" align="center">
            <a href="<?=site_url('tuychon/tinhthanh/ds/?co='.$rs->ct_continent_id.'&ct='.$rs->ct_id)?>"><b>Xem</b></a>
        </td>
        <td align="right" style="width: 40px;">
            <?=$t?>   
        </td>
        <td align="center">
            <?php echo icon_edit('tuychon/quocgia/ds/'.$page.'/?ct='.$ct.'&edit='.$rs->ct_id)?>
            <?php echo icon_del('tuychon/quocgia/del/'.$rs->ct_id.'/'.$page.'?ct='.$ct)?>
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="8">
            Hiện có <?php echo $num?> Quốc gia <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>
<script type="text/javascript">
$("#chauluc").change(function(){
    var id = $(this).val();
    url = '<?=site_url('tuychon/quocgia/ds/?ct=')?>';
    window.location.href = url+id;
})
$(".save").click(function(){
    var id = $("input[name='ct_id']").val();
    var edit = $("input[name='edit']").val();
    var chauluc_id = $("select[name='chauluc']").val();
    var name = $("input[name='ct_name']").val();
    if(id == ''){
        jAlert("Vui lòng nhập Mã Quốc gia");
        return false;
    }
    if(name == ''){
        jAlert("Vui lòng nhập Tên Quốc gia");
        return false;
    }
    $.post(base_url+"tuychon/quocgia/save",{'id':id, 'edit':edit ,'chauluc_id':chauluc_id,'name':name},function(data){
        if(data.error == 0){
            window.location.href = data.url;
        }
    },'json');
})
       
</script>